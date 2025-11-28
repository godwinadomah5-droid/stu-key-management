<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Request $request)
    {
        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        // Check if user exists and create demo user if needed
        $user = $this->findOrCreateDemoUser($request->email);

        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    /**
     * Validate the user login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function validateLogin(Request $request)
    {
        $request->validate([
            $this->username() => 'required|string',
            'password' => 'required|string',
        ]);
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return 'email';
    }

    /**
     * Attempt to log the user into the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function attemptLogin(Request $request)
    {
        // For demo purposes, allow any STU email with correct demo password
        if ($this->isDemoEmail($request->email)) {
            $user = $this->findOrCreateDemoUser($request->email);
            
            if ($user && Hash::check($request->password, $user->password)) {
                Auth::login($user, $request->filled('remember'));
                return true;
            }
        }

        return $this->guard()->attempt(
            $this->credentials($request), $request->filled('remember')
        );
    }

    /**
     * Check if email is a demo STU email
     *
     * @param string $email
     * @return bool
     */
    protected function isDemoEmail($email)
    {
        return str_ends_with($email, '@stuniversity.edu') && 
               in_array($email, [
                   'admin@stuniversity.edu',
                   'hr@stuniversity.edu', 
                   'security@stuniversity.edu'
               ]);
    }

    /**
     * Find or create demo user for testing
     *
     * @param string $email
     * @return User|null
     */
    protected function findOrCreateDemoUser($email)
    {
        if (!$this->isDemoEmail($email)) {
            return User::where('email', $email)->first();
        }

        $user = User::where('email', $email)->first();

        if (!$user) {
            $user = User::create([
                'name' => $this->getDemoUserName($email),
                'email' => $email,
                'password' => Hash::make($this->getDemoPassword($email)),
                'role' => $this->getDemoUserRole($email),
                'email_verified_at' => now(),
            ]);
        }

        return $user;
    }

    /**
     * Get demo user name based on email
     *
     * @param string $email
     * @return string
     */
    protected function getDemoUserName($email)
    {
        $names = [
            'admin@stuniversity.edu' => 'System Administrator',
            'hr@stuniversity.edu' => 'HR Manager',
            'security@stuniversity.edu' => 'Security Officer'
        ];

        return $names[$email] ?? 'Demo User';
    }

    /**
     * Get demo password based on email
     *
     * @param string $email
     * @return string
     */
    protected function getDemoPassword($email)
    {
        $passwords = [
            'admin@stuniversity.edu' => 'admin123',
            'hr@stuniversity.edu' => 'hr123',
            'security@stuniversity.edu' => 'security123'
        ];

        return $passwords[$email] ?? 'password123';
    }

    /**
     * Get demo user role based on email
     *
     * @param string $email
     * @return string
     */
    protected function getDemoUserRole($email)
    {
        $roles = [
            'admin@stuniversity.edu' => 'admin',
            'hr@stuniversity.edu' => 'hr',
            'security@stuniversity.edu' => 'security'
        ];

        return $roles[$email] ?? 'user';
    }

    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        // Log login activity
        activity()
            ->causedBy($user)
            ->log('logged in');

        return redirect()->intended($this->redirectPath())
            ->with('success', 'Welcome back, ' . $user->name . '!');
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        // Log logout activity
        if (Auth::check()) {
            activity()
                ->causedBy(Auth::user())
                ->log('logged out');
        }

        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/')
            ->with('success', 'You have been logged out successfully.');
    }

    /**
     * Get the failed login response instance.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function sendFailedLoginResponse(Request $request)
    {
        throw ValidationException::withMessages([
            $this->username() => [trans('auth.failed')],
        ]);
    }

    /**
     * Emergency login for demo purposes (optional)
     * This allows any STU email to login with any password
     */
    public function emergencyLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email|ends_with:@stuniversity.edu',
        ]);

        // Find or create user
        $user = User::firstOrCreate(
            ['email' => $request->email],
            [
                'name' => $this->generateNameFromEmail($request->email),
                'password' => Hash::make('emergency123'),
                'role' => $this->getRoleFromEmail($request->email),
                'email_verified_at' => now(),
            ]
        );

        // Log the user in
        Auth::login($user);

        return redirect()->intended($this->redirectPath())
            ->with('success', 'Emergency login successful! Welcome ' . $user->name);
    }

    /**
     * Generate a name from email for emergency login
     */
    protected function generateNameFromEmail($email)
    {
        $username = strstr($email, '@', true);
        return ucwords(str_replace('.', ' ', $username)) . ' User';
    }

    /**
     * Get role from email for emergency login
     */
    protected function getRoleFromEmail($email)
    {
        if (str_contains($email, 'admin')) return 'admin';
        if (str_contains($email, 'hr')) return 'hr';
        if (str_contains($email, 'security')) return 'security';
        return 'user';
    }
}