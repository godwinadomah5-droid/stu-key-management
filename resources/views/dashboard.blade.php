<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard - KeySecure</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        :root {
            --primary-color: #3b82f6;
            --secondary-color: #1e40af;
            --accent-color: #8b5cf6;
            --success-color: #10b981;
            --warning-color: #f59e0b;
            --danger-color: #ef4444;
        }

        .dark-mode {
            --bg-primary: #0f172a;
            --bg-secondary: #1e293b;
            --bg-card: #1e293b;
            --text-primary: #f1f5f9;
            --text-secondary: #cbd5e1;
            --border-color: #374151;
        }

        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            transition: all 0.3s ease;
        }

        .dark-mode body {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 16px;
        }

        .dark-mode .glass-card {
            background: rgba(30, 41, 59, 0.7);
            border: 1px solid rgba(55, 65, 81, 0.5);
        }

        .stat-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-color), var(--accent-color));
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .dark-mode .stat-card {
            background: var(--bg-card);
            color: var(--text-primary);
        }

        .sidebar {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
        }

        .dark-mode .sidebar {
            background: rgba(15, 23, 42, 0.95);
        }

        .nav-item {
            transition: all 0.3s ease;
            border-radius: 8px;
            margin: 2px 0;
        }

        .nav-item:hover {
            background: rgba(59, 130, 246, 0.1);
            transform: translateX(5px);
        }

        .nav-item.active {
            background: var(--primary-color);
            color: white;
        }

        .progress-bar {
            background: #e5e7eb;
            border-radius: 10px;
            overflow: hidden;
            height: 8px;
        }

        .progress-fill {
            height: 100%;
            border-radius: 10px;
            transition: width 1s ease-in-out;
            background: linear-gradient(90deg, var(--success-color), var(--primary-color));
        }

        .notification-dot {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }

        .chart-container {
            background: white;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        .dark-mode .chart-container {
            background: var(--bg-card);
        }

        .quick-action {
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }

        .quick-action:hover {
            border-color: var(--primary-color);
            transform: scale(1.05);
        }

        .user-avatar {
            background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
        }
    </style>
</head>
<body class="min-h-screen">
    <!-- Dark Mode Toggle -->
    <button id="darkModeToggle" class="fixed top-6 right-6 z-50 w-12 h-12 rounded-full glass-card flex items-center justify-center text-white hover:scale-110 transition-transform duration-200">
        <i class="fas fa-moon" id="darkModeIcon"></i>
    </button>

    <!-- Notification Bell -->
    <div class="fixed top-6 right-24 z-50">
        <button id="notificationBell" class="w-12 h-12 rounded-full glass-card flex items-center justify-center text-white hover:scale-110 transition-transform duration-200 relative">
            <i class="fas fa-bell"></i>
            <span class="notification-dot absolute top-2 right-2 w-3 h-3 bg-red-500 rounded-full"></span>
        </button>
    </div>

    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <div class="sidebar w-80 min-h-screen border-r border-gray-200 dark:border-gray-700">
            <!-- Logo -->
            <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-r from-blue-500 to-purple-600 flex items-center justify-center">
                        <i class="fas fa-key text-white text-lg"></i>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold text-gray-800 dark:text-white">KeySecure</h1>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Admin Portal</p>
                    </div>
                </div>
            </div>

            <!-- User Profile -->
            <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                <div class="flex items-center space-x-4">
                    <div class="user-avatar w-12 h-12 rounded-full flex items-center justify-center text-white font-bold text-lg">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-semibold text-gray-900 dark:text-white truncate">{{ auth()->user()->name }}</p>
                        <p class="text-sm text-gray-500 dark:text-gray-400 truncate">{{ auth()->user()->email }}</p>
                        <div class="flex items-center mt-1">
                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300">
                                <i class="fas fa-shield-alt mr-1"></i>
                                {{ ucfirst(auth()->user()->username) }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="p-4 space-y-1">
                <a href="/dashboard" class="nav-item active flex items-center px-4 py-3 text-sm font-medium text-white bg-blue-500">
                    <i class="fas fa-tachometer-alt mr-3 text-lg"></i>
                    Dashboard
                    <span class="ml-auto bg-white bg-opacity-20 px-2 py-1 rounded text-xs">Home</span>
                </a>
                <a href="/users" class="nav-item flex items-center px-4 py-3 text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400">
                    <i class="fas fa-users mr-3 text-lg"></i>
                    User Management
                </a>
                <a href="/keys" class="nav-item flex items-center px-4 py-3 text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400">
                    <i class="fas fa-key mr-3 text-lg"></i>
                    Key Management
                    <span class="ml-auto bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300 px-2 py-1 rounded text-xs">5</span>
                </a>
                <a href="/security" class="nav-item flex items-center px-4 py-3 text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400">
                    <i class="fas fa-shield-alt mr-3 text-lg"></i>
                    Security Center
                </a>
                <a href="/analytics" class="nav-item flex items-center px-4 py-3 text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400">
                    <i class="fas fa-chart-bar mr-3 text-lg"></i>
                    Analytics
                </a>
                <a href="/settings" class="nav-item flex items-center px-4 py-3 text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400">
                    <i class="fas fa-cog mr-3 text-lg"></i>
                    System Settings
                </a>
            </nav>

            <!-- System Status -->
            <div class="p-4 mt-8 mx-4 rounded-lg bg-gradient-to-r from-green-500 to-emerald-600 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium">System Status</p>
                        <p class="text-2xl font-bold">Operational</p>
                    </div>
                    <i class="fas fa-check-circle text-2xl"></i>
                </div>
                <div class="mt-2 text-xs opacity-90">All systems running normally</div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 p-8">
            <!-- Header -->
            <div class="mb-8">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-bold text-white">Admin Dashboard</h1>
                        <p class="text-blue-100 mt-2">Welcome back, {{ auth()->user()->name }}! Here's what's happening today.</p>
                    </div>
                    <div class="flex items-center space-x-4">
                        <div class="glass-card px-4 py-2 rounded-lg">
                            <div class="text-sm text-white opacity-90">Last Login</div>
                            <div class="text-white font-semibold" id="lastLoginTime">Just now</div>
                        </div>
                        <form method="POST" action="/logout">
                            @csrf
                            <button type="submit" class="glass-card px-4 py-2 rounded-lg text-white hover:bg-red-500 transition-colors duration-200">
                                <i class="fas fa-sign-out-alt mr-2"></i>Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="stat-card p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Total Users</p>
                            <p class="text-2xl font-bold text-gray-900 dark:text-white">3</p>
                            <div class="flex items-center mt-1">
                                <span class="text-xs text-green-600 dark:text-green-400 font-medium">+2 this week</span>
                            </div>
                        </div>
                        <div class="p-3 rounded-full bg-blue-100 dark:bg-blue-900 text-blue-600 dark:text-blue-400">
                            <i class="fas fa-users text-xl"></i>
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="progress-bar">
                            <div class="progress-fill" style="width: 75%"></div>
                        </div>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Capacity: 75% used</p>
                    </div>
                </div>

                <div class="stat-card p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Active Keys</p>
                            <p class="text-2xl font-bold text-gray-900 dark:text-white">5</p>
                            <div class="flex items-center mt-1">
                                <span class="text-xs text-green-600 dark:text-green-400 font-medium">All secure</span>
                            </div>
                        </div>
                        <div class="p-3 rounded-full bg-green-100 dark:bg-green-900 text-green-600 dark:text-green-400">
                            <i class="fas fa-key text-xl"></i>
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="progress-bar">
                            <div class="progress-fill" style="width: 45%"></div>
                        </div>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">45% of quota used</p>
                    </div>
                </div>

                <div class="stat-card p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600 dark:text-gray-400">System Health</p>
                            <p class="text-2xl font-bold text-gray-900 dark:text-white">94%</p>
                            <div class="flex items-center mt-1">
                                <span class="text-xs text-green-600 dark:text-green-400 font-medium">Optimal</span>
                            </div>
                        </div>
                        <div class="p-3 rounded-full bg-yellow-100 dark:bg-yellow-900 text-yellow-600 dark:text-yellow-400">
                            <i class="fas fa-heartbeat text-xl"></i>
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="progress-bar">
                            <div class="progress-fill" style="width: 94%"></div>
                        </div>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Performance score</p>
                    </div>
                </div>

                <div class="stat-card p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Security Score</p>
                            <p class="text-2xl font-bold text-gray-900 dark:text-white">A+</p>
                            <div class="flex items-center mt-1">
                                <span class="text-xs text-green-600 dark:text-green-400 font-medium">Excellent</span>
                            </div>
                        </div>
                        <div class="p-3 rounded-full bg-purple-100 dark:bg-purple-900 text-purple-600 dark:text-purple-400">
                            <i class="fas fa-shield-alt text-xl"></i>
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="progress-bar">
                            <div class="progress-fill" style="width: 98%"></div>
                        </div>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">98% secure</p>
                    </div>
                </div>
            </div>

            <!-- Charts and Quick Actions -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
                <!-- Activity Chart -->
                <div class="lg:col-span-2 chart-container">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">System Activity</h3>
                        <select class="text-sm border border-gray-300 dark:border-gray-600 rounded px-3 py-1 bg-transparent">
                            <option>Last 7 days</option>
                            <option>Last 30 days</option>
                            <option>Last 90 days</option>
                        </select>
                    </div>
                    <canvas id="activityChart" height="250"></canvas>
                </div>

                <!-- Quick Actions -->
                <div class="space-y-4">
                    <h3 class="text-lg font-semibold text-white mb-4">Quick Actions</h3>
                    
                    <button class="quick-action w-full p-4 rounded-xl glass-card text-white text-left transition-all duration-300">
                        <div class="flex items-center justify-between">
                            <div>
                                <i class="fas fa-user-plus text-2xl mb-2"></i>
                                <p class="font-semibold">Add User</p>
                                <p class="text-sm opacity-80">Create new system user</p>
                            </div>
                            <i class="fas fa-arrow-right opacity-60"></i>
                        </div>
                    </button>

                    <button class="quick-action w-full p-4 rounded-xl glass-card text-white text-left transition-all duration-300">
                        <div class="flex items-center justify-between">
                            <div>
                                <i class="fas fa-key text-2xl mb-2"></i>
                                <p class="font-semibold">Generate Key</p>
                                <p class="text-sm opacity-80">Create encryption key</p>
                            </div>
                            <i class="fas fa-arrow-right opacity-60"></i>
                        </div>
                    </button>

                    <button class="quick-action w-full p-4 rounded-xl glass-card text-white text-left transition-all duration-300">
                        <div class="flex items-center justify-between">
                            <div>
                                <i class="fas fa-shield-alt text-2xl mb-2"></i>
                                <p class="font-semibold">Security Scan</p>
                                <p class="text-sm opacity-80">Run system audit</p>
                            </div>
                            <i class="fas fa-arrow-right opacity-60"></i>
                        </div>
                    </button>

                    <button class="quick-action w-full p-4 rounded-xl glass-card text-white text-left transition-all duration-300">
                        <div class="flex items-center justify-between">
                            <div>
                                <i class="fas fa-chart-bar text-2xl mb-2"></i>
                                <p class="font-semibold">View Reports</p>
                                <p class="text-sm opacity-80">System analytics</p>
                            </div>
                            <i class="fas fa-arrow-right opacity-60"></i>
                        </div>
                    </button>
                </div>
            </div>

            <!-- Recent Activity & System Status -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Recent Activity -->
                <div class="chart-container">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Recent Activity</h3>
                    <div class="space-y-4">
                        <div class="flex items-center space-x-3 p-3 hover:bg-gray-50 dark:hover:bg-gray-800 rounded-lg transition-colors duration-200">
                            <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-900 dark:text-white">User login</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">System Administrator logged in</p>
                            </div>
                            <span class="text-xs text-gray-500 dark:text-gray-400">2 min ago</span>
                        </div>
                        <div class="flex items-center space-x-3 p-3 hover:bg-gray-50 dark:hover:bg-gray-800 rounded-lg transition-colors duration-200">
                            <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-900 dark:text-white">Key rotation</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Master key rotated successfully</p>
                            </div>
                            <span class="text-xs text-gray-500 dark:text-gray-400">1 hour ago</span>
                        </div>
                        <div class="flex items-center space-x-3 p-3 hover:bg-gray-50 dark:hover:bg-gray-800 rounded-lg transition-colors duration-200">
                            <div class="w-2 h-2 bg-purple-500 rounded-full"></div>
                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-900 dark:text-white">Backup completed</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">System backup successful</p>
                            </div>
                            <span class="text-xs text-gray-500 dark:text-gray-400">3 hours ago</span>
                        </div>
                    </div>
                </div>

                <!-- System Status -->
                <div class="chart-container">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">System Status</h3>
                    <div class="space-y-3">
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-600 dark:text-gray-400">Database</span>
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300">
                                <i class="fas fa-check mr-1"></i>Online
                            </span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-600 dark:text-gray-400">API Services</span>
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300">
                                <i class="fas fa-check mr-1"></i>Operational
                            </span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-600 dark:text-gray-400">Encryption Engine</span>
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300">
                                <i class="fas fa-check mr-1"></i>Active
                            </span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-600 dark:text-gray-400">Backup System</span>
                            <span class="inline-flex items