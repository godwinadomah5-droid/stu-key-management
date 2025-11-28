<!DOCTYPE html>
<html>
<head>
    <title>Security - KeySecure</title>
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
                    <a href="/security" class="flex items-center px-4 py-3 bg-blue-100 text-blue-700 rounded-lg">
                        <i class="fas fa-shield-alt mr-3"></i>Security
                    </a>
                    <a href="/analytics" class="flex items-center px-4 py-3 text-gray-600 hover:bg-gray-100 rounded-lg">
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
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Security Center</h1>
            <p class="text-gray-600 mb-8">Monitor security events and incidents</p>

            <!-- Security Stats -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <div class="bg-white p-6 rounded-lg shadow">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-red-100 text-red-600 mr-4">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Active Incidents</p>
                            <p class="text-2xl font-bold text-gray-800">0</p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white p-6 rounded-lg shadow">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-green-100 text-green-600 mr-4">
                            <i class="fas fa-shield-check"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Security Score</p>
                            <p class="text-2xl font-bold text-gray-800">98%</p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white p-6 rounded-lg shadow">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-blue-100 text-blue-600 mr-4">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Last Scan</p>
                            <p class="text-2xl font-bold text-gray-800">2h ago</p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white p-6 rounded-lg shadow">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-purple-100 text-purple-600 mr-4">
                            <i class="fas fa-user-shield"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">MFA Enabled</p>
                            <p class="text-2xl font-bold text-gray-800">3/3</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="bg-white rounded-lg shadow overflow-hidden mb-8">
                <div class="px-6 py-4 border-b">
                    <h2 class="text-lg font-semibold text-gray-800">Recent Security Activity</h2>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                        <div class="flex items-start space-x-3">
                            <div class="w-2 h-2 bg-green-500 rounded-full mt-2"></div>
                            <div class="flex-1">
                                <p class="font-medium text-gray-800">login success</p>
                                <p class="text-sm text-gray-600">User: System Administrator</p>
                                <p class="text-xs text-gray-500">2 minutes ago</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-3">
                            <div class="w-2 h-2 bg-green-500 rounded-full mt-2"></div>
                            <div class="flex-1">
                                <p class="font-medium text-gray-800">key rotation</p>
                                <p class="text-sm text-gray-600">Master encryption key rotated</p>
                                <p class="text-xs text-gray-500">1 hour ago</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-3">
                            <div class="w-2 h-2 bg-blue-500 rounded-full mt-2"></div>
                            <div class="flex-1">
                                <p class="font-medium text-gray-800">backup completed</p>
                                <p class="text-sm text-gray-600">System backup successful</p>
                                <p class="text-xs text-gray-500">3 hours ago</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>