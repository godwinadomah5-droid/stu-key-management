<?php

namespace App\Http\Controllers;

use App\Models\Key;
use App\Models\KeyTag;
use App\Models\HrStaff;
use App\Models\KeyLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ApiController extends Controller
{
    // ... existing methods ...

    /**
     * Get detailed information for a specific key log
     */
    public function getKeyLogDetails(KeyLog $keyLog)
    {
        try {
            // Load relationships
            $keyLog->load([
                'key.location',
                'receiver',
                'returnedFromLog',
                'checkoutLog'
            ]);

            return response()->json([
                'success' => true,
                'data' => [
                    'id' => $keyLog->id,
                    'action' => $keyLog->action,
                    'created_at' => $keyLog->created_at->toISOString(),
                    'holder_name' => $keyLog->holder_name,
                    'holder_phone' => $keyLog->holder_phone,
                    'holder_type_label' => $keyLog->holder_type_label,
                    'receiver_name' => $keyLog->receiver_name,
                    'expected_return_at' => $keyLog->expected_return_at?->toISOString(),
                    'notes' => $keyLog->notes,
                    'verified' => $keyLog->verified,
                    'discrepancy' => $keyLog->discrepancy,
                    'discrepancy_reason' => $keyLog->discrepancy_reason,
                    'signature_path' => $keyLog->signature_path,
                    'signature_url' => $keyLog->signature_url,
                    'photo_path' => $keyLog->photo_path,
                    'photo_url' => $keyLog->photo_url,
                    'key' => [
                        'id' => $keyLog->key->id,
                        'code' => $keyLog->key->code,
                        'label' => $keyLog->key->label,
                        'key_type' => $keyLog->key->key_type,
                        'location' => [
                            'id' => $keyLog->key->location->id,
                            'name' => $keyLog->key->location->name,
                            'campus' => $keyLog->key->location->campus,
                            'building' => $keyLog->key->location->building,
                            'room' => $keyLog->key->location->room,
                            'full_address' => $keyLog->key->location->full_address,
                        ]
                    ],
                    'duration_minutes' => $keyLog->getDurationInMinutes(),
                    'is_overdue' => $keyLog->isOverdue(),
                    'is_open_checkout' => $keyLog->isOpenCheckout(),
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to load key log details: ' . $e->getMessage()
            ], 500);
        }
    }

    // ... rest of existing methods ...
}
