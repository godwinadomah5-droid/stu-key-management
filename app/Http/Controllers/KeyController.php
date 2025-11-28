<?php

namespace App\Http\Controllers;

use App\Models\Key;
use App\Models\Location;
use App\Models\KeyTag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class KeyController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        // Check if user has required role
        if (!auth()->user()->hasAnyRole(['admin', 'security', 'hr'])) {
            abort(403, 'Unauthorized access.');
        }

        $keys = Key::with(['location', 'keyTags', 'currentHolder'])
            ->latest()
            ->paginate(20);

        $locations = Location::all();

        return view('keys.index', compact('keys', 'locations'));
    }

    public function create()
    {
        if (!auth()->user()->hasRole('admin')) {
            abort(403, 'Unauthorized access.');
        }

        $locations = Location::active()->get();
        return view('keys.create', compact('locations'));
    }

    public function store(Request $request)
    {
        if (!auth()->user()->hasRole('admin')) {
            abort(403, 'Unauthorized access.');
        }

        $validated = $request->validate([
            'code' => 'required|string|unique:keys',
            'label' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'key_type' => 'required|in:physical,electronic,master,duplicate',
            'location_id' => 'required|exists:locations,id',
            'generate_qr' => 'boolean',
            'qr_count' => 'nullable|integer|min:1|max:5',
        ]);

        DB::transaction(function () use ($validated) {
            $key = Key::create([
                'code' => $validated['code'],
                'label' => $validated['label'],
                'description' => $validated['description'],
                'key_type' => $validated['key_type'],
                'location_id' => $validated['location_id'],
            ]);

            // Generate QR tags if requested
            if ($request->boolean('generate_qr')) {
                $count = $validated['qr_count'] ?? 1;
                $this->generateKeyTags($key, $count);
            }
        });

        return redirect()->route('keys.index')
            ->with('success', 'Key created successfully.');
    }

    public function show(Key $key)
    {
        if (!auth()->user()->hasAnyRole(['admin', 'security', 'hr'])) {
            abort(403, 'Unauthorized access.');
        }

        $key->load(['location', 'keyTags', 'keyLogs.receiver', 'keyLogs.holder']);
        
        $currentLog = $key->currentHolder;
        $history = $key->keyLogs()
            ->with(['receiver', 'holder'])
            ->latest()
            ->paginate(10);

        return view('keys.show', compact('key', 'currentLog', 'history'));
    }

    public function edit(Key $key)
    {
        if (!auth()->user()->hasRole('admin')) {
            abort(403, 'Unauthorized access.');
        }

        $locations = Location::active()->get();
        return view('keys.edit', compact('key', 'locations'));
    }

    public function update(Request $request, Key $key)
    {
        if (!auth()->user()->hasRole('admin')) {
            abort(403, 'Unauthorized access.');
        }

        $validated = $request->validate([
            'code' => 'required|string|unique:keys,code,' . $key->id,
            'label' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'key_type' => 'required|in:physical,electronic,master,duplicate',
            'location_id' => 'required|exists:locations,id',
            'status' => 'required|in:available,checked_out,lost,maintenance',
        ]);

        $key->update($validated);

        return redirect()->route('keys.index')
            ->with('success', 'Key updated successfully.');
    }

    public function destroy(Key $key)
    {
        if (!auth()->user()->hasRole('admin')) {
            abort(403, 'Unauthorized access.');
        }

        if ($key->isCheckedOut()) {
            return redirect()->back()->with('error', 'Cannot delete a key that is currently checked out.');
        }

        $key->delete();

        return redirect()->route('keys.index')
            ->with('success', 'Key deleted successfully.');
    }

    public function generateTags(Key $key, Request $request)
    {
        if (!auth()->user()->hasRole('admin')) {
            abort(403, 'Unauthorized access.');
        }

        $validated = $request->validate([
            'count' => 'required|integer|min:1|max:10',
        ]);

        $this->generateKeyTags($key, $validated['count']);

        return redirect()->route('keys.show', $key)
            ->with('success', "{$validated['count']} QR tags generated successfully.");
    }

    public function printTags(Key $key)
    {
        if (!auth()->user()->hasRole('admin')) {
            abort(403, 'Unauthorized access.');
        }

        $tags = $key->keyTags()->active()->get();
        
        if ($tags->isEmpty()) {
            return redirect()->back()->with('error', 'No active QR tags found for this key.');
        }

        return view('keys.print-tags', compact('key', 'tags'));
    }

    public function markAsLost(Key $key)
    {
        if (!auth()->user()->hasAnyRole(['admin', 'security'])) {
            abort(403, 'Unauthorized access.');
        }

        if (!$key->isCheckedOut()) {
            return redirect()->back()->with('error', 'Only checked out keys can be marked as lost.');
        }

        $key->update(['status' => 'lost']);

        // Log the loss
        \App\Models\KeyLog::create([
            'key_id' => $key->id,
            'action' => 'checkin', // Special case for lost keys
            'holder_type' => $key->currentHolder->holder_type,
            'holder_id' => $key->currentHolder->holder_id,
            'holder_name' => $key->currentHolder->holder_name,
            'holder_phone' => $key->currentHolder->holder_phone,
            'receiver_user_id' => auth()->id(),
            'receiver_name' => auth()->user()->name,
            'returned_from_log_id' => $key->currentHolder->id,
            'notes' => 'Key reported as lost',
            'verified' => false,
            'discrepancy' => true,
        ]);

        return redirect()->route('keys.show', $key)
            ->with('warning', 'Key marked as lost. Security team has been notified.');
    }

    private function generateKeyTags(Key $key, $count = 1)
    {
        for ($i = 0; $i < $count; $i++) {
            KeyTag::create([
                'key_id' => $key->id,
                'uuid' => Str::uuid(),
                'is_active' => true,
            ]);
        }
    }
}
