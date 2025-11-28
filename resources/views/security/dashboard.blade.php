<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Security Dashboard - KeySecure</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#27ae60',
                        secondary: '#219a52',
                        dark: '#1a202c'
                    }
                }
            }
        }
    </script>
    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #27ae60 0%, #219a52 100%);
        }
        .stat-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body class="bg-gray-50 dark:bg-dark min-h-screen">
    <!-- Sidebar -->
    <div class="sidebar fixed inset-y-0 left-0 z-50 w-64 bg-white dark:bg-gray-800 shadow-xl">
        <div class="flex items-center justify-center h-16 gradient-bg">
            <span class="text-white text-xl font-bold">🛡️ Security Ops</span>
        </div>
        
        <nav class="mt-8">
            <div class="px-4 space-y-2">
                <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-3 text-gray-700 dark:text-gray-200 rounded-lg hover:bg-green-50 dark:hover:bg-gray-700">
                    <i class="fas fa-tachometer-alt mr-3"></i>
                    Main Dashboard
                </a>
                <a href="{{ route('security.dashboard') }}" class="flex items-center px-4 py-3 bg-green-50 dark:bg-gray-700 text-primary dark:text-green-300 rounded-lg">
                    <i class="fas fa-shield-alt mr-3"></i>
                    Security Center
                </a>
                <a href="#" class="flex items-center px-4 py-3 text-gray-700 dark:text-gray-200 rounded-lg hover:bg-green-50 dark:hover:bg-gray-700">
                    <i class="fas fa-eye mr-3"></i>
                    Threat Monitoring
                </a>
                <a href="{{ route('security.incidents.index') }}" class="flex items-center px-4 py-3 text-gray-700 dark:text-gray-200 rounded-lg hover:bg-green-50 dark:hover:bg-gray-700">
                    <i class="fas fa-file-alt mr-3"></i>
                    Incident Reports
                </a>
                <a href="{{ route('security.access') }}" class="flex items-center px-4 py-3 text-gray-700 dark:text-gray-200 rounded-lg hover:bg-green-50 dark:hover:bg-gray-700">
                    <i class="fas fa-key mr-3"></i>
                    Access Control
                </a>
                <a href="{{ route('security.logs') }}" class="flex items-center px-4 py-3 text-gray-700 dark:text-gray-200 rounded-lg hover:bg-green-50 dark:hover:bg-gray-700">
                    <i class="fas fa-history mr-3"></i>
                    Audit Logs
                </a>
            </div>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="content-area ml-64">
        <!-- Header -->
        <header class="bg-white dark:bg-gray-800 shadow-sm border-b">
            <div class="flex justify-between items-center px-6 py-4">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Security Dashboard</h1>
                    <p class="text-gray-600 dark:text-gray-400">Security Operations Center</p>
                </div>
                
                <div class="flex items-center space-x-4">
                    <div class="text-right">
                        <p class="font-semibold text-gray-800 dark:text-white">{{ Auth::user()->name ?? 'Security Officer' }}</p>
                        <p class="text-sm text-gray-500 dark:text-gray-400">{{ Auth::user()->role_name ?? 'Security Team' }}</p>
                    </div>
                    <div class="w-12 h-12 gradient-bg rounded-full flex items-center justify-center text-white font-bold text-lg">
                        {{ substr(Auth::user()->name ?? 'S', 0, 1) }}
                    </div>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="p-2 text-gray-500 hover:text-red-500 dark:text-gray-400 transition-colors">
                            <i class="fas fa-sign-out-alt text-xl"></i>
                        </button>
                    </form>
                </div>
            </div>
        </header>

        <!-- Security Alerts -->
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="stat-card bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-lg bg-green-100 dark:bg-green-900 text-green-600 dark:text-green-300">
                            <i class="fas fa-shield-alt text-xl"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600 dark:text-gray-400">System Status</p>
                            <p class="text-2xl font-bold text-gray-800 dark:text-white">Secure</p>
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="flex items-center text-sm text-green-600 dark:text-green-400">
                            <i class="fas fa-check-circle mr-1"></i>
                            <span>All Systems Normal</span>
                        </div>
                    </div>
                </div>

                <div class="stat-card bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-lg bg-blue-100 dark:bg-blue-900 text-blue-600 dark:text-blue-300">
                            <i class="fas fa-eye text-xl"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Active Threats</p>
                            <p class="text-2xl font-bold text-gray-800 dark:text-white">0</p>
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="flex items-center text-sm text-green-600 dark:text-green-400">
                            <i class="fas fa-thumbs-up mr-1"></i>
                            <span>No Threats</span>
                        </div>
                    </div>
                </div>

                <div class="stat-card bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-lg bg-orange-100 dark:bg-orange-900 text-orange-600 dark:text-orange-300">
                            <i class="fas fa-exclamation-triangle text-xl"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Incidents (24h)</p>
                            <p class="text-2xl font-bold text-gray-800 dark:text-white">3</p>
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="flex items-center text-sm text-orange-600 dark:text-orange-400">
                            <i class="fas fa-clock mr-1"></i>
                            <span>Low Priority</span>
                        </div>
                    </div>
                </div>

                <div class="stat-card bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-lg bg-purple-100 dark:bg-purple-900 text-purple-600 dark:text-purple-300">
                            <i class="fas fa-user-shield text-xl"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Access Events</p>
                            <p class="text-2xl font-bold text-gray-800 dark:text-white">1,247</p>
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="flex items-center text-sm text-green-600 dark:text-green-400">
                            <i class="fas fa-chart-line mr-1"></i>
                            <span>Normal Activity</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Security Monitoring -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 p-6">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Security Status</h3>
                    <div class="space-y-4">
                        <div class="flex items-center justify-between p-3 bg-green-50 dark:bg-green-900/20 rounded-lg">
                            <div class="flex items-center">
                                <i class="fas fa-check-circle text-green-500 mr-3"></i>
                                <span class="text-gray-800 dark:text-white">Encryption Systems</span>
                            </div>
                            <span class="text-green-600 dark:text-green-400 font-medium">Active</span>
                        </div>
                        <div class="flex items-center justify-between p-3 bg-green-50 dark:bg-green-900/20 rounded-lg">
                            <div class="flex items-center">
                                <i class="fas fa-check-circle text-green-500 mr-3"></i>
                                <span class="text-gray-800 dark:text-white">Firewall Protection</span>
                            </div>
                            <span class="text-green-600 dark:text-green-400 font-medium">Enabled</span>
                        </div>
                        <div class="flex items-center justify-between p-3 bg-yellow-50 dark:bg-yellow-900/20 rounded-lg">
                            <div class="flex items-center">
                                <i class="fas fa-exclamation-triangle text-yellow-500 mr-3"></i>
                                <span class="text-gray-800 dark:text-white">Backup Status</span>
                            </div>
                            <span class="text-yellow-600 dark:text-yellow-400 font-medium">In Progress</span>
                        </div>
                        <div class="flex items-center justify-between p-3 bg-green-50 dark:bg-green-900/20 rounded-lg">
                            <div class="flex items-center">
                                <i class="fas fa-check-circle text-green-500 mr-3"></i>
                                <span class="text-gray-800 dark:text-white">Intrusion Detection</span>
                            </div>
                            <span class="text-green-600 dark:text-green-400 font-medium">Monitoring</span>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 p-6">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Quick Actions</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <button class="p-4 bg-green-50 dark:bg-green-900/20 rounded-lg hover:bg-green-100 dark:hover:bg-green-900/30 transition-colors text-left">
                            <i class="fas fa-eye text-green-600 dark:text-green-400 mb-2"></i>
                            <p class="font-medium text-gray-800 dark:text-white">Threat Scan</p>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Run security scan</p>
                        </button>
                        <button class="p-4 bg-blue-50 dark:bg-blue-900/20 rounded-lg hover:bg-blue-100 dark:hover:bg-blue-900/30 transition-colors text-left">
                            <i class="fas fa-file-alt text-blue-600 dark:text-blue-400 mb-2"></i>
                            <p class="font-medium text-gray-800 dark:text-white">Generate Report</p>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Security audit</p>
                        </button>
                        <a href="{{ route('security.access') }}" class="p-4 bg-purple-50 dark:bg-purple-900/20 rounded-lg hover:bg-purple-100 dark:hover:bg-purple-900/30 transition-colors text-left">
                            <i class="fas fa-user-lock text-purple-600 dark:text-purple-400 mb-2"></i>
                            <p class="font-medium text-gray-800 dark:text-white">Access Review</p>
                            <p class="text-sm text-gray-600 dark:text-gray-400">User permissions</p>
                        </a>
                        <a href="{{ route('security.logs') }}" class="p-4 bg-orange-50 dark:bg-orange-900/20 rounded-lg hover:bg-orange-100 dark:hover:bg-orange-900/30 transition-colors text-left">
                            <i class="fas fa-history text-orange-600 dark:text-orange-400 mb-2"></i>
                            <p class="font-medium text-gray-800 dark:text-white">Audit Logs</p>
                            <p class="text-sm text-gray-600 dark:text-gray-400">View activity</p>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Recent Security Events -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 p-6">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-6">Recent Security Events</h3>
                <div class="space-y-4">
                    <div class="flex items-center space-x-4 p-3 hover:bg-gray-50 dark:hover:bg-gray-700 rounded-lg transition-colors">
                        <div class="w-10 h-10 bg-green-100 dark:bg-green-900 rounded-full flex items-center justify-center">
                            <i class="fas fa-user-check text-green-600 dark:text-green-400"></i>
                        </div>
                        <div class="flex-1">
                            <p class="font-medium text-gray-800 dark:text-white">Successful login</p>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Admin user from trusted IP</p>
                        </div>
                        <span class="text-sm text-gray-500">30 min ago</span>
                    </div>
                    
                    <div class="flex items-center space-x-4 p-3 hover:bg-gray-50 dark:hover:bg-gray-700 rounded-lg transition-colors">
                        <div class="w-10 h-10 bg-yellow-100 dark:bg-yellow-900 rounded-full flex items-center justify-center">
                            <i class="fas fa-exclamation-triangle text-yellow-600 dark:text-yellow-400"></i>
                        </div>
                        <div class="flex-1">
                            <p class="font-medium text-gray-800 dark:text-white">Multiple failed attempts</p>
                            <p class="text-sm text-gray-600 dark:text-gray-400">IP blocked: 192.168.1.100</p>
                        </div>
                        <span class="text-sm text-gray-500">2 hours ago</span>
                    </div>
                    
                    <div class="flex items-center space-x-4 p-3 hover:bg-gray-50 dark:hover:bg-gray-700 rounded-lg transition-colors">
                        <div class="w-10 h-10 bg-blue-100 dark:bg-blue-900 rounded-full flex items-center justify-center">
                            <i class="fas fa-key text-blue-600 dark:text-blue-400"></i>
                        </div>
                        <div class="flex-1">
                            <p class="font-medium text-gray-800 dark:text-white">Key rotation completed</p>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Database encryption updated</p>
                        </div>
                        <span class="text-sm text-gray-500">4 hours ago</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Add active state to current page in navigation
        document.addEventListener('DOMContentLoaded', function() {
            const currentPath = window.location.pathname;
            const navLinks = document.querySelectorAll('nav a');
            
            navLinks.forEach(link => {
                if (link.getAttribute('href') === currentPath) {
                    link.classList.add('bg-green-50', 'dark:bg-gray-700', 'text-primary', 'dark:text-green-300');
                    link.classList.remove('text-gray-700', 'dark:text-gray-200');
                }
            });
        });
    </script>
</body>
</html>