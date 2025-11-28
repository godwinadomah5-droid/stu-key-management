<!DOCTYPE html>
<html>
<head>
    <title>Settings - KeySecure</title>
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
                    <a href="/analytics" class="flex items-center px-4 py-3 text-gray-600 hover:bg-gray-100 rounded-lg">
                        <i class="fas fa-chart-bar mr-3"></i>Analytics
                    </a>
                    <a href="/settings" class="flex items-center px-4 py-3 bg-blue-100 text-blue-700 rounded-lg">
                        <i class="fas fa-cog mr-3"></i>System Settings
                    </a>
                </div>
            </nav>
        </div>

        <!-- Content -->
        <div class="flex-1 p-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">System Settings</h1>
            <p class="text-gray-600 mb-8">Configure system preferences and options</p>

            <!-- Settings Cards -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- General Settings -->
                <div class="bg-white p-6 rounded-lg shadow">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">General Settings</h3>
                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="font-medium text-gray-800">Dark Mode</p>
                                <p class="text-sm text-gray-600">Enable dark theme</p>
                            </div>
                            <button id="darkModeToggle" class="toggle-switch">
                                <span class="toggle-slider"></span>
                            </button>
                        </div>
                        
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="font-medium text-gray-800">Email Notifications</p>
                                <p class="text-sm text-gray-600">Receive security alerts</p>
                            </div>
                            <button id="emailNotificationsToggle" class="toggle-switch active">
                                <span class="toggle-slider"></span>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Security Settings -->
                <div class="bg-white p-6 rounded-lg shadow">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Security Settings</h3>
                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="font-medium text-gray-800">Two-Factor Auth</p>
                                <p class="text-sm text-gray-600">Require 2FA for all users</p>
                            </div>
                            <button id="twoFactorToggle" class="toggle-switch active">
                                <span class="toggle-slider"></span>
                            </button>
                        </div>
                        
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="font-medium text-gray-800">Auto Logout</p>
                                <p class="text-sm text-gray-600">Logout after 30 minutes</p>
                            </div>
                            <button id="autoLogoutToggle" class="toggle-switch">
                                <span class="toggle-slider"></span>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Backup Settings -->
                <div class="bg-white p-6 rounded-lg shadow">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Backup & Recovery</h3>
                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="font-medium text-gray-800">Auto Backup</p>
                                <p class="text-sm text-gray-600">Daily at 02:00 AM</p>
                            </div>
                            <button id="autoBackupToggle" class="toggle-switch active">
                                <span class="toggle-slider"></span>
                            </button>
                        </div>
                        
                        <div>
                            <p class="font-medium text-gray-800 mb-2">Backup Location</p>
                            <select id="backupLocation" class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option>Local Storage</option>
                                <option>Cloud Storage</option>
                                <option>External Drive</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- System Info -->
                <div class="bg-white p-6 rounded-lg shadow">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">System Information</h3>
                    <div class="space-y-2 text-sm">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Version</span>
                            <span class="font-medium">v2.1.0</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Last Updated</span>
                            <span class="font-medium">2024-01-15</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Database</span>
                            <span class="font-medium">SQLite</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Server</span>
                            <span class="font-medium">Apache/2.4</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="mt-8 flex space-x-4">
                <button id="saveSettings" class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded font-semibold transition duration-200">
                    <i class="fas fa-save mr-2"></i>Save Settings
                </button>
                <button id="resetSettings" class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded font-semibold transition duration-200">
                    <i class="fas fa-undo mr-2"></i>Reset to Defaults
                </button>
                <button id="testNotifications" class="bg-green-500 hover:bg-green-600 text-white px-6 py-3 rounded font-semibold transition duration-200">
                    <i class="fas fa-bell mr-2"></i>Test Notifications
                </button>
            </div>

            <!-- Status Message -->
            <div id="statusMessage" class="mt-4 hidden">
                <!-- Message will appear here -->
            </div>
        </div>
    </div>

    <style>
        /* Toggle Switch Styles */
        .toggle-switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
            background-color: #d1d5db;
            border-radius: 34px;
            transition: background-color 0.3s;
            cursor: pointer;
            border: none;
            outline: none;
        }

        .toggle-switch.active {
            background-color: #3b82f6;
        }

        .toggle-slider {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            border-radius: 50%;
            transition: transform 0.3s;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .toggle-switch.active .toggle-slider {
            transform: translateX(26px);
        }

        /* Dark Mode Styles */
        .dark-mode {
            background-color: #1f2937;
            color: #f9fafb;
        }

        .dark-mode .bg-white {
            background-color: #374151;
        }

        .dark-mode .text-gray-800 {
            color: #f9fafb;
        }

        .dark-mode .text-gray-600 {
            color: #d1d5db;
        }

        .dark-mode .border-gray-300 {
            border-color: #4b5563;
        }

        .dark-mode .bg-gray-100 {
            background-color: #374151;
        }
    </style>

    <script>
        // Initialize when page loads
        document.addEventListener('DOMContentLoaded', function() {
            console.log('Settings page loaded - initializing toggle switches...');
            
            // Initialize toggle switches
            initializeToggles();
            
            // Load saved settings
            loadSettings();
            
            // Set up event listeners
            setupEventListeners();
        });

        function initializeToggles() {
            // All toggle switches will work now
            console.log('Toggle switches initialized');
        }

        function setupEventListeners() {
            // Toggle switch event listeners
            document.getElementById('darkModeToggle').addEventListener('click', function() {
                this.classList.toggle('active');
                toggleDarkMode();
            });

            document.getElementById('emailNotificationsToggle').addEventListener('click', function() {
                this.classList.toggle('active');
                showStatus('Email notifications ' + (this.classList.contains('active') ? 'enabled' : 'disabled'), 'success');
            });

            document.getElementById('twoFactorToggle').addEventListener('click', function() {
                this.classList.toggle('active');
                showStatus('Two-factor authentication ' + (this.classList.contains('active') ? 'enabled' : 'disabled'), 'success');
            });

            document.getElementById('autoLogoutToggle').addEventListener('click', function() {
                this.classList.toggle('active');
                showStatus('Auto logout ' + (this.classList.contains('active') ? 'enabled' : 'disabled'), 'success');
            });

            document.getElementById('autoBackupToggle').addEventListener('click', function() {
                this.classList.toggle('active');
                showStatus('Auto backup ' + (this.classList.contains('active') ? 'enabled' : 'disabled'), 'success');
            });

            // Backup location dropdown
            document.getElementById('backupLocation').addEventListener('change', function() {
                showStatus('Backup location changed to: ' + this.value, 'info');
            });

            // Action buttons
            document.getElementById('saveSettings').addEventListener('click', function() {
                saveSettings();
                showStatus('Settings saved successfully!', 'success');
            });

            document.getElementById('resetSettings').addEventListener('click', function() {
                if (confirm('Are you sure you want to reset all settings to defaults?')) {
                    resetSettings();
                    showStatus('Settings reset to defaults!', 'success');
                }
            });

            document.getElementById('testNotifications').addEventListener('click', function() {
                showStatus('Test notification sent successfully!', 'success');
            });
        }

        function toggleDarkMode() {
            const isDarkMode = document.getElementById('darkModeToggle').classList.contains('active');
            document.body.classList.toggle('dark-mode', isDarkMode);
            
            // Save to localStorage
            localStorage.setItem('darkMode', isDarkMode);
            
            showStatus('Dark mode ' + (isDarkMode ? 'enabled' : 'disabled'), 'success');
        }

        function loadSettings() {
            // Load dark mode preference
            const darkMode = localStorage.getItem('darkMode') === 'true';
            if (darkMode) {
                document.getElementById('darkModeToggle').classList.add('active');
                document.body.classList.add('dark-mode');
            }

            // Load other settings from localStorage
            const emailNotifications = localStorage.getItem('emailNotifications') !== 'false';
            if (!emailNotifications) {
                document.getElementById('emailNotificationsToggle').classList.remove('active');
            }

            const twoFactor = localStorage.getItem('twoFactor') !== 'false';
            if (!twoFactor) {
                document.getElementById('twoFactorToggle').classList.remove('active');
            }

            const backupLocation = localStorage.getItem('backupLocation') || 'Local Storage';
            document.getElementById('backupLocation').value = backupLocation;
        }

        function saveSettings() {
            // Save all settings to localStorage
            localStorage.setItem('darkMode', document.getElementById('darkModeToggle').classList.contains('active'));
            localStorage.setItem('emailNotifications', document.getElementById('emailNotificationsToggle').classList.contains('active'));
            localStorage.setItem('twoFactor', document.getElementById('twoFactorToggle').classList.contains('active'));
            localStorage.setItem('autoLogout', document.getElementById('autoLogoutToggle').classList.contains('active'));
            localStorage.setItem('autoBackup', document.getElementById('autoBackupToggle').classList.contains('active'));
            localStorage.setItem('backupLocation', document.getElementById('backupLocation').value);

            console.log('Settings saved to localStorage');
        }

        function resetSettings() {
            // Reset all toggles to default state
            document.getElementById('darkModeToggle').classList.remove('active');
            document.getElementById('emailNotificationsToggle').classList.add('active');
            document.getElementById('twoFactorToggle').classList.add('active');
            document.getElementById('autoLogoutToggle').classList.remove('active');
            document.getElementById('autoBackupToggle').classList.add('active');
            document.getElementById('backupLocation').value = 'Local Storage';

            // Remove dark mode
            document.body.classList.remove('dark-mode');
            localStorage.removeItem('darkMode');

            // Clear other settings
            localStorage.removeItem('emailNotifications');
            localStorage.removeItem('twoFactor');
            localStorage.removeItem('autoLogout');
            localStorage.removeItem('autoBackup');
            localStorage.removeItem('backupLocation');
        }

        function showStatus(message, type = 'info') {
            const statusDiv = document.getElementById('statusMessage');
            const colors = {
                success: 'bg-green-100 border-green-400 text-green-700',
                error: 'bg-red-100 border-red-400 text-red-700',
                info: 'bg-blue-100 border-blue-400 text-blue-700',
                warning: 'bg-yellow-100 border-yellow-400 text-yellow-700'
            };

            statusDiv.className = `${colors[type]} px-4 py-3 rounded border mb-4`;
            statusDiv.innerHTML = `
                <div class="flex items-center">
                    <i class="fas fa-${type === 'success' ? 'check-circle' : type === 'error' ? 'exclamation-triangle' : 'info-circle'} mr-2"></i>
                    <span>${message}</span>
                    <button onclick="this.parentElement.parentElement.classList.add('hidden')" class="ml-auto text-gray-500 hover:text-gray-700">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            `;
            statusDiv.classList.remove('hidden');

            // Auto hide after 5 seconds
            setTimeout(() => {
                statusDiv.classList.add('hidden');
            }, 5000);
        }

        // Keyboard shortcuts
        document.addEventListener('keydown', function(e) {
            if (e.ctrlKey && e.key === 's') {
                e.preventDefault();
                document.getElementById('saveSettings').click();
            }
        });
    </script>
</body>
</html>