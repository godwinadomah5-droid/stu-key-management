@extends('layouts.app')

@section('title', 'Register - KeySecure')

@section('content')
<div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8" style="background-color: var(--bg-primary);">
    <div class="max-w-md w-full space-y-8">
        <div class="text-center">
            <i class="fas fa-key text-4xl mb-4" style="color: var(--accent-primary);"></i>
            <h2 class="text-3xl font-bold" style="color: var(--text-primary);">Create Account</h2>
            <p class="mt-2 text-sm" style="color: var(--text-secondary);">
                Join KeySecure platform
            </p>
        </div>
        
        <form class="mt-8 space-y-6 card" method="POST" action="{{ route('register') }}">
            @csrf
            
            <div class="space-y-4">
                <div>
                    <label for="name" class="block text-sm font-medium" style="color: var(--text-primary);">
                        Full Name
                    </label>
                    <input id="name" name="name" type="text" required 
                           class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" 
                           style="background-color: var(--bg-primary); border-color: var(--border-color); color: var(--text-primary);"
                           placeholder="Enter your full name">
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium" style="color: var(--text-primary);">
                        Email Address
                    </label>
                    <input id="email" name="email" type="email" required 
                           class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" 
                           style="background-color: var(--bg-primary); border-color: var(--border-color); color: var(--text-primary);"
                           placeholder="Enter your email">
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium" style="color: var(--text-primary);">
                        Password
                    </label>
                    <input id="password" name="password" type="password" required 
                           class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" 
                           style="background-color: var(--bg-primary); border-color: var(--border-color); color: var(--text-primary);"
                           placeholder="Enter your password">
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-medium" style="color: var(--text-primary);">
                        Confirm Password
                    </label>
                    <input id="password_confirmation" name="password_confirmation" type="password" required 
                           class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" 
                           style="background-color: var(--bg-primary); border-color: var(--border-color); color: var(--text-primary);"
                           placeholder="Confirm your password">
                </div>
            </div>

            <div>
                <button type="submit" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white focus:outline-none focus:ring-2 focus:ring-offset-2" 
                        style="background-color: var(--accent-primary);">
                    <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                        <i class="fas fa-user-plus" style="color: white;"></i>
                    </span>
                    Create Account
                </button>
            </div>

            <div class="text-center">
                <p class="text-sm" style="color: var(--text-secondary);">
                    Already have an account? 
                    <a href="{{ route('login') }}" class="font-medium hover:underline" style="color: var(--accent-primary);">
                        Sign in here
                    </a>
                </p>
            </div>
        </form>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
</div>
@endsection