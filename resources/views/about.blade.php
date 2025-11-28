<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About - Key Management System</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <nav class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="text-xl font-semibold">🔑 Key Management System</a>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="{{ route('home') }}" class="text-blue-600 hover:text-blue-800">Home</a>
                    <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-800">Login</a>
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-4xl mx-auto py-12 px-4">
        <div class="bg-white rounded-lg shadow-md p-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-6">About Our System</h1>
            
            <div class="prose max-w-none">
                <p class="text-gray-600 mb-4">
                    The Student Key Management System is designed to efficiently manage key borrowing and returning 
                    processes in educational institutions.
                </p>
                
                <h2 class="text-xl font-semibold text-gray-800 mt-6 mb-3">Features</h2>
                <ul class="list-disc list-inside text-gray-600 space-y-2">
                    <li>Secure key tracking and management</li>
                    <li>Student database integration</li>
                    <li>Real-time key status updates</li>
                    <li>Borrowing history and reports</li>
                    <li>User-friendly interface</li>
                </ul>
                
                <h2 class="text-xl font-semibold text-gray-800 mt-6 mb-3">Benefits</h2>
                <ul class="list-disc list-inside text-gray-600 space-y-2">
                    <li>Reduced key loss</li>
                    <li>Improved accountability</li>
                    <li>Streamlined processes</li>
                    <li>Enhanced security</li>
                </ul>
            </div>
            
            <div class="mt-8 pt-6 border-t">
                <a href="{{ route('home') }}" 
                   class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition duration-200">
                   Back to Home
                </a>
            </div>
        </div>
    </main>
</body>
</html>