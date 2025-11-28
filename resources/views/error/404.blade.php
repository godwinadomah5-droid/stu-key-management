<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Not Found - Key Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex items-center justify-center">
        <div class="text-center">
            <div class="bg-white p-8 rounded-lg shadow-md max-w-md">
                <div class="text-6xl mb-4">🔍</div>
                <h1 class="text-3xl font-bold text-gray-800 mb-4">404 - Page Not Found</h1>
                <p class="text-gray-600 mb-6">The page you're looking for doesn't exist.</p>
                <a href="{{ url('/') }}" 
                   class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition duration-200">
                   Go Home
                </a>
            </div>
        </div>
    </div>
</body>
</html>