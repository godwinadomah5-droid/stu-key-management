<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Emergency Procedures - STU Security</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50 min-h-screen">
    <!-- Navigation -->
    <nav class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="{{ route('security.dashboard') }}" class="text-blue-600 hover:text-blue-800 flex items-center">
                        <i class="fas fa-arrow-left mr-2"></i> Back to Security Dashboard
                    </a>
                </div>
                <div class="flex items-center space-x-4">
                    <span class="text-gray-700">{{ Auth::user()->name }}</span>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="text-gray-500 hover:text-red-500">
                            <i class="fas fa-sign-out-alt"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto p-6">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Emergency Procedures</h1>
            <p class="text-gray-600">Standard operating procedures for security emergencies</p>
        </div>

        <!-- Emergency Contacts -->
        <div class="bg-red-50 border border-red-200 rounded-lg p-6 mb-8">
            <h2 class="text-xl font-semibold text-red-800 mb-4 flex items-center">
                <i class="fas fa-phone-alt mr-2"></i>Emergency Contacts
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="bg-white rounded-lg p-4 border border-red-300">
                    <p class="font-semibold text-red-700">Campus Police</p>
                    <p class="text-2xl font-bold text-red-600">911</p>
                    <p class="text-sm text-gray-600">Emergency only</p>
                </div>
                <div class="bg-white rounded-lg p-4 border border-red-300">
                    <p class="font-semibold text-red-700">Security Office</p>
                    <p class="text-2xl font-bold text-red-600">(555) 123-4567</p>
                    <p class="text-sm text-gray-600">24/7 Security Line</p>
                </div>
                <div class="bg-white rounded-lg p-4 border border-red-300">
                    <p class="font-semibold text-red-700">IT Emergency</p>
                    <p class="text-2xl font-bold text-red-600">(555) 123-4568</p>
                    <p class="text-sm text-gray-600">System emergencies</p>
                </div>
            </div>
        </div>

        <!-- Emergency Procedures -->
        <div class="space-y-6">
            @foreach($procedures as $procedure)
            <div class="bg-white rounded-lg shadow border-l-4 
                @if($procedure->level === 'high') border-red-500
                @elseif($procedure->level === 'medium') border-yellow-500
                @else border-green-500 @endif">
                <div class="p-6">
                    <div class="flex items-start justify-between mb-4">
                        <h3 class="text-xl font-semibold text-gray-800">{{ $procedure->title }}</h3>
                        <span class="px-3 py-1 rounded-full text-sm font-medium 
                            @if($procedure->level === 'high') bg-red-100 text-red-800
                            @elseif($procedure->level === 'medium') bg-yellow-100 text-yellow-800
                            @else bg-green-100 text-green-800 @endif">
                            {{ ucfirst($procedure->level) }} Priority
                        </span>
                    </div>
                    
                    <div class="space-y-3">
                        @foreach($procedure->steps as $index => $step)
                        <div class="flex items-start space-x-3">
                            <div class="w-6 h-6 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center text-sm font-bold mt-1 flex-shrink-0">
                                {{ $index + 1 }}
                            </div>
                            <p class="text-gray-700">{{ $step }}</p>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Quick Action Buttons -->
        <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold mb-4">Emergency Lockdown</h3>
                <button class="w-full bg-red-600 hover:bg-red-700 text-white py-3 px-4 rounded-lg transition-colors font-semibold">
                    <i class="fas fa-lock mr-2"></i>Initiate Campus Lockdown
                </button>
                <p class="text-sm text-gray-600 mt-2">Use only in extreme emergency situations</p>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold mb-4">Emergency Broadcast</h3>
                <button class="w-full bg-orange-600 hover:bg-orange-700 text-white py-3 px-4 rounded-lg transition-colors font-semibold">
                    <i class="fas fa-bullhorn mr-2"></i>Send Emergency Alert
                </button>
                <p class="text-sm text-gray-600 mt-2">Broadcast emergency message to all systems</p>
            </div>
        </div>
    </div>
</body>
</html>