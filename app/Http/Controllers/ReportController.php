<?php

namespace App\Http\Controllers;

use App\Models\KeyLog;
use App\Models\Key;
use App\Models\User;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function index()
    {
        return view('reports.index');
    }

    public function keyActivity(Request $request)
    {
        // Set default dates if not provided
        $defaultStartDate = now()->subDays(30)->format('Y-m-d');
        $defaultEndDate = now()->format('Y-m-d');

        $filters = $request->validate([
            'start_date' => 'sometimes|date',
            'end_date' => 'sometimes|date|after_or_equal:start_date',
            'key_id' => 'nullable|exists:keys,id',
            'location_id' => 'nullable|exists:locations,id',
            'receiver_id' => 'nullable|exists:users,id',
            'action' => 'nullable|in:checkout,checkin',
        ]);

        // Set default values if not provided
        $filters['start_date'] = $filters['start_date'] ?? $defaultStartDate;
        $filters['end_date'] = $filters['end_date'] ?? $defaultEndDate;

        $query = KeyLog::with(['key.location', 'receiver', 'holder'])
            ->whereBetween('created_at', [$filters['start_date'] . ' 00:00:00', $filters['end_date'] . ' 23:59:59']);

        if (!empty($filters['key_id'])) {
            $query->where('key_id', $filters['key_id']);
        }

        if (!empty($filters['location_id'])) {
            $query->whereHas('key', function ($q) use ($filters) {
                $q->where('location_id', $filters['location_id']);
            });
        }

        if (!empty($filters['receiver_id'])) {
            $query->where('receiver_user_id', $filters['receiver_id']);
        }

        if (!empty($filters['action'])) {
            $query->where('action', $filters['action']);
        }

        // Use paginate with appends to preserve filters
        $logs = $query->orderBy('created_at', 'desc')->paginate(20);

        // Append all filters to pagination links
        $logs->appends($filters);

        $keys = Key::all();
        $locations = Location::all();
        $receivers = User::role('security')->get();

        return view('reports.key-activity', compact('logs', 'filters', 'keys', 'locations', 'receivers'));
    }

    public function currentHolders()
    {
        $currentHolders = KeyLog::openCheckouts()
            ->with(['key.location', 'holder', 'receiver'])
            ->latest()
            ->paginate(50);

        return view('reports.current-holders', compact('currentHolders'));
    }

    public function overdueKeys()
    {
        $overdueKeys = KeyLog::overdue()
            ->with(['key.location', 'holder', 'receiver'])
            ->latest()
            ->paginate(50);

        return view('reports.overdue-keys', compact('overdueKeys'));
    }

    public function staffActivity(Request $request)
    {
        // Set default dates if not provided
        $defaultStartDate = now()->subDays(30)->format('Y-m-d');
        $defaultEndDate = now()->format('Y-m-d');

        $filters = $request->validate([
            'start_date' => 'sometimes|date',
            'end_date' => 'sometimes|date|after_or_equal:start_date',
            'staff_type' => 'nullable|in:hr,perm_manual,temp',
        ]);

        // Set default values if not provided
        $filters['start_date'] = $filters['start_date'] ?? $defaultStartDate;
        $filters['end_date'] = $filters['end_date'] ?? $defaultEndDate;

        $query = KeyLog::with(['key.location', 'receiver'])
            ->whereBetween('created_at', [$filters['start_date'] . ' 00:00:00', $filters['end_date'] . ' 23:59:59'])
            ->where('action', 'checkout');

        if (!empty($filters['staff_type'])) {
            $query->where('holder_type', $filters['staff_type']);
        }

        // Get the raw data first
        $rawData = $query->get();

        // Process data manually for SQLite compatibility
        $groupedData = $rawData->groupBy(function($log) {
            return $log->holder_type . '-' . $log->holder_id;
        });

        $processedData = collect();
        
        foreach ($groupedData as $group => $logs) {
            $firstLog = $logs->first();
            $totalCheckouts = $logs->count();
            
            // Calculate average duration manually
            $totalDuration = 0;
            $validDurations = 0;
            
            foreach ($logs as $log) {
                $checkinLog = KeyLog::where('returned_from_log_id', $log->id)->first();
                if ($checkinLog) {
                    $duration = $checkinLog->created_at->diffInMinutes($log->created_at);
                    $totalDuration += $duration;
                    $validDurations++;
                }
            }
            
            $avgDuration = $validDurations > 0 ? $totalDuration / $validDurations : null;

            $processedData->push([
                'holder_type' => $firstLog->holder_type,
                'holder_id' => $firstLog->holder_id,
                'holder_name' => $firstLog->holder_name,
                'holder_phone' => $firstLog->holder_phone,
                'total_checkouts' => $totalCheckouts,
                'avg_duration_minutes' => $avgDuration,
            ]);
        }

        // Sort by total checkouts and paginate manually
        $sortedData = $processedData->sortByDesc('total_checkouts')->values();
        
        // Manual pagination
        $page = $request->get('page', 1);
        $perPage = 20;
        $currentPageResults = $sortedData->slice(($page - 1) * $perPage, $perPage)->all();
        
        $staffActivity = new \Illuminate\Pagination\LengthAwarePaginator(
            $currentPageResults,
            $sortedData->count(),
            $perPage,
            $page,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        return view('reports.staff-activity', compact('staffActivity', 'filters'));
    }

    public function securityPerformance(Request $request)
    {
        $filters = $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $performance = User::role('security')
            ->withCount(['keyLogsAsReceiver as total_transactions' => function($query) use ($filters) {
                $query->whereBetween('created_at', [$filters['start_date'], $filters['end_date']]);
            }])
            ->withCount(['keyLogsAsReceiver as checkout_count' => function($query) use ($filters) {
                $query->where('action', 'checkout')
                      ->whereBetween('created_at', [$filters['start_date'], $filters['end_date']]);
            }])
            ->withCount(['keyLogsAsReceiver as checkin_count' => function($query) use ($filters) {
                $query->where('action', 'checkin')
                      ->whereBetween('created_at', [$filters['start_date'], $filters['end_date']]);
            }])
            ->having('total_transactions', '>', 0)
            ->orderBy('total_transactions', 'desc')
            ->paginate(20);

        return view('reports.security-performance', compact('performance', 'filters'));
    }

    public function analyticsDashboard()
    {
        $today = now()->format('Y-m-d');
        $weekAgo = now()->subDays(7)->format('Y-m-d');

        // Basic stats - SQLite compatible queries
        $stats = [
            'today_checkouts' => KeyLog::whereDate('created_at', $today)
                ->where('action', 'checkout')
                ->count(),
            'week_checkouts' => KeyLog::whereDate('created_at', '>=', $weekAgo)
                ->where('action', 'checkout')
                ->count(),
            'avg_checkout_duration' => $this->calculateAverageDuration($weekAgo),
            'busiest_location' => $this->getBusiestLocation($weekAgo),
        ];

        // Hourly activity for today - SQLite compatible
        $hourlyActivity = KeyLog::whereDate('created_at', $today)
            ->where('action', 'checkout')
            ->select(
                DB::raw('strftime("%H", created_at) as hour'),
                DB::raw('COUNT(*) as count')
            )
            ->groupBy('hour')
            ->orderBy('hour')
            ->get()
            ->pluck('count', 'hour');

        // Top keys this week
        $topKeys = Key::withCount(['keyLogs as recent_checkouts' => function($query) use ($weekAgo) {
                $query->where('action', 'checkout')
                      ->whereDate('key_logs.created_at', '>=', $weekAgo);
            }])
            ->orderBy('recent_checkouts', 'desc')
            ->limit(10)
            ->get();

        return view('reports.analytics', compact('stats', 'hourlyActivity', 'topKeys'));
    }

    /**
     * Calculate average checkout duration in minutes (SQLite compatible)
     */
    private function calculateAverageDuration($sinceDate)
    {
        // Get checkin logs with their corresponding checkout logs
        $checkinLogs = KeyLog::with('returnedFromLog')
            ->where('action', 'checkin')
            ->whereDate('created_at', '>=', $sinceDate)
            ->whereNotNull('returned_from_log_id')
            ->get();

        if ($checkinLogs->isEmpty()) {
            return 0;
        }

        $totalMinutes = 0;
        $validLogs = 0;

        foreach ($checkinLogs as $checkinLog) {
            if ($checkinLog->returnedFromLog) {
                $duration = $checkinLog->created_at->diffInMinutes($checkinLog->returnedFromLog->created_at);
                $totalMinutes += $duration;
                $validLogs++;
            }
        }

        return $validLogs > 0 ? round($totalMinutes / $validLogs) : 0;
    }

    /**
     * Get busiest location with explicit table names to avoid ambiguity
     */
    private function getBusiestLocation($sinceDate)
    {
        // Get locations with their checkout counts
        $locations = Location::withCount(['keyLogs as recent_checkouts' => function($query) use ($sinceDate) {
                $query->where('action', 'checkout')
                      ->whereDate('key_logs.created_at', '>=', $sinceDate);
            }])
            ->orderBy('recent_checkouts', 'desc')
            ->limit(1)
            ->get();

        return $locations->first();
    }

    public function exportKeyActivity(Request $request)
    {
        $filters = $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'format' => 'required|in:csv,excel,pdf',
        ]);

        $logs = KeyLog::with(['key.location', 'receiver', 'holder'])
            ->whereBetween('created_at', [$filters['start_date'], $filters['end_date']])
            ->latest()
            ->get();

        if ($filters['format'] === 'csv') {
            return $this->exportToCsv($logs);
        } elseif ($filters['format'] === 'excel') {
            return $this->exportToExcel($logs);
        } else {
            return $this->exportToPdf($logs, $filters);
        }
    }

    private function exportToCsv($logs)
    {
        $fileName = 'key-activity-' . now()->format('Y-m-d') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
        ];

        $callback = function() use ($logs) {
            $file = fopen('php://output', 'w');
            
            // Headers
            fputcsv($file, [
                'Date', 'Time', 'Action', 'Key Code', 'Key Label', 'Location',
                'Holder Name', 'Holder Phone', 'Holder Type', 'Security Officer',
                'Expected Return', 'Verified', 'Discrepancy'
            ]);

            // Data
            foreach ($logs as $log) {
                fputcsv($file, [
                    $log->created_at->format('Y-m-d'),
                    $log->created_at->format('H:i:s'),
                    $log->action,
                    $log->key->code,
                    $log->key->label,
                    $log->key->location->full_address,
                    $log->holder_name,
                    $log->holder_phone,
                    $log->holder_type_label,
                    $log->receiver_name,
                    $log->expected_return_at ? $log->expected_return_at->format('Y-m-d H:i') : 'N/A',
                    $log->verified ? 'Yes' : 'No',
                    $log->discrepancy ? 'Yes' : 'No',
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    private function exportToExcel($logs)
    {
        // Implementation for Excel export
        // This would use Maatwebsite/Excel package
        return response()->json(['message' => 'Excel export to be implemented']);
    }

    private function exportToPdf($logs, $filters)
    {
        // Implementation for PDF export
        // This would use DomPDF or similar
        return response()->json(['message' => 'PDF export to be implemented']);
    }
}
