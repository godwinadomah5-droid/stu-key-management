@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Stats Cards -->
    <div class="bg-white overflow-hidden shadow rounded-lg">
        <div class="p-5">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <i class="fas fa-key text-2xl text-blue-600"></i>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500 truncate">Total Keys</dt>
                        <dd class="text-lg font-medium text-gray-900">{{ $stats['total_keys'] }}</dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white overflow-hidden shadow rounded-lg">
        <div class="p-5">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <i class="fas fa-check-circle text-2xl text-green-600"></i>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500 truncate">Available Keys</dt>
                        <dd class="text-lg font-medium text-gray-900">{{ $stats['available_keys'] }}</dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white overflow-hidden shadow rounded-lg">
        <div class="p-5">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <i class="fas fa-user-check text-2xl text-orange-600"></i>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500 truncate">Checked Out</dt>
                        <dd class="text-lg font-medium text-gray-900">{{ $stats['checked_out_keys'] }}</dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white overflow-hidden shadow rounded-lg">
        <div class="p-5">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <i class="fas fa-exclamation-triangle text-2xl text-red-600"></i>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500 truncate">Overdue Keys</dt>
                        <dd class="text-lg font-medium text-gray-900">{{ $stats['overdue_keys'] }}</dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
    <!-- Recent Activity -->
    <div class="bg-white shadow rounded-lg">
        <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
            <h3 class="text-lg leading-6 font-medium text-gray-900">
                Recent Activity
            </h3>
        </div>
        <div class="px-4 py-5 sm:p-6">
            <div class="flow-root">
                <ul class="-mb-8">
                    @foreach($recentActivity as $activity)
                    <li class="relative pb-8">
                        <div class="relative flex space-x-3">
                            <div>
                                <span class="h-8 w-8 rounded-full flex items-center justify-center ring-8 ring-white 
                                    {{ $activity->action === 'checkout' ? 'bg-green-500' : 'bg-blue-500' }}">
                                    <i class="fas fa-{{ $activity->action === 'checkout' ? 'arrow-right' : 'arrow-left' }} text-white text-sm"></i>
                                </span>
                            </div>
                            <div class="min-w-0 flex-1 pt-1.5 flex justify-between space-x-4">
                                <div>
                                    <p class="text-sm text-gray-500">
                                        Key <span class="font-medium text-gray-900">{{ $activity->key->label }}</span>
                                        was {{ $activity->action === 'checkout' ? 'checked out' : 'checked in' }}
                                        by <span class="font-medium">{{ $activity->holder_name }}</span>
                                    </p>
                                    <p class="text-xs text-gray-400">
                                        {{ $activity->created_at->diffForHumans() }}
                                    </p>
                                </div>
                                <div class="text-right text-sm whitespace-nowrap text-gray-500">
                                    {{ $activity->receiver->name }}
                                </div>
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    <!-- Busiest Locations -->
    <div class="bg-white shadow rounded-lg">
        <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
            <h3 class="text-lg leading-6 font-medium text-gray-900">
                Busiest Locations (Last 7 Days)
            </h3>
        </div>
        <div class="px-4 py-5 sm:p-6">
            <div class="flow-root">
                <ul class="-mb-8">
                    @foreach($busiestLocations as $location)
                    <li class="relative pb-6">
                        <div class="relative flex space-x-3">
                            <div class="min-w-0 flex-1">
                                <div class="flex justify-between items-center">
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">
                                            {{ $location->name }}
                                        </p>
                                        <p class="text-sm text-gray-500">
                                            {{ $location->campus }} - {{ $location->building }}
                                        </p>
                                    </div>
                                    <div class="text-right">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                            {{ $location->recent_checkouts }} checkouts
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- Active Shifts Section -->
<div class="mt-8 bg-white shadow rounded-lg">
    <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
        <h3 class="text-lg leading-6 font-medium text-gray-900">
            Active Security Shifts
        </h3>
        <div class="mt-1 flex items-center">
            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                <i class="fas fa-circle animate-pulse mr-1"></i>
                {{ $stats['active_shifts'] }} Active
            </span>
        </div>
    </div>
    <div class="px-4 py-5 sm:p-6">
        @if(isset($activeShifts) && $activeShifts->count() > 0)
        <div class="space-y-3">
            @foreach($activeShifts as $shift)
            <div class="flex items-center justify-between p-3 rounded-lg border border-gray-100">
                <div class="flex items-center">
                    <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center mr-3">
                        <span class="text-green-600 font-semibold text-sm">{{ substr($shift->user->name, 0, 1) }}</span>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-900">{{ $shift->user->name }}</p>
                        <p class="text-xs text-gray-500">Started {{ $shift->start_at->diffForHumans() }}</p>
                    </div>
                </div>
                <div class="text-right">
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                        {{ $shift->getDurationInMinutes() }} min
                    </span>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center py-8">
            <i class="fas fa-user-clock text-4xl text-gray-300 mb-4"></i>
            <p class="text-gray-500">No active security shifts</p>
        </div>
        @endif
    </div>
</div>

<!-- Quick Actions -->
@can('access kiosk')
<div class="mt-8 bg-white shadow rounded-lg">
    <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
        <h3 class="text-lg leading-6 font-medium text-gray-900">
            Quick Actions
        </h3>
    </div>
    <div class="px-4 py-5 sm:p-6">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <a href="{{ route('kiosk.scan') }}" class="inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                <i class="fas fa-qrcode mr-2"></i> Scan Key
            </a>
            <a href="{{ route('keys.index') }}" class="inline-flex items-center justify-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                <i class="fas fa-key mr-2"></i> View Keys
            </a>
            <a href="{{ route('reports.current-holders') }}" class="inline-flex items-center justify-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                <i class="fas fa-list mr-2"></i> Current Holders
            </a>
            <a href="{{ route('reports.overdue-keys') }}" class="inline-flex items-center justify-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                <i class="fas fa-exclamation-triangle mr-2"></i> Overdue Keys
            </a>
        </div>
    </div>
</div>
@endcan
@endsection
