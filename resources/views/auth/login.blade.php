@extends('layouts.auth')

@section('content')
<form class="space-y-6" action="{{ route('login') }}" method="POST">
    @csrf
    
    <div>
        <label for="email" class="block text-sm font-medium text-gray-700">
            <i class="fas fa-envelope mr-1 text-green-600"></i> Email Address
        </label>
        <div class="mt-1">
            <input id="email" name="email" type="email" autocomplete="email" required 
                   class="appearance-none block w-full px-3 py-3 border border-gray-300 rounded-lg placeholder-gray-400 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm transition duration-150 ease-in-out"
                   value="{{ old('email') }}"
                   placeholder="staff@stu.edu.gh">
        </div>
    </div>

    <div>
        <label for="password" class="block text-sm font-medium text-gray-700">
            <i class="fas fa-lock mr-1 text-green-600"></i> Password
        </label>
        <div class="mt-1">
            <input id="password" name="password" type="password" autocomplete="current-password" required 
                   class="appearance-none block w-full px-3 py-3 border border-gray-300 rounded-lg placeholder-gray-400 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm transition duration-150 ease-in-out"
                   placeholder="Enter your password">
        </div>
    </div>

    <div class="flex items-center justify-between">
        <div class="flex items-center">
            <input id="remember_me" name="remember" type="checkbox" 
                   class="h-4 w-4 text-green-600 focus:ring-green-500 border-gray-300 rounded">
            <label for="remember_me" class="ml-2 block text-sm text-gray-900">
                Remember me
            </label>
        </div>

        @if (Route::has('password.request'))
        <div class="text-sm">
            <a href="{{ route('password.request') }}" class="font-medium text-green-600 hover:text-green-500">
                Forgot password?
            </a>
        </div>
        @endif
    </div>

    <div>
        <button type="submit" 
                class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-lg text-white stu-gradient-bg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition duration-150 ease-in-out shadow-md">
            <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                <i class="fas fa-sign-in-alt text-green-300 group-hover:text-green-200"></i>
            </span>
            Sign In to STU System
        </button>
    </div>
</form>

<div class="mt-6">
    <div class="relative">
        <div class="absolute inset-0 flex items-center">
            <div class="w-full border-t border-gray-300"></div>
        </div>
        <div class="relative flex justify-center text-sm">
            <span class="px-2 bg-white text-gray-500">
                System Access Information
            </span>
        </div>
    </div>
    <div class="mt-4 text-center">
        <p class="text-sm text-gray-600">
            <i class="fas fa-info-circle mr-1 text-green-600"></i>
            Contact IT Department for account access
        </p>
        <p class="text-xs text-gray-500 mt-1">
            Email: it-support@stu.edu.gh | Phone: Ext. 1234
        </p>
    </div>
</div>

<!-- Demo Credentials (Remove in production) -->
<div class="mt-8 bg-green-50 border border-green-200 rounded-lg p-4">
    <h4 class="text-sm font-medium text-green-800 mb-2">
        <i class="fas fa-user-secret mr-1"></i> Demo Credentials
    </h4>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-2 text-xs">
        <div class="bg-white p-2 rounded border">
            <span class="font-medium text-green-700">Admin</span><br>
            admin@stu.edu.gh<br>
            admin123
        </div>
        <div class="bg-white p-2 rounded border">
            <span class="font-medium text-green-700">Security</span><br>
            security@stu.edu.gh<br>
            security123
        </div>
        <div class="bg-white p-2 rounded border">
            <span class="font-medium text-green-700">HR</span><br>
            hr@stu.edu.gh<br>
            hr123
        </div>
        <div class="bg-white p-2 rounded border">
            <span class="font-medium text-green-700">Auditor</span><br>
            auditor@stu.edu.gh<br>
            auditor123
        </div>
    </div>
    <p class="text-xs text-red-600 mt-2">
        <i class="fas fa-exclamation-triangle mr-1"></i>
        Change passwords in production!
    </p>
</div>
@endsection
