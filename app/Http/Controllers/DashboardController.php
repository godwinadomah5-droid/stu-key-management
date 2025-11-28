<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function redirectToRoleDashboard()
    {
        $user = Auth::user();
        
        if ($user->isAdmin()) {
            return redirect()->route('admin.dashboard');
        } elseif ($user->isHR()) {
            return redirect()->route('hr.dashboard');
        } elseif ($user->isSecurity()) {
            return redirect()->route('security.dashboard');
        }
        
        return redirect('/');
    }
}