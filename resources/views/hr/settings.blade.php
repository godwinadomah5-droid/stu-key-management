<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HR Settings - KeySecure</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50 dark:bg-gray-900">
    <nav class="bg-white dark:bg-gray-800 shadow-sm border-b border-gray-200 dark:border-gray-700">
        <div class="px-6 py-4">
            <div class="flex justify-between items-center">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-gradient-to-r from-red-500 to-red-700 rounded-xl flex items-center justify-center">
                        <i class="fas fa-users text-white text-lg"></i>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold text-gray-800 dark:text-white">KeySecure</h1>
                        <p class="text-sm text-gray-500 dark:text-gray-400">HR Settings</p>
                    </div>
                </div>
                <a href="/hr/dashboard" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg transition-colors">
                    <i class="fas fa-arrow-left mr-2"></i>Back to Dashboard
                </a>
            </div>
        </div>
    </nav>

    <main class="container mx-auto p-6">
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 p-8">
            <div class="text-center">
                <div class="w-20 h-20 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-cog text-gray-600 dark:text-gray-400 text-2xl"></i>
                </div>
                <h1 class="text-3xl font-bold text-gray-800 dark:text-white mb-2">HR Settings</h1>
                <p class="text-gray-600 dark:text-gray-400 mb-6">Configure HR system preferences and options</p>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <div class="bg-blue-50 dark:bg-blue-900/20 p-4 rounded-lg text-center">
                        <i class="fas fa-user-shield text-blue-600 dark:text-blue-400 text-xl mb-2"></i>
                        <p class="text-sm font-medium text-gray-800 dark:text-white">Permissions</p>
                        <p class="text-xs text-gray-600 dark:text-gray-400">Access controls</p>
                    </div>
                    <div class="bg-green-50 dark:bg-green-900/20 p-4 rounded-lg text-center">
                        <i class="fas fa-bell text-green-600 dark:text-green-400 text-xl mb-2"></i>
                        <p class="text-sm font-medium text-gray-800 dark:text-white">Notifications</p>
                        <p class="text-xs text-gray-600 dark:text-gray-400">Alert settings</p>
                    </div>
                    <div class="bg-purple-50 dark:bg-purple-900/20 p-4 rounded-lg text-center">
                        <i class="fas fa-database text-purple-600 dark:text-purple-400 text-xl mb-2"></i>
                        <p class="text-sm font-medium text-gray-800 dark:text-white">Data Management</p>
                        <p class="text-xs text-gray-600 dark:text-gray-400">Backup & export</p>
                    </div>
                    <div class="bg-orange-50 dark:bg-orange-900/20 p-4 rounded-lg text-center">
                        <i class="fas fa-tools text-orange-600 dark:text-orange-400 text-xl mb-2"></i>
                        <p class="text-sm font-medium text-gray-800 dark:text-white">System</p>
                        <p class="text-xs text-gray-600 dark:text-gray-400">Configuration</p>
                    </div>
                </div>

                <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-6">
                    <p class="text-gray-600 dark:text-gray-400 mb-4">HR settings and configuration panel is under development.</p>
                    <div class="flex justify-center space-x-4">
                        <button class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-lg transition-colors">
                            <i class="fas fa-save mr-2"></i>Save Settings
                        </button>
                        <button class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-lg transition-colors">
                            <i class="fas fa-sync mr-2"></i>Reset to Default
                        </button>
                    </div>
                </div>

                <!-- Settings Sections -->
                <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-4">
                        <h3 class="font-semibold text-gray-800 dark:text-white mb-3">General Settings</h3>
                        <div class="space-y-3">
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-600 dark:text-gray-400">Email Notifications</span>
                                <div class="relative inline-block w-12 h-6 rounded-full bg-gray-300 dark:bg-gray-600">
                                    <input type="checkbox" class="sr-only" checked>
                                    <span class="absolute left-6 top-1 w-4 h-4 rounded-full bg-white transition-transform"></span>
                                </div>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-600 dark:text-gray-400">Auto-approve Leave</span>
                                <div class="relative inline-block w-12 h-6 rounded-full bg-gray-300 dark:bg-gray-600">
                                    <input type="checkbox" class="sr-only">
                                    <span class="absolute left-1 top-1 w-4 h-4 rounded-full bg-white transition-transform"></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-4">
                        <h3 class="font-semibold text-gray-800 dark:text-white mb-3">Security Settings</h3>
                        <div class="space-y-3">
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-600 dark:text-gray-400">Two-Factor Auth</span>
                                <div class="relative inline-block w-12 h-6 rounded-full bg-green-500">
                                    <input type="checkbox" class="sr-only" checked>
                                    <span class="absolute left-6 top-1 w-4 h-4 rounded-full bg-white transition-transform"></span>
                                </div>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-600 dark:text-gray-400">Session Timeout</span>
                                <select class="text-sm border border-gray-300 dark:border-gray-600 rounded px-2 py-1 bg-white dark:bg-gray-700">
                                    <option>30 minutes</option>
                                    <option>1 hour</option>
                                    <option>2 hours</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>