// Add this to the existing api.php routes file
Route::get('/staff-activity/{holderType}/{holderId}', function ($holderType, $holderId) {
    try {
        $staff = null;
        $recentActivity = collect();
        
        // Get staff details based on type
        switch ($holderType) {
            case 'hr':
                $staff = \App\Models\HrStaff::find($holderId);
                break;
            case 'perm_manual':
                $staff = \App\Models\PermanentStaffManual::find($holderId);
                break;
            case 'temp':
                $staff = \App\Models\TemporaryStaff::find($holderId);
                break;
        }
        
        if (!$staff) {
            return response()->json(['success' => false, 'message' => 'Staff not found']);
        }
        
        // Get recent activity
        $recentActivity = \App\Models\KeyLog::where('holder_type', $holderType)
            ->where('holder_id', $holderId)
            ->with(['key.location', 'receiver'])
            ->latest()
            ->limit(10)
            ->get();
        
        // Get current held keys
        $currentKeys = \App\Models\KeyLog::where('holder_type', $holderType)
            ->where('holder_id', $holderId)
            ->where('action', 'checkout')
            ->whereNull('returned_from_log_id')
            ->with(['key.location'])
            ->get();
        
        $html = view('components.staff-activity-details', compact('staff', 'recentActivity', 'currentKeys', 'holderType'))->render();
        
        return response()->json(['success' => true, 'html' => $html]);
        
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'message' => $e->getMessage()]);
    }
});
