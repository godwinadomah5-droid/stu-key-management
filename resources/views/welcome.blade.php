<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KeySecure - STU University</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <style>
        /* Dark Mode CSS Variables */
        :root {
            --bg-primary: #ffffff;
            --bg-secondary: #f8fafc;
            --bg-tertiary: #f1f5f9;
            --text-primary: #1e293b;
            --text-secondary: #64748b;
            --text-muted: #94a3b8;
            --accent-primary: #3b82f6;
            --accent-secondary: #1d4ed8;
            --border-color: #e2e8f0;
            --card-bg: #ffffff;
            --header-bg: #ffffff;
            --footer-bg: #1e293b;
            --footer-text: #f8fafc;
        }

        .dark-mode {
            --bg-primary: #0f172a;
            --bg-secondary: #1e293b;
            --bg-tertiary: #334155;
            --text-primary: #f1f5f9;
            --text-secondary: #cbd5e1;
            --text-muted: #94a3b8;
            --accent-primary: #60a5fa;
            --accent-secondary: #3b82f6;
            --border-color: #374151;
            --card-bg: #1e293b;
            --header-bg: #1e293b;
            --footer-bg: #0f172a;
            --footer-text: #f1f5f9;
        }

        body {
            background-color: var(--bg-primary);
            color: var(--text-primary);
            transition: background-color 0.3s ease, color 0.3s ease;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            margin: 0;
            padding: 0;
        }

        .dark-toggle {
            background: var(--bg-secondary);
            border: 1px solid var(--border-color);
            border-radius: 0.5rem;
            padding: 0.5rem;
            cursor: pointer;
            color: var(--text-primary);
            display: flex;
            align-items: center;
            justify-content: center;
            width: 2.5rem;
            height: 2.5rem;
            transition: all 0.2s ease;
        }

        .dark-toggle:hover {
            background: var(--accent-primary);
            color: white;
        }

        .btn-primary {
            background-color: #3b82f6;
            color: white;
            font-weight: 600;
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            border: none;
            cursor: pointer;
            transition: background-color 0.2s;
            text-decoration: none;
            display: inline-block;
            text-align: center;
        }

        .btn-primary:hover {
            background-color: #2563eb;
        }

        .card {
            background-color: var(--card-bg);
            border-radius: 0.5rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            padding: 1.5rem;
            border: 1px solid var(--border-color);
        }

        /* Status indicator */
        .status-indicator {
            position: fixed;
            top: 1rem;
            left: 1rem;
            background: #3b82f6;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            font-size: 0.875rem;
            z-index: 1000;
            display: none;
        }

        .status-indicator.show {
            display: block;
            animation: fadeOut 2s forwards;
        }

        @keyframes fadeOut {
            0% { opacity: 1; }
            70% { opacity: 1; }
            100% { opacity: 0; display: none; }
        }
    </style>
</head>
<body>
    <!-- Dark Mode Status Indicator -->
    <div id="darkModeStatus" class="status-indicator">
        Dark Mode: <span id="modeText">Off</span>
    </div>

    <!-- Navigation -->
    <nav class="border-b shadow-sm" style="background-color: var(--header-bg); border-color: var(--border-color);">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <i class="fas fa-key text-xl mr-3" style="color: var(--accent-primary);"></i>
                    <span class="font-bold text-xl" style="color: var(--text-primary);">KeySecure</span>
                </div>

                <div class="flex items-center space-x-4">
                    <!-- Dark Mode Toggle -->
                    <button id="darkModeBtn" class="dark-toggle" title="Toggle Dark Mode">
                        <i class="fas fa-moon" id="darkModeIcon"></i>
                    </button>

                    <a href="/login" class="font-medium hover:underline" style="color: var(--text-secondary);">
                        <i class="fas fa-sign-in-alt mr-1"></i> Sign In
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        <!-- Hero Section -->
        <section class="py-20" style="background: linear-gradient(135deg, var(--bg-secondary) 0%, var(--bg-primary) 100%);">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h1 class="text-4xl md:text-6xl font-bold mb-6" style="color: var(--text-primary);">KeySecure</h1>
                <p class="text-xl md:text-2xl mb-4" style="color: var(--text-secondary);">Secure Key Management for STU University</p>
                <p class="text-lg mb-8 max-w-2xl mx-auto" style="color: var(--text-secondary);">
                    Enterprise-grade encryption key management and security monitoring system. 
                    Protect your digital assets with state-of-the-art security infrastructure.
                </p>
                
                <div class="flex flex-col sm:flex-row gap-4 justify-center mb-12">
                    <a href="/dashboard" class="btn-primary">
                        Launch Dashboard
                    </a>
                    <a href="#features" class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-md" style="background-color: var(--bg-secondary); color: var(--text-primary); border-color: var(--border-color);">
                        Learn More
                    </a>
                </div>

                <!-- Stats -->
                <div class="grid grid-cols-2 md:grid-cols-4 gap-8 max-w-4xl mx-auto">
                    <div class="text-center">
                        <div class="text-3xl font-bold mb-2" style="color: var(--accent-primary);">99.9%</div>
                        <div class="text-sm uppercase tracking-wide" style="color: var(--text-secondary);">System Uptime</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold mb-2" style="color: var(--accent-primary);">A+</div>
                        <div class="text-sm uppercase tracking-wide" style="color: var(--text-secondary);">Security Rating</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold mb-2" style="color: var(--accent-primary);">24/7</div>
                        <div class="text-sm uppercase tracking-wide" style="color: var(--text-secondary);">Monitoring</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold mb-2" style="color: var(--accent-primary);">0</div>
                        <div class="text-sm uppercase tracking-wide" style="color: var(--text-secondary);">Active Threats</div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Features Section -->
        <section id="features" class="py-20" style="background-color: var(--bg-secondary);">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-3xl md:text-4xl font-bold text-center mb-12" style="color: var(--text-primary);">Enterprise Security Solutions</h2>
                
                <div class="grid md:grid-cols-3 gap-8">
                    <!-- Feature 1 -->
                    <div class="card text-center">
                        <div class="text-4xl mb-4" style="color: var(--accent-primary);">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <h3 class="text-xl font-semibold mb-4" style="color: var(--text-primary);">Advanced Security</h3>
                        <p class="mb-4" style="color: var(--text-secondary);">
                            Military-grade encryption and multi-layered security protocols to protect your cryptographic keys and sensitive data.
                        </p>
                        <ul class="text-left space-y-2" style="color: var(--text-secondary);">
                            <li class="flex items-center">
                                <i class="fas fa-check mr-2" style="color: var(--accent-primary);"></i>
                                AES-256 Encryption
                            </li>
                            <li class="flex items-center">
                                <i class="fas fa-check mr-2" style="color: var(--accent-primary);"></i>
                                Multi-factor Authentication
                            </li>
                            <li class="flex items-center">
                                <i class="fas fa-check mr-2" style="color: var(--accent-primary);"></i>
                                Role-based Access Control
                            </li>
                        </ul>
                    </div>

                    <!-- Feature 2 -->
                    <div class="card text-center">
                        <div class="text-4xl mb-4" style="color: var(--accent-primary);">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <h3 class="text-xl font-semibold mb-4" style="color: var(--text-primary);">Real-time Monitoring</h3>
                        <p class="mb-4" style="color: var(--text-secondary);">
                            Comprehensive monitoring dashboard with live activity feeds, threat detection, and instant security alerts.
                        </p>
                        <ul class="text-left space-y-2" style="color: var(--text-secondary);">
                            <li class="flex items-center">
                                <i class="fas fa-check mr-2" style="color: var(--accent-primary);"></i>
                                Live Activity Tracking
                            </li>
                            <li class="flex items-center">
                                <i class="fas fa-check mr-2" style="color: var(--accent-primary);"></i>
                                Threat Intelligence
                            </li>
                            <li class="flex items-center">
                                <i class="fas fa-check mr-2" style="color: var(--accent-primary);"></i>
                                Automated Alerts
                            </li>
                        </ul>
                    </div>

                    <!-- Feature 3 -->
                    <div class="card text-center">
                        <div class="text-4xl mb-4" style="color: var(--accent-primary);">
                            <i class="fas fa-cogs"></i>
                        </div>
                        <h3 class="text-xl font-semibold mb-4" style="color: var(--text-primary);">Enterprise Management</h3>
                        <p class="mb-4" style="color: var(--text-secondary);">
                            Complete key lifecycle management, audit trails, compliance reporting, and centralized administration.
                        </p>
                        <ul class="text-left space-y-2" style="color: var(--text-secondary);">
                            <li class="flex items-center">
                                <i class="fas fa-check mr-2" style="color: var(--accent-primary);"></i>
                                Key Lifecycle Management
                            </li>
                            <li class="flex items-center">
                                <i class="fas fa-check mr-2" style="color: var(--accent-primary);"></i>
                                Comprehensive Auditing
                            </li>
                            <li class="flex items-center">
                                <i class="fas fa-check mr-2" style="color: var(--accent-primary);"></i>
                                Compliance Ready
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <!-- Trust Section -->
        <section class="py-20" style="background-color: var(--bg-primary);">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h2 class="text-3xl md:text-4xl font-bold mb-6" style="color: var(--text-primary);">Trusted by STU University</h2>
                <p class="text-lg mb-12 max-w-2xl mx-auto" style="color: var(--text-secondary);">
                    Protecting academic data, research materials, and institutional information with the highest security standards.
                </p>
                
                <div class="grid grid-cols-2 md:grid-cols-4 gap-8 max-w-4xl mx-auto">
                    <div class="text-center">
                        <div class="text-3xl mb-4" style="color: var(--accent-primary);">🔒</div>
                        <h4 class="font-semibold mb-2" style="color: var(--text-primary);">End-to-End Encryption</h4>
                        <p class="text-sm" style="color: var(--text-secondary);">All data encrypted in transit and at rest</p>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl mb-4" style="color: var(--accent-primary);">🛡️</div>
                        <h4 class="font-semibold mb-2" style="color: var(--text-primary);">Zero Trust Architecture</h4>
                        <p class="text-sm" style="color: var(--text-secondary);">Verify explicitly, trust nothing</p>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl mb-4" style="color: var(--accent-primary);">📊</div>
                        <h4 class="font-semibold mb-2" style="color: var(--text-primary);">24/7 Security Operations</h4>
                        <p class="text-sm" style="color: var(--text-secondary);">Continuous monitoring and protection</p>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl mb-4" style="color: var(--accent-primary);">✅</div>
                        <h4 class="font-semibold mb-2" style="color: var(--text-primary);">FIPS 140-2 Compliant</h4>
                        <p class="text-sm" style="color: var(--text-secondary);">Meeting government security standards</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="py-20" style="background: linear-gradient(135deg, var(--accent-primary), var(--accent-secondary)); color: white;">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h2 class="text-3xl md:text-4xl font-bold mb-6">Ready to Secure Your Systems?</h2>
                <p class="text-xl mb-8 opacity-90">
                    Join STU University's secure key management platform and protect your digital infrastructure today.
                </p>
                <button class="bg-white text-blue-600 px-8 py-4 rounded-lg font-semibold text-lg hover:bg-gray-100 transition duration-200">
                    Get Started Now
                </button>
                <p class="mt-4 text-sm opacity-80">
                    Secure authentication • Instant access • Enterprise security
                </p>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="py-8" style="background-color: var(--footer-bg); color: var(--footer-text);">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="flex items-center mb-4 md:mb-0">
                    <i class="fas fa-key text-xl mr-3" style="color: var(--accent-primary);"></i>
                    <span class="font-bold text-lg">KeySecure</span>
                </div>
                <div class="flex space-x-6 mb-4 md:mb-0">
                    <a href="#" class="hover:underline opacity-80 hover:opacity-100">Privacy Policy</a>
                    <a href="#" class="hover:underline opacity-80 hover:opacity-100">Terms of Service</a>
                </div>
                <div class="text-center md:text-right">
                    <p class="text-sm opacity-80">© 2025 STU University. All rights reserved.</p>
                </div>
            </div>
        </div>
    </footer>
</div>

    <!-- GUARANTEED DARK MODE SCRIPT -->
    <script>
        // Initialize when page loads
        document.addEventListener('DOMContentLoaded', function() {
            console.log('🚀 Initializing dark mode system...');
            
            const darkModeBtn = document.getElementById('darkModeBtn');
            const darkModeIcon = document.getElementById('darkModeIcon');
            
            // Add click event to dark mode button
            darkModeBtn.addEventListener('click', toggleDarkMode);
            
            // Initialize dark mode state
            initializeDarkMode();
            
            console.log('✅ Dark mode system ready');
        });

        function initializeDarkMode() {
            const isDark = localStorage.getItem('darkMode') === 'true';
            console.log('💡 Current dark mode state:', isDark);
            
            if (isDark) {
                enableDarkMode();
            } else {
                enableLightMode();
            }
        }

        function toggleDarkMode() {
            console.log('🎯 Dark mode button clicked!');
            
            const isCurrentlyDark = document.body.classList.contains('dark-mode');
            console.log('🔍 Currently dark mode:', isCurrentlyDark);
            
            if (isCurrentlyDark) {
                enableLightMode();
            } else {
                enableDarkMode();
            }
        }

        function enableDarkMode() {
            console.log('🌙 Enabling DARK mode');
            
            // Add dark mode class to body
            document.body.classList.add('dark-mode');
            
            // Update icon
            document.getElementById('darkModeIcon').className = 'fas fa-sun';
            
            // Save preference
            localStorage.setItem('darkMode', 'true');
            
            // Show status
            showStatus('ON');
            
            console.log('✅ Dark mode enabled successfully');
        }

        function enableLightMode() {
            console.log('☀️ Enabling LIGHT mode');
            
            // Remove dark mode class from body
            document.body.classList.remove('dark-mode');
            
            // Update icon
            document.getElementById('darkModeIcon').className = 'fas fa-moon';
            
            // Save preference
            localStorage.setItem('darkMode', 'false');
            
            // Show status
            showStatus('OFF');
            
            console.log('✅ Light mode enabled successfully');
        }

        function showStatus(mode) {
            const indicator = document.getElementById('darkModeStatus');
            const modeText = document.getElementById('modeText');
            
            modeText.textContent = mode;
            indicator.classList.add('show');
            
            setTimeout(() => {
                indicator.classList.remove('show');
            }, 2000);
        }

        // Emergency functions
        window.forceDark = function() {
            enableDarkMode();
            alert('Dark mode forced ON!');
        };

        window.forceLight = function() {
            enableLightMode();
            alert('Light mode forced ON!');
        };

        // Keyboard shortcut
        document.addEventListener('keydown', function(e) {
            if (e.ctrlKey && e.key === 'd') {
                e.preventDefault();
                toggleDarkMode();
            }
        });
    </script>
</body>
</html>