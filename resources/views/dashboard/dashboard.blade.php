<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Key Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <nav class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <h1 class="text-xl font-semibold">🔑 Key Management Dashboard</h1>
                </div>
                <div class="flex items-center space-x-4">
                    <span class="text-gray-700">Welcome, {{ Auth::user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-blue-600 hover:text-blue-800">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="px-4 py-6 sm:px-0">
            <div class="border-4 border-dashed border-gray-200 rounded-lg h-96 p-8 text-center">
                <h2 class="text-2xl font-bold text-gray-700 mb-4">Welcome to your Dashboard!</h2>
                <p class="text-gray-600 mb-6">This is where you'll manage keys, students, and track borrow/return activities.</p>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
                    <div class="bg-white p-6 rounded-lg shadow">
                        <h3 class="font-semibold text-lg mb-2">Key Management</h3>
                        <p class="text-gray-600">Manage all keys in the system</p>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow">
                        <h3 class="font-semibold text-lg mb-2">Student Records</h3>
                        <p class="text-gray-600">View and manage student information</p>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow">
                        <h3 class="font-semibold text-lg mb-2">Reports</h3>
                        <p class="text-gray-600">Generate usage reports</p>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>