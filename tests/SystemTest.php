<?php
// tests/SystemTest.php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use App\Models\User;
use App\Models\Key;
use App\Models\Location;
use App\Models\HrStaff;

class SystemTest extends BaseTestCase
{
    public function test_dashboard_loads()
    {
        $user = User::where('email', 'admin@stu.edu.gh')->first();
        $response = $this->actingAs($user)->get('/dashboard');
        $response->assertStatus(200);
        $response->assertSee('STU Key Management');
    }

    public function test_kiosk_access()
    {
        $user = User::where('email', 'security@stu.edu.gh')->first();
        $response = $this->actingAs($user)->get('/kiosk');
        $response->assertStatus(200);
        $response->assertSee('Kiosk Dashboard');
    }

    public function test_key_management()
    {
        $user = User::where('email', 'admin@stu.edu.gh')->first();
        $response = $this->actingAs($user)->get('/keys');
        $response->assertStatus(200);
        $response->assertSee('Key Management');
    }

    public function test_hr_dashboard()
    {
        $user = User::where('email', 'hr@stu.edu.gh')->first();
        $response = $this->actingAs($user)->get('/hr/dashboard');
        $response->assertStatus(200);
        $response->assertSee('HR Dashboard');
    }

    public function test_reports_access()
    {
        $user = User::where('email', 'auditor@stu.edu.gh')->first();
        $response = $this->actingAs($user)->get('/reports');
        $response->assertStatus(200);
        $response->assertSee('Reports & Analytics');
    }

    public function test_key_checkout_flow()
    {
        $security = User::where('email', 'security@stu.edu.gh')->first();
        $key = Key::where('status', 'available')->first();
        $staff = HrStaff::active()->first();

        if ($key && $staff) {
            $response = $this->actingAs($security)->post("/kiosk/checkout/{$key->id}", [
                'holder_type' => 'hr',
                'holder_id' => $staff->id,
                'holder_name' => $staff->name,
                'holder_phone' => $staff->phone,
                'expected_return_at' => now()->addHours(4)->format('Y-m-d\TH:i'),
                'signature' => 'data:image/png;base64,test_signature_data',
                '_token' => csrf_token(),
            ]);

            $response->assertRedirect();
            $response->assertSessionHas('success');
        }
    }

    public function test_staff_search()
    {
        $user = User::where('email', 'security@stu.edu.gh')->first();
        $response = $this->actingAs($user)->get('/kiosk/search-holder?q=Kwame');
        $response->assertStatus(200);
        $response->assertJsonStructure([]);
    }
}
