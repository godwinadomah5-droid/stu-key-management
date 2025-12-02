<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - STU Key Management</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .stu-gradient-bg {
            background: linear-gradient(135deg, #1a5c36 0%, #2e7d5a 100%);
        }
        .btn-stu-primary {
            background-color: #1a5c36;
            color: white;
        }
        .btn-stu-primary:hover {
            background-color: #0f3d23;
        }
        /* Logo container animation */
        .logo-container {
            transition: transform 0.3s ease;
        }
        .logo-container:hover {
            transform: scale(1.05);
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen flex items-center justify-center">
    <div class="max-w-md w-full space-y-8 p-8">
        <div class="text-center">
            <!-- Logo Container -->
            <div class="logo-container mx-auto mb-6">
                <div class="h-28 w-28 mx-auto bg-white rounded-full flex items-center justify-center shadow-xl border-4 border-green-100 p-3">
                    <!-- STU Logo Image -->
                    <img src="{{ asset('images/logo/stu.png') }}" 
                         alt="Sunyani Technical University Logo" 
                         class="h-full w-full object-contain rounded-full"
                         onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                    
                    <!-- Fallback if logo doesn't load -->
                    <div class="h-full w-full rounded-full stu-gradient-bg flex items-center justify-center hidden">
                        <i class="fas fa-university text-white text-3xl"></i>
                    </div>
                </div>
            </div>
            
            <!-- University Name and System Title -->
            <div class="mb-6">
                <h1 class="text-2xl font-bold text-green-900 mb-1">
                    Sunyani Technical University
                </h1>
                <h2 class="text-xl font-semibold text-gray-800">
                    Key Management System
                </h2>
                <div class="mt-3 inline-flex items-center px-4 py-2 bg-green-50 text-green-800 rounded-lg text-sm font-medium border border-green-200">
                    <i class="fas fa-shield-alt mr-2 text-green-600"></i> Secure Access Portal
                </div>
            </div>
        </div>

        @if($errors->any())
        <div class="bg-red-50 border border-red-200 rounded-lg p-4 animate-pulse">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <i class="fas fa-exclamation-triangle text-red-500 mt-0.5"></i>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-red-800">Login Error</h3>
                    <div class="mt-2 text-sm text-red-700">
                        <ul class="list-disc list-inside space-y-1">
                            @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        @endif

        @if(session('status'))
        <div class="bg-green-50 border border-green-200 rounded-lg p-4">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <i class="fas fa-check-circle text-green-500 mt-0.5"></i>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-green-700">{{ session('status') }}</p>
                </div>
            </div>
        </div>
        @endif

        <div class="bg-white py-8 px-6 shadow-xl rounded-lg sm:px-10 border border-green-100">
            @yield('content')
        </div>

        <div class="text-center text-sm text-gray-600">
            <div class="flex items-center justify-center mb-2">
                <i class="fas fa-university mr-2 text-green-600"></i>
                <span class="font-medium text-green-800">Takoradi Technical University</span>
            </div>
            <p class="text-gray-500">&copy; {{ date('Y') }} All Rights Reserved</p>
            <p class="mt-1 text-xs text-gray-400">Authorized Personnel Only | IT Support: it-support@stu.edu.gh</p>
        </div>
    </div>

    <script>
        // Add logo loading state
        document.addEventListener('DOMContentLoaded', function() {
            const logoImg = document.querySelector('img[src*="stu.PNG"]');
            if (logoImg) {
                logoImg.onload = function() {
                    console.log('STU logo loaded successfully');
                };
                logoImg.onerror = function() {
                    console.warn('STU logo failed to load, showing fallback');
                    // Show fallback and add warning
                    const fallback = logoImg.nextElementSibling;
                    if (fallback) {
                        fallback.style.display = 'flex';
                        logoImg.style.display = 'none';
                        
                        // Add a small notice
                        const notice = document.createElement('div');
                        notice.className = 'mt-2 text-xs text-yellow-600';
                        notice.innerHTML = '<i class="fas fa-exclamation-triangle mr-1"></i> Using default logo';
                        logoImg.parentNode.appendChild(notice);
                    }
                };
            }
        });
    </script>
</body>
</html>