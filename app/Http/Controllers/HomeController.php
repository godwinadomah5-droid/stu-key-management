<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     */
    public function index()
    {
        $user = Auth::user();
        
        // Redirect based on role
        if ($user->role === 'hr') {
            return redirect()->route('hr.dashboard');
        } elseif ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif ($user->role === 'security') {
            return redirect()->route('security.dashboard');
        }
        
        // Default dashboard for other roles
        return view('dashboard', [
            'title' => 'Dashboard',
            'user' => $user
        ]);
    }
    
    /**
     * Show welcome page
     */
    public function welcome()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        
        return view('welcome');
    }
    
    /**
     * User profile page
     */
    public function profile()
    {
        return view('profile', [
            'user' => Auth::user()
        ]);
    }
    
    /**
     * System status page
     */
    public function systemStatus()
    {
        return view('system.status', [
            'title' => 'System Status'
        ]);
    }
    
    /**
     * API: Get user statistics
     */
    public function getUserStats()
    {
        return response()->json([
            'total_users' => \App\Models\User::count(),
            'active_today' => \App\Models\User::where('last_login', '>=', now()->subDay())->count(),
            'new_this_week' => \App\Models\User::where('created_at', '>=', now()->subWeek())->count(),
        ]);
    }
}