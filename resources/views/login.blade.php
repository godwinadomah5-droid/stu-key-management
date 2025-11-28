<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - STU University Key Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            font-family: 'Inter', sans-serif;
        }
        
        .gradient-bg {
            background: linear-gradient(-45deg, #667eea, #764ba2, #f093fb, #f5576c);
            background-size: 400% 400%;
            animation: gradientShift 15s ease infinite;
        }
        
        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        
        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .card-shadow {
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25), 
                        0 0 0 1px rgba(255, 255, 255, 0.1);
        }
        
        .fade-in {
            animation: fadeIn 1s ease-out;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .floating {
            animation: floating 3s ease-in-out infinite;
        }
        
        @keyframes floating {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }
        
        .role-card {
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            cursor: pointer;
        }
        
        .role-card:hover {
            transform: translateY(-5px);
        }
        
        .role-card.selected {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px -10px rgba(59, 130, 246, 0.4);
            border-color: #3b82f6;
        }
        
        .input-focus:focus {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px -5px rgba(59, 130, 246, 0.3);
        }
        
        .login-btn {
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
        }
        
        .login-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: all 0.6s;
        }
        
        .login-btn:hover::before {
            left: 100%;
        }
    </style>
</head>
<body class="gradient-bg min-h-screen flex items-center justify-center p-4 overflow-hidden">
    <!-- Animated Background -->
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute -top-40 -right-40 w-80 h-80 bg-purple-300 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-pulse"></div>
        <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-blue-300 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-pulse"></div>
    </div>

    <!-- Main Content -->
    <div class="max-w-6xl w-full grid grid-cols-1 lg:grid-cols-2 gap-8 z-10">
        <!-- Left Side - Role Selection -->
        <div class="glass-effect rounded-3xl p-8 card-shadow text-white fade-in">
            <div class="text-center mb-10">
                <div class="w-24 h-24 bg-white/20 rounded-3xl flex items-center justify-center mx-auto mb-6 floating">
                    <i class="fas fa-key-skeleton text-white text-4xl"></i>
                </div>
                <h1 class="text-5xl font-bold mb-3 bg-clip-text text-transparent bg-gradient-to-r from-white to-blue-200">KeySecure</h1>
                <div class="text-blue-200 text-xl font-light">STU University Key Management System</div>
            </div>

            <div class="space-y-6 mb-8">
                <h2 class="text-2xl font-semibold text-center mb-6">Select Your Access Level</h2>
                
                <!-- System Administrator -->
                <div class="role-card glass-effect p-6 rounded-2xl border-2 border-white/10" data-role="admin">
                    <div class="flex items-start space-x-4">
                        <div class="w-14 h-14 bg-red-500/30 rounded-xl flex items-center justify-center">
                            <i class="fas fa-crown text-red-300 text-2xl"></i>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-xl font-bold mb-2">System Administrator</h3>
                            <p class="text-blue-200 text-sm leading-relaxed">Full system access and management</p>
                            <div class="flex mt-3 space-x-2">
                                <span class="px-2 py-1 bg-red-500/30 text-red-100 rounded text-xs">Full Access</span>
                                <span class="px-2 py-1 bg-red-500/30 text-red-100 rounded text-xs">Admin Controls</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- HR Manager -->
                <div class="role-card glass-effect p-6 rounded-2xl border-2 border-white/10" data-role="hr">
                    <div class="flex items-start space-x-4">
                        <div class="w-14 h-14 bg-green-500/30 rounded-xl flex items-center justify-center">
                            <i class="fas fa-users-gear text-green-300 text-2xl"></i>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-xl font-bold mb-2">HR Manager</h3>
                            <p class="text-blue-200 text-sm leading-relaxed">Employee and access management</p>
                            <div class="flex mt-3 space-x-2">
                                <span class="px-2 py-1 bg-green-500/30 text-green-100 rounded text-xs">User Management</span>
                                <span class="px-2 py-1 bg-green-500/30 text-green-100 rounded text-xs">Access Control</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Security Officer -->
                <div class="role-card glass-effect p-6 rounded-2xl border-2 border-white/10" data-role="security">
                    <div class="flex items-start space-x-4">
                        <div class="w-14 h-14 bg-yellow-500/30 rounded-xl flex items-center justify-center">
                            <i class="fas fa-shield-halved text-yellow-300 text-2xl"></i>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-xl font-bold mb-2">Security Officer</h3>
                            <p class="text-blue-200 text-sm leading-relaxed">Security monitoring and alerts</p>
                            <div class="flex mt-3 space-x-2">
                                <span class="px-2 py-1 bg-yellow-500/30 text-yellow-100 rounded text-xs">Monitoring</span>
                                <span class="px-2 py-1 bg-yellow-500/30 text-yellow-100 rounded text-xs">Alerts</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Security Status -->
            <div class="glass-effect rounded-2xl p-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <i class="fas fa-shield-check text-green-400 text-xl"></i>
                        <span class="text-white font-medium">System Security Status</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <div class="w-3 h-3 rounded-full bg-green-500 animate-pulse"></div>
                        <span class="text-green-300 text-sm">All Systems Secure</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side - Laravel Login Form -->
        <div class="bg-white/95 backdrop-blur-lg rounded-3xl card-shadow overflow-hidden fade-in" style="animation-delay: 0.3s;">
            <!-- Animated Header -->
            <div class="bg-gradient-to-r from-blue-600 via-purple-600 to-indigo-700 p-8 text-center relative overflow-hidden">
                <div class="absolute inset-0 bg-black/10"></div>
                <div class="relative z-10">
                    <h2 class="text-4xl font-bold text-white mb-3">Welcome Back</h2>
                    <p class="text-blue-100 text-lg">Access the Key Management System</p>
                </div>
                
                <!-- Animated Icons -->
                <div class="absolute top-4 left-4 w-8 h-8 bg-white/20 rounded-full flex items-center justify-center">
                    <i class="fas fa-lock text-white text-sm"></i>
                </div>
                <div class="absolute top-4 right-4 w-8 h-8 bg-white/20 rounded-full flex items-center justify-center">
                    <i class="fas fa-fingerprint text-white text-sm"></i>
                </div>
            </div>

            <!-- Interactive Login Form -->
            <div class="p-8">
                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <!-- Email Input -->
                    <div class="space-y-3">
                        <label class="block text-gray-700 text-sm font-semibold mb-2 flex items-center">
                            <i class="fas fa-envelope mr-3 text-blue-500"></i>
                            <span>University Email</span>
                        </label>
                        <div class="relative">
                            <input 
                                type="email" 
                                name="email"
                                id="email"
                                class="w-full px-5 py-4 border-2 border-gray-200 rounded-2xl focus:border-blue-500 transition-all duration-300 input-focus text-lg bg-white/50"
                                placeholder="your.email@stuniversity.edu"
                                value="{{ old('email') }}"
                                required
                                autofocus
                            >
                            <div class="absolute right-4 top-1/2 transform -translate-y-1/2">
                                <i class="fas fa-check-circle text-green-500 hidden" id="emailValid"></i>
                            </div>
                        </div>
                        @error('email')
                            <p class="text-red-500 text-sm mt-2">
                                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Password Input -->
                    <div class="space-y-3">
                        <label class="block text-gray-700 text-sm font-semibold mb-2 flex items-center">
                            <i class="fas fa-key mr-3 text-blue-500"></i>
                            <span>Password</span>
                        </label>
                        <div class="relative">
                            <input 
                                type="password" 
                                name="password"
                                id="password"
                                class="w-full px-5 py-4 border-2 border-gray-200 rounded-2xl focus:border-blue-500 transition-all duration-300 input-focus text-lg bg-white/50 pr-12"
                                placeholder="Enter your password"
                                required
                            >
                            <button type="button" class="password-toggle absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-blue-500">
                                <i class="fas fa-eye" id="passwordToggle"></i>
                            </button>
                        </div>
                        @error('password')
                            <p class="text-red-500 text-sm mt-2">
                                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Remember Me & Forgot Password -->
                    <div class="flex items-center justify-between">
                        <label class="flex items-center space-x-3 cursor-pointer">
                            <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} class="w-5 h-5 text-blue-600 rounded focus:ring-blue-500">
                            <span class="text-gray-700 font-medium">Remember this device</span>
                        </label>
                        
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-blue-600 hover:text-blue-700 font-semibold transition-colors">
                                Forgot password?
                            </a>
                        @endif
                    </div>

                    <!-- Login Button -->
                    <button 
                        type="submit" 
                        class="w-full bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white font-bold py-4 px-6 rounded-2xl transition-all transform hover:scale-105 login-btn text-lg shadow-lg"
                    >
                        <i class="fas fa-sign-in-alt mr-3"></i>
                        Secure Login
                    </button>
                </form>

                <!-- Quick Access Panel -->
                <div class="mt-8 p-6 bg-gradient-to-br from-blue-50 to-indigo-50 rounded-2xl border border-blue-200">
                    <h3 class="text-lg font-bold text-blue-800 mb-4 flex items-center">
                        <i class="fas fa-bolt mr-3 text-yellow-500"></i>
                        Quick Access
                    </h3>
                    
                    <!-- Demo Credentials -->
                    <div class="space-y-3">
                        <h4 class="font-semibold text-blue-700 mb-3">Demo Credentials:</h4>
                        <div class="space-y-2">
                            <div class="flex justify-between items-center p-3 bg-white rounded-xl border border-blue-100 hover:border-blue-300 transition-colors cursor-pointer demo-credential" data-email="admin@stuniversity.edu" data-password="admin123">
                                <div class="flex items-center space-x-3">
                                    <div class="w-8 h-8 bg-red-100 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-crown text-red-500 text-sm"></i>
                                    </div>
                                    <span class="text-gray-600">Admin Access</span>
                                </div>
                                <span class="font-mono text-blue-600 text-sm">admin@stuniversity.edu</span>
                            </div>
                            <div class="flex justify-between items-center p-3 bg-white rounded-xl border border-blue-100 hover:border-blue-300 transition-colors cursor-pointer demo-credential" data-email="hr@stuniversity.edu" data-password="hr123">
                                <div class="flex items-center space-x-3">
                                    <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-users text-green-500 text-sm"></i>
                                    </div>
                                    <span class="text-gray-600">HR Manager</span>
                                </div>
                                <span class="font-mono text-blue-600 text-sm">hr@stuniversity.edu</span>
                            </div>
                            <div class="flex justify-between items-center p-3 bg-white rounded-xl border border-blue-100 hover:border-blue-300 transition-colors cursor-pointer demo-credential" data-email="security@stuniversity.edu" data-password="security123">
                                <div class="flex items-center space-x-3">
                                    <div class="w-8 h-8 bg-yellow-100 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-shield-alt text-yellow-500 text-sm"></i>
                                    </div>
                                    <span class="text-gray-600">Security Officer</span>
                                </div>
                                <span class="font-mono text-blue-600 text-sm">security@stuniversity.edu</span>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Login Note -->
                    <div class="mt-4 p-3 bg-yellow-50 rounded-lg border border-yellow-200">
                        <p class="text-yellow-700 text-sm flex items-center">
                            <i class="fas fa-info-circle mr-2"></i>
                            <span>Click on any demo credential to auto-fill the form</span>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Enhanced Footer -->
            <div class="bg-gradient-to-r from-gray-50 to-blue-50 px-8 py-6 text-center border-t border-gray-200">
                <p class="text-sm text-gray-600 mb-2">
                    &copy; 2024 STU University. Key Management System v2.0
                </p>
                <div class="flex justify-center space-x-6">
                    <span class="text-xs text-green-600 font-semibold flex items-center">
                        <i class="fas fa-shield-check mr-1"></i> Secure
                    </span>
                    <span class="text-xs text-blue-600 font-semibold flex items-center">
                        <i class="fas fa-bolt mr-1"></i> Reliable
                    </span>
                    <span class="text-xs text-purple-600 font-semibold flex items-center">
                        <i class="fas fa-rocket mr-1"></i> Efficient
                    </span>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Interactive Elements
        document.addEventListener('DOMContentLoaded', function() {
            // Role Selection
            const roleCards = document.querySelectorAll('.role-card');
            roleCards.forEach(card => {
                card.addEventListener('click', function() {
                    roleCards.forEach(c => {
                        c.classList.remove('selected');
                    });
                    
                    this.classList.add('selected');
                    
                    // Auto-fill email based on role
                    const role = this.getAttribute('data-role');
                    const emailInput = document.getElementById('email');
                    const passwordInput = document.getElementById('password');
                    
                    if (role === 'admin') {
                        emailInput.value = 'admin@stuniversity.edu';
                        passwordInput.value = 'admin123';
                    } else if (role === 'hr') {
                        emailInput.value = 'hr@stuniversity.edu';
                        passwordInput.value = 'hr123';
                    } else if (role === 'security') {
                        emailInput.value = 'security@stuniversity.edu';
                        passwordInput.value = 'security123';
                    }
                    
                    // Trigger validation
                    emailInput.dispatchEvent(new Event('input'));
                });
            });

            // Password Toggle
            const passwordToggle = document.getElementById('passwordToggle');
            const passwordInput = document.getElementById('password');
            passwordToggle.addEventListener('click', function() {
                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    passwordToggle.classList.replace('fa-eye', 'fa-eye-slash');
                } else {
                    passwordInput.type = 'password';
                    passwordToggle.classList.replace('fa-eye-slash', 'fa-eye');
                }
            });

            // Email Validation
            const emailInput = document.getElementById('email');
            const emailValid = document.getElementById('emailValid');
            
            emailInput.addEventListener('input', function() {
                if (this.value.includes('@stuniversity.edu')) {
                    emailValid.classList.remove('hidden');
                    this.classList.add('border-green-500');
                    this.classList.remove('border-red-500');
                } else if (this.value.length > 0) {
                    emailValid.classList.add('hidden');
                    this.classList.add('border-red-500');
                    this.classList.remove('border-green-500');
                } else {
                    emailValid.classList.add('hidden');
                    this.classList.remove('border-green-500', 'border-red-500');
                }
            });

            // Demo Credential Auto-fill
            document.querySelectorAll('.demo-credential').forEach(credential => {
                credential.addEventListener('click', function() {
                    const email = this.getAttribute('data-email');
                    const password = this.getAttribute('data-password');
                    
                    emailInput.value = email;
                    passwordInput.value = password;
                    
                    // Trigger validation
                    emailInput.dispatchEvent(new Event('input'));
                    
                    // Add visual feedback
                    this.style.transform = 'scale(0.95)';
                    setTimeout(() => {
                        this.style.transform = 'scale(1)';
                    }, 150);
                });
            });

            // Auto-focus on email field
            emailInput.focus();
        });
    </script>
</body>
</html>