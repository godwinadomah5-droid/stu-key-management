<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'STU Key Management System')</title>
    
    <!-- PWA Meta Tags -->
    <meta name="theme-color" content="#3b82f6">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    
    <!-- Styles -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.12.0/dist/cdn.min.js" defer></script>
    
    @stack('styles')
</head>
<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-blue-600 text-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex-shrink-0 flex items-center">
                        <i class="fas fa-key text-xl mr-2"></i>
                        <span class="font-bold text-xl">STU Keys</span>
                    </a>
                    
                    <!-- Primary Navigation -->
                    <div class="hidden sm:ml-6 sm:flex sm:space-x-4">
                        @can('access dashboard')
                        <a href="{{ route('dashboard') }}" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-blue-500 transition {{ request()->routeIs('dashboard') ? 'bg-blue-700' : '' }}">
                            <i class="fas fa-tachometer-alt mr-1"></i> Dashboard
                        </a>
                        @endcan
                        
                        @can('access kiosk')
                        <a href="{{ route('kiosk.index') }}" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-blue-500 transition {{ request()->routeIs('kiosk.*') ? 'bg-blue-700' : '' }}">
                            <i class="fas fa-tablet-alt mr-1"></i> Kiosk
                        </a>
                        @endcan
                        
                        @can('view keys')
                        <a href="{{ route('keys.index') }}" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-blue-500 transition {{ request()->routeIs('keys.*') ? 'bg-blue-700' : '' }}">
                            <i class="fas fa-key mr-1"></i> Keys
                        </a>
                        @endcan
                        
                        @can('manage locations')
                        <a href="{{ route('locations.index') }}" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-blue-500 transition {{ request()->routeIs('locations.*') ? 'bg-blue-700' : '' }}">
                            <i class="fas fa-map-marker-alt mr-1"></i> Locations
                        </a>
                        @elsecan('view locations')
                        <a href="{{ route('locations.index') }}" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-blue-500 transition {{ request()->routeIs('locations.*') ? 'bg-blue-700' : '' }}">
                            <i class="fas fa-map-marker-alt mr-1"></i> Locations
                        </a>
                        @endcan
                        
                        @can('view hr dashboard')
                        <a href="{{ route('hr.dashboard') }}" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-blue-500 transition {{ request()->routeIs('hr.*') ? 'bg-blue-700' : '' }}">
                            <i class="fas fa-users mr-1"></i> HR
                        </a>
                        @endcan
                        
                        @can('view reports')
                        <a href="{{ route('reports.index') }}" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-blue-500 transition {{ request()->routeIs('reports.*') ? 'bg-blue-700' : '' }}">
                            <i class="fas fa-chart-bar mr-1"></i> Reports
                        </a>
                        @endcan

                        @can('manage users')
                        <a href="{{ route('admin.users') }}" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-blue-500 transition {{ request()->routeIs('admin.*') ? 'bg-blue-700' : '' }}">
                            <i class="fas fa-cog mr-1"></i> Admin
                        </a>
                        @endcan
                    </div>
                </div>

                <!-- User Menu -->
                <div class="flex items-center">
                    <div x-data="{ open: false }" class="ml-3 relative">
                        <button @click="open = !open" class="flex items-center text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <span class="sr-only">Open user menu</span>
                            <div class="h-8 w-8 rounded-full bg-blue-500 flex items-center justify-center">
                                <span class="text-white font-medium">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span>
                            </div>
                            <span class="ml-2 hidden sm:block">{{ auth()->user()->name }}</span>
                            <i class="fas fa-chevron-down ml-1 text-sm"></i>
                        </button>

                        <div x-show="open" @click.away="open = false" 
                             class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none z-50">
                            <a href="{{ route('profile.show') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                <i class="fas fa-user mr-2"></i> Profile
                            </a>
                            @can('view own activity')
                            <a href="{{ route('profile.activity') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                <i class="fas fa-history mr-2"></i> Activity Log
                            </a>
                            @endcan
                            @can('view own shift history')
                            <a href="{{ route('profile.shift-history') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                <i class="fas fa-clock mr-2"></i> Shift History
                            </a>
                            @endcan
                            <div class="border-t border-gray-100"></div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    <i class="fas fa-sign-out-alt mr-2"></i> Sign Out
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Mobile Navigation -->
    <div class="sm:hidden bg-blue-600 text-white">
        <div class="px-2 pt-2 pb-3 space-y-1">
            @can('access dashboard')
            <a href="{{ route('dashboard') }}" class="block px-3 py-2 rounded-md text-base font-medium hover:bg-blue-500 {{ request()->routeIs('dashboard') ? 'bg-blue-700' : '' }}">
                <i class="fas fa-tachometer-alt mr-2"></i> Dashboard
            </a>
            @endcan
            @can('access kiosk')
            <a href="{{ route('kiosk.index') }}" class="block px-3 py-2 rounded-md text-base font-medium hover:bg-blue-500 {{ request()->routeIs('kiosk.*') ? 'bg-blue-700' : '' }}">
                <i class="fas fa-tablet-alt mr-2"></i> Kiosk
            </a>
            @endcan
        </div>
    </div>

    <!-- Page Content -->
    <main class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <!-- Page Header -->
        <div class="px-4 py-4 sm:px-0">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">@yield('title')</h1>
                    <p class="mt-1 text-sm text-gray-600">@yield('subtitle', '')</p>
                </div>
                <div class="flex space-x-2">
                    @yield('actions')
                </div>
            </div>
        </div>

        <!-- Flash Messages -->
        @if(session('success'))
        <div class="mb-4 px-4">
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        </div>
        @endif

        @if(session('error'))
        <div class="mb-4 px-4">
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        </div>
        @endif

        @if(session('warning'))
        <div class="mb-4 px-4">
            <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('warning') }}</span>
            </div>
        </div>
        @endif

        <!-- Page Content -->
        <div class="px-4 py-4 sm:px-0">
            @yield('content')
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-gray-200 mt-8">
        <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center">
                <p class="text-sm text-gray-500">
                    &copy; {{ date('Y') }} STU Key Management System. All rights reserved.
                </p>
                <div class="flex space-x-4">
                    <span class="text-sm text-gray-500">v1.0.0</span>
                    @if(auth()->check() && auth()->user()->isOnShift())
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                        <i class="fas fa-circle animate-pulse mr-1"></i> On Shift
                    </span>
                    @endif
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                        {{ ucfirst(auth()->user()->getRoleNames()->first() ?? 'User') }}
                    </span>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script>
        // PWA Service Worker Registration
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', function() {
                navigator.serviceWorker.register('/sw.js')
                    .then(function(registration) {
                        console.log('ServiceWorker registration successful');
                    })
                    .catch(function(error) {
                        console.log('ServiceWorker registration failed: ', error);
                    });
            });
        }

        // Offline detection
        window.addEventListener('online', function() {
            document.documentElement.classList.remove('offline');
            // Trigger sync if needed
            if (typeof window.triggerSync === 'function') {
                window.triggerSync();
            }
        });

        window.addEventListener('offline', function() {
            document.documentElement.classList.add('offline');
        });
    </script>

    @stack('scripts')
</body>
</html>
