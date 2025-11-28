<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Key;
use App\Models\Student;

class SecurityController extends Controller
{
    public function dashboard()
    {
        $totalKeys = Key::count();
        $availableKeys = Key::where('status', 'available')->count();
        $borrowedKeys = Key::where('status', 'borrowed')->count();
        $maintenanceKeys = Key::where('status', 'maintenance')->count();
        
        $recentBorrowed = Key::where('status', 'borrowed')
                            ->with('student')
                            ->latest()
                            ->take(5)
                            ->get();

        return view('security.dashboard', compact(
            'totalKeys',
            'availableKeys',
            'borrowedKeys',
            'maintenanceKeys',
            'recentBorrowed'
        ));
    }
}