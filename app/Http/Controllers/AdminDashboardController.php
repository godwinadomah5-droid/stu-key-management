<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function keys()
    {
        return view('admin.keys');
    }

    public function users()
    {
        return view('admin.users');
    }

    public function reports()
    {
        return view('admin.reports');
    }

    public function settings()
    {
        return view('admin.settings');
    }

    // API Methods
    public function getStats()
    {
        return response()->json([
            'total_keys' => 1247,
            'active_sessions' => 89,
            'security_alerts' => 3,
            'keys_rotation' => 18,
            'system_health' => 95,
            'encryption_usage' => 78,
            'users_online' => 23,
            'api_requests' => 456
        ]);
    }

    public function getActivity()
    {
        return response()->json([
            [
                'id' => 1,
                'type' => 'key_generated',
                'title' => 'New Encryption Key Created',
                'description' => 'AES-256 key generated for Database Cluster A',
                'time' => '2 mins ago',
                'icon' => 'key',
                'color' => 'green',
                'priority' => 'low'
            ],
            [
                'id' => 2,
                'type' => 'security_alert',
                'title' => 'Suspicious Access Attempt',
                'description' => 'Multiple failed login attempts detected',
                'time' => '15 mins ago',
                'icon' => 'shield-exclamation',
                'color' => 'red',
                'priority' => 'high'
            ],
            [
                'id' => 3,
                'type' => 'user_activity',
                'title' => 'New Admin User Added',
                'description' => 'Dr. Smith granted administrator access',
                'time' => '1 hour ago',
                'icon' => 'user-plus',
                'color' => 'blue',
                'priority' => 'medium'
            ],
            [
                'id' => 4,
                'type' => 'system_update',
                'title' => 'Security Patch Applied',
                'description' => 'Latest encryption protocols updated',
                'time' => '2 hours ago',
                'icon' => 'download',
                'color' => 'purple',
                'priority' => 'medium'
            ]
        ]);
    }

    public function getSecurityData()
    {
        return response()->json([
            'threat_level' => 'low',
            'encryption_types' => [
                'AES-256' => 45,
                'RSA-2048' => 30,
                'ECC' => 15,
                'Other' => 10
            ],
            'access_patterns' => [65, 59, 80, 81, 56, 55, 40],
            'security_events' => [12, 8, 15, 6, 9, 11, 7]
        ]);
    }
}