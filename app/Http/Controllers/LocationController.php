<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        if (!auth()->user()->hasRole('admin')) {
            abort(403, 'Unauthorized access.');
        }

        $locations = Location::withCount(['keys as total_keys', 'keys as available_keys' => function($query) {
            $query->where('status', 'available');
        }])->latest()->paginate(20);

        return view('locations.index', compact('locations'));
    }

    public function create()
    {
        if (!auth()->user()->hasRole('admin')) {
            abort(403, 'Unauthorized access.');
        }

        $campuses = $this->getAvailableCampuses();
        return view('locations.create', compact('campuses'));
    }

    public function store(Request $request)
    {
        if (!auth()->user()->hasRole('admin')) {
            abort(403, 'Unauthorized access.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'campus' => 'required|string|max:100',
            'building' => 'required|string|max:100',
            'room' => 'nullable|string|max:50',
            'description' => 'nullable|string|max:1000',
        ]);

        Location::create($validated);

        return redirect()->route('locations.index')
            ->with('success', 'Location created successfully.');
    }

    public function show(Location $location)
    {
        if (!auth()->user()->hasRole('admin')) {
            abort(403, 'Unauthorized access.');
        }

        $location->load(['keys.keyTags', 'keys.currentHolder']);
        
        $keys = $location->keys()
            ->with(['keyTags', 'currentHolder'])
            ->latest()
            ->paginate(20);

        return view('locations.show', compact('location', 'keys'));
    }

    public function edit(Location $location)
    {
        if (!auth()->user()->hasRole('admin')) {
            abort(403, 'Unauthorized access.');
        }

        $campuses = $this->getAvailableCampuses();
        return view('locations.edit', compact('location', 'campuses'));
    }

    public function update(Request $request, Location $location)
    {
        if (!auth()->user()->hasRole('admin')) {
            abort(403, 'Unauthorized access.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'campus' => 'required|string|max:100',
            'building' => 'required|string|max:100',
            'room' => 'nullable|string|max:50',
            'description' => 'nullable|string|max:1000',
            'is_active' => 'boolean',
        ]);

        $location->update($validated);

        return redirect()->route('locations.index')
            ->with('success', 'Location updated successfully.');
    }

    public function destroy(Location $location)
    {
        if (!auth()->user()->hasRole('admin')) {
            abort(403, 'Unauthorized access.');
        }

        if ($location->keys()->count() > 0) {
            return redirect()->back()->with('error', 'Cannot delete location that has keys assigned.');
        }

        $location->delete();

        return redirect()->route('locations.index')
            ->with('success', 'Location deleted successfully.');
    }

    public function getBuildings(Request $request)
    {
        $campus = $request->get('campus');
        
        if (!$campus) {
            return response()->json([]);
        }

        $buildings = Location::where('campus', $campus)
            ->distinct()
            ->pluck('building')
            ->map(function ($building) {
                return ['id' => $building, 'text' => $building];
            });

        return response()->json($buildings);
    }

    public function getRooms(Request $request)
    {
        $campus = $request->get('campus');
        $building = $request->get('building');
        
        if (!$campus || !$building) {
            return response()->json([]);
        }

        $rooms = Location::where('campus', $campus)
            ->where('building', $building)
            ->whereNotNull('room')
            ->distinct()
            ->pluck('room')
            ->map(function ($room) {
                return ['id' => $room, 'text' => $room];
            });

        return response()->json($rooms);
    }

    private function getAvailableCampuses()
    {
        return [
            'Main Campus' => 'Main Campus',
            'Medical Campus' => 'Medical Campus',
            'Engineering Campus' => 'Engineering Campus',
            'City Campus' => 'City Campus',
        ];
    }
}
