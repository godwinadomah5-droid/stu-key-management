@extends('layouts.dashboard')

@section('title', 'Dashboard')

@section('content')
<div class="max-w-7xl mx-auto">
    <h2 class="text-2xl font-bold mb-6">Welcome, {{ Auth::user()->name ?? 'Security Officer' }} 👋</h2>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Card 1 -->
        <div class="bg-white rounded-lg shadow-md p-6 text-center">
            <h3 class="text-gray-600">Total Keys</h3>
            <p class="text-3xl font-bold text-blue-700 mt-2">{{ $totalKeys ?? 0 }}</p>
        </div>

        <!-- Card 2 -->
        <div class="bg-white rounded-lg shadow-md p-6 text-center">
            <h3 class="text-gray-600">Keys Checked Out</h3>
            <p class="text-3xl font-bold text-yellow-600 mt-2">{{ $checkedOut ?? 0 }}</p>
        </div>

        <!-- Card 3 -->
        <div class="bg-white rounded-lg shadow-md p-6 text-center">
            <h3 class="text-gray-600">Active Security Shifts</h3>
            <p class="text-3xl font-bold text-green-600 mt-2">{{ $activeShifts ?? 0 }}</p>
        </div>
    </div>

    <div class="mt-10">
        <h3 class="text-xl font-semibold mb-4">Recent Key Activity</h3>
        <table class="min-w-full bg-white border rounded-lg shadow">
            <thead class="bg-gray-200 text-gray-600">
                <tr>
                    <th class="py-2 px-4 text-left">Key Label</th>
                    <th class="py-2 px-4 text-left">Action</th>
                    <th class="py-2 px-4 text-left">Handled By</th>
                    <th class="py-2 px-4 text-left">Date</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentLogs ?? [] as $log)
                    <tr class="border-b">
                        <td class="py-2 px-4">{{ $log->key->label ?? 'N/A' }}</td>
                        <td class="py-2 px-4 capitalize">{{ $log->action }}</td>
                        <td class="py-2 px-4">{{ $log->receiver_name ?? 'System' }}</td>
                        <td class="py-2 px-4">{{ $log->created_at->format('d M, Y h:i A') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="py-4 text-center text-gray-500">No recent activities found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
