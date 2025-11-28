<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HrDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashboard()
    {
        return view('hr.dashboard');
    }

    public function employees()
    {
        return view('hr.employees');
    }

    public function attendance()
    {
        return view('hr.attendance');
    }

    public function payroll()
    {
        return view('hr.payroll');
    }

    public function recruitment()
    {
        return view('hr.recruitment');
    }

    public function analytics()
    {
        return view('hr.analytics');
    }

    // API Methods for Dashboard Data
    public function getStats()
    {
        return response()->json([
            'total_employees' => 247,
            'active_recruitments' => 12,
            'pending_approvals' => 8,
            'attendance_rate' => 94.5,
            'department_count' => 8,
            'avg_tenure' => 3.2,
            'active_employees' => 234,
            'on_leave' => 13
        ]);
    }

    public function getRecentActivity()
    {
        return response()->json([
            [
                'type' => 'hire', 
                'message' => 'New security staff hired - John Doe', 
                'time' => '2 hours ago', 
                'icon' => 'user-plus', 
                'color' => 'green',
                'department' => 'Security'
            ],
            [
                'type' => 'leave', 
                'message' => 'Leave request submitted - Sarah Wilson', 
                'time' => '4 hours ago', 
                'icon' => 'calendar-minus', 
                'color' => 'blue',
                'department' => 'IT'
            ],
            [
                'type' => 'payroll', 
                'message' => 'Payroll processed for March', 
                'time' => '1 day ago', 
                'icon' => 'money-bill-wave', 
                'color' => 'purple',
                'department' => 'Finance'
            ],
            [
                'type' => 'training', 
                'message' => 'Security training session completed', 
                'time' => '2 days ago', 
                'icon' => 'graduation-cap', 
                'color' => 'orange',
                'department' => 'Security'
            ],
            [
                'type' => 'promotion', 
                'message' => 'Mike Chen promoted to Senior Security Analyst', 
                'time' => '3 days ago', 
                'icon' => 'star', 
                'color' => 'yellow',
                'department' => 'Security'
            ]
        ]);
    }

    public function getEmployeeData()
    {
        return response()->json([
            'department_distribution' => [
                'Security' => 45,
                'IT' => 38,
                'Administration' => 32,
                'Academic' => 89,
                'Finance' => 28,
                'Facilities' => 38,
                'Research' => 25
            ],
            'attendance_trend' => [92, 94, 93, 95, 96, 94, 95],
            'gender_distribution' => ['Male' => 58, 'Female' => 42],
            'recruitment_status' => [
                'Screening' => 8,
                'Interview' => 3,
                'Offer' => 1,
                'Onboarding' => 2
            ]
        ]);
    }
}