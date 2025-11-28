<!DOCTYPE html>
<html>
<head>
    <title>Analytics - KeySecure</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-100 min-h-screen">
    <!-- Navigation -->
    <nav class="bg-white shadow-sm border-b">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <i class="fas fa-key text-xl text-blue-600 mr-3"></i>
                    <span class="font-bold text-xl text-gray-800">KeySecure</span>
                </div>
                
                <div class="flex items-center space-x-4">
                    @if(auth()->check())
                        <span class="text-gray-700 font-medium">{{ auth()->user()->name }}</span>
                        <form method="POST" action="/logout">
                            @csrf
                            <button type="submit" class="text-gray-600 hover:text-gray-900">
                                <i class="fas fa-sign-out-alt mr-1"></i>Logout
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="flex">
        <!-- Sidebar -->
        <div class="w-64 bg-white min-h-screen border-r">
            <nav class="mt-6">
                <div class="px-4 space-y-2">
                    <a href="/dashboard" class="flex items-center px-4 py-3 text-gray-600 hover:bg-gray-100 rounded-lg">
                        <i class="fas fa-tachometer-alt mr-3"></i>Main Dashboard
                    </a>
                    <a href="/users" class="flex items-center px-4 py-3 text-gray-600 hover:bg-gray-100 rounded-lg">
                        <i class="fas fa-users mr-3"></i>User Management
                    </a>
                    <a href="/keys" class="flex items-center px-4 py-3 text-gray-600 hover:bg-gray-100 rounded-lg">
                        <i class="fas fa-key mr-3"></i>Key Management
                    </a>
                    <a href="/security" class="flex items-center px-4 py-3 text-gray-600 hover:bg-gray-100 rounded-lg">
                        <i class="fas fa-shield-alt mr-3"></i>Security
                    </a>
                    <a href="/analytics" class="flex items-center px-4 py-3 bg-blue-100 text-blue-700 rounded-lg">
                        <i class="fas fa-chart-bar mr-3"></i>Analytics
                    </a>
                    <a href="/settings" class="flex items-center px-4 py-3 text-gray-600 hover:bg-gray-100 rounded-lg">
                        <i class="fas fa-cog mr-3"></i>System Settings
                    </a>
                </div>
            </nav>
        </div>

        <!-- Content -->
        <div class="flex-1 p-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Analytics</h1>
            <p class="text-gray-600 mb-8">System performance and usage statistics</p>

            <!-- Analytics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                <div class="bg-white p-6 rounded-lg shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600">Total API Requests</p>
                            <p class="text-2xl font-bold text-gray-800">12,847</p>
                        </div>
                        <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                            <i class="fas fa-chart-line"></i>
                        </div>
                    </div>
                    <p class="text-xs text-gray-500 mt-2">+12% from last week</p>
                </div>
                
                <div class="bg-white p-6 rounded-lg shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600">Active Sessions</p>
                            <p class="text-2xl font-bold text-gray-800">3</p>
                        </div>
                        <div class="p-3 rounded-full bg-green-100 text-green-600">
                            <i class="fas fa-users"></i>
                        </div>
                    </div>
                    <p class="text-xs text-gray-500 mt-2">All users active</p>
                </div>
                
                <div class="bg-white p-6 rounded-lg shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600">System Uptime</p>
                            <p class="text-2xl font-bold text-gray-800">99.9%</p>
                        </div>
                        <div class="p-3 rounded-full bg-purple-100 text-purple-600">
                            <i class="fas fa-server"></i>
                        </div>
                    </div>
                    <p class="text-xs text-gray-500 mt-2">Last 30 days</p>
                </div>
            </div>

            <!-- Charts Placeholder -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div class="bg-white p-6 rounded-lg shadow">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Key Usage Trends</h3>
                    <div class="h-64 bg-gray-100 rounded flex items-center justify-center">
                        <p class="text-gray-500">Chart would be displayed here</p>
                    </div>
                </div>
                
                <div class="bg-white p-6 rounded-lg shadow">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">User Activity</h3>
                    <div class="h-64 bg-gray-100 rounded flex items-center justify-center">
                        <p class="text-gray-500">Chart would be displayed here</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>