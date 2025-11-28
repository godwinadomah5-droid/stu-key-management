<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Already Logged In - KeySecure</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen flex items-center justify-center">
    <div class="max-w-md w-full mx-4">
        <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-8">
            <!-- Header -->
            <div class="text-center mb-6">
                <div class="w-16 h-16 gradient-bg rounded-full flex items-center justify-center text-white font-bold text-2xl mx-auto mb-4">
                    <i class="fas fa-user-check"></i>
                </div>
                <h1 class="text-2xl font-bold text-gray-800">Already Logged In</h1>
                <p class="text-gray-600 mt-2">You are already signed in to the system</p>
            </div>

            <!-- User Info -->
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 gradient-bg rounded-full flex items-center justify-center text-white font-bold">
                        {{ substr($user['name'] ?? 'U', 0, 1) }}
                    </div>
                    <div>
                        <p class="font-semibold text-gray-800">{{ $user['name'] ?? 'User' }}</p>
                        <p class="text-sm text-gray-600">{{ $user['username'] ?? 'N/A' }} ({{ $user['role'] ?? 'user' }})</p>
                    </div>
                </div>
            </div>

            <!-- Options -->
            <div class="space-y-3">
                <a href="/admin/dashboard" class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 px-4 rounded-lg font-semibold flex items-center justify-center transition-colors">
                    <i class="fas fa-tachometer-alt mr-2"></i>
                    Go to Dashboard
                </a>
                
                <form action="/logout" method="POST" class="w-full">
                    @csrf
                    <button type="submit" class="w-full bg-gray-600 hover:bg-gray-700 text-white py-3 px-4 rounded-lg font-semibold flex items-center justify-center transition-colors">
                        <i class="fas fa-sign-out-alt mr-2"></i>
                        Logout & Sign In Again
                    </button>
                </form>

                <a href="/force-logout" class="w-full bg-red-600 hover:bg-red-700 text-white py-3 px-4 rounded-lg font-semibold flex items-center justify-center transition-colors">
                    <i class="fas fa-ban mr-2"></i>
                    Force Logout (Clear Session)
                </a>
            </div>

            <!-- Debug Info -->
            <div class="mt-6 pt-6 border-t border-gray-200">
                <p class="text-xs text-gray-500 text-center">
                    Session ID: {{ session()->getId() }}<br>
                    If you believe this is an error, use "Force Logout"
                </p>
            </div>
        </div>
    </div>

    <script>
        // Auto-redirect to dashboard after 5 seconds
        setTimeout(() => {
            window.location.href = '/admin/dashboard';
        }, 5000);
    </script>
</body>
</html>