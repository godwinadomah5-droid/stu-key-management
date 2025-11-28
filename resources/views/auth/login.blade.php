@extends('layouts.auth')

@section('content')
<form class="space-y-6" action="{{ route('login') }}" method="POST">
    @csrf
    
    <div>
        <label for="email" class="block text-sm font-medium text-gray-700">
            Email Address
        </label>
        <div class="mt-1">
            <input id="email" name="email" type="email" autocomplete="email" required 
                   class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                   value="{{ old('email') }}"
                   placeholder="Enter your email">
        </div>
    </div>

    <div>
        <label for="password" class="block text-sm font-medium text-gray-700">
            Password
        </label>
        <div class="mt-1">
            <input id="password" name="password" type="password" autocomplete="current-password" required 
                   class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                   placeholder="Enter your password">
        </div>
    </div>

    <div class="flex items-center justify-between">
        <div class="flex items-center">
            <input id="remember_me" name="remember" type="checkbox" 
                   class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
            <label for="remember_me" class="ml-2 block text-sm text-gray-900">
                Remember me
            </label>
        </div>

        @if (Route::has('password.request'))
        <div class="text-sm">
            <a href="{{ route('password.request') }}" class="font-medium text-blue-600 hover:text-blue-500">
                Forgot your password?
            </a>
        </div>
        @endif
    </div>

    <div>
        <button type="submit" 
                class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
            <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                <i class="fas fa-sign-in-alt text-blue-500 group-hover:text-blue-400"></i>
            </span>
            Sign in
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
                System Access
            </span>
        </div>
    </div>
    <div class="mt-4 text-center">
        <p class="text-sm text-gray-600">
            Contact administrator for account access
        </p>
    </div>
</div>
@endsection
