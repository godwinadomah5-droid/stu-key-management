<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/dashboard';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function authenticated(Request $request, $user)
    {
        // Update last login
        $user->update([
            'last_login_at' => now(),
        ]);

        // Redirect based on user role
        if ($user->hasRole('admin')) {
            return redirect()->route('dashboard');
        } elseif ($user->hasRole('security')) {
            return redirect()->route('kiosk.index');
        } elseif ($user->hasRole('hr')) {
            return redirect()->route('hr.dashboard');
        } elseif ($user->hasRole('auditor')) {
            return redirect()->route('reports.index');
        }

        return redirect()->route('dashboard');
    }
}
