@extends('layouts.app')

@section('title', 'Analytics Dashboard')

@section('subtitle', 'System-wide metrics and performance trends')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Stats Cards -->
    <div class="bg-white overflow-hidden shadow rounded-lg">
        <div class="p-5">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <i class="fas fa-arrow-right text-2xl text-blue-600"></i>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500 truncate">Today's Checkouts</dt>
                        <dd class="text-lg font-medium text-gray-900">{{ $stats['today_checkouts'] }}</dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white overflow-hidden shadow rounded-lg">
        <div class="p-5">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <i class="fas fa-calendar-week text-2xl text-green-600"></i>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500 truncate">This Week</dt>
                        <dd class="text-lg font-medium text-gray-900">{{ $stats['week_checkouts'] }}</dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white overflow-hidden shadow rounded-lg">
        <div class="p-5">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <i class="fas fa-clock text-2xl text-orange-600"></i>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500 truncate">Avg. Duration</dt>
                        <dd class="text-lg font-medium text-gray-900">
                            {{ $stats['avg_checkout_duration'] }} min
                        </dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white overflow-hidden shadow rounded-lg">
        <div class="p-5">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <i class="fas fa-map-marker-alt text-2xl text-purple-600"></i>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500 truncate">Busiest Location</dt>
                        <dd class="text-lg font-medium text-gray-900">
                            @if($stats['busiest_location'])
                                {{ $stats['busiest_location']->name }}
                            @else
                                N/A
                            @endif
                        </dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
    <!-- Hourly Activity Chart -->
    <div class="bg-white shadow rounded-lg">
        <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
            <h3 class="text-lg leading-6 font-medium text-gray-900">
                Hourly Activity
            </h3>
            <p class="mt-1 text-sm text-gray-500">
                Key checkouts by hour ({{ now()->format('M j, Y') }})
            </p>
        </div>
        <div class="px-4 py-5 sm:p-6">
            @php
                $hasActivity = false;
                $hourlyValues = $hourlyActivity->values()->toArray();
                $maxCount = !empty($hourlyValues) ? max($hourlyValues) : 1;
                foreach ($hourlyValues as $count) {
                    if ($count > 0) {
                        $hasActivity = true;
                        break;
                    }
                }
            @endphp

            @if($hasActivity)
            <div class="space-y-3">
                @for($hour = 0; $hour < 24; $hour++)
                    @php
                        $count = $hourlyActivity->get($hour, 0);
                        $percentage = $maxCount > 0 ? ($count / $maxCount) * 100 : 0;
                        $barColor = $count > 0 ? 'bg-blue-500' : 'bg-gray-200';
                    @endphp
                    <div class="flex items-center">
                        <div class="w-12 text-sm text-gray-500 text-right pr-2">
                            {{ sprintf('%02d:00', $hour) }}
                        </div>
                        <div class="flex-1">
                            <div class="bg-gray-200 rounded-full h-6 overflow-hidden">
                                <div class="{{ $barColor }} h-6 rounded-full transition-all duration-300" 
                                     style="width: {{ max(5, $percentage) }}%">
                                </div>
                            </div>
                        </div>
                        <div class="w-8 text-sm text-gray-700 text-right pl-2">
                            {{ $count }}
                        </div>
                    </div>
                @endfor
            </div>
            @else
            <div class="text-center py-8">
                <i class="fas fa-chart-bar text-4xl text-gray-300 mb-4"></i>
                <p class="text-gray-500">No activity data available for today</p>
            </div>
            @endif
        </div>
    </div>

    <!-- Top Keys -->
    <div class="bg-white shadow rounded-lg">
        <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
            <h3 class="text-lg leading-6 font-medium text-gray-900">
                Top Keys This Week
            </h3>
            <p class="mt-1 text-sm text-gray-500">
                Most frequently checked out keys
            </p>
        </div>
        <div class="px-4 py-5 sm:p-6">
            @if($topKeys->count() > 0)
            <div class="flow-root">
                <ul class="-mb-8">
                    @foreach($topKeys as $key)
                    <li class="relative pb-6">
                        <div class="relative flex space-x-3">
                            <div class="min-w-0 flex-1 flex justify-between items-center">
                                <div>
                                    <p class="text-sm font-medium text-gray-900">
                                        {{ $key->label }}
                                    </p>
                                    <p class="text-sm text-gray-500">
                                        {{ $key->code }} • {{ $key->location->name }}
                                    </p>
                                </div>
                                <div class="text-right">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        {{ $key->recent_checkouts }} checkouts
                                    </span>
                                </div>
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
            @else
            <div class="text-center py-8">
                <i class="fas fa-key text-4xl text-gray-300 mb-4"></i>
                <p class="text-gray-500">No key usage data available</p>
            </div>
            @endif
        </div>
    </div>
</div>

<!-- Additional Metrics -->
<div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-8">
    <!-- Location Performance -->
    <div class="bg-white shadow rounded-lg">
        <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
            <h3 class="text-lg leading-6 font-medium text-gray-900">
                Location Performance
            </h3>
            <p class="mt-1 text-sm text-gray-500">
                Checkout activity by location this week
            </p>
        </div>
        <div class="px-4 py-5 sm:p-6">
            @if($stats['busiest_location'])
            <div class="text-center">
                <div class="mx-auto h-16 w-16 bg-purple-100 rounded-full flex items-center justify-center mb-4">
                    <i class="fas fa-trophy text-purple-600 text-xl"></i>
                </div>
                <h4 class="text-lg font-medium text-gray-900">{{ $stats['busiest_location']->name }}</h4>
                <p class="text-sm text-gray-500">{{ $stats['busiest_location']->full_address }}</p>
                <div class="mt-2">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-purple-100 text-purple-800">
                        <i class="fas fa-fire mr-1"></i>
                        Busiest Location
                    </span>
                </div>
            </div>
            @else
            <div class="text-center py-8">
                <i class="fas fa-map-marker-alt text-4xl text-gray-300 mb-4"></i>
                <p class="text-gray-500">No location data available</p>
            </div>
            @endif
        </div>
    </div>

    <!-- Performance Summary -->
    <div class="bg-white shadow rounded-lg">
        <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
            <h3 class="text-lg leading-6 font-medium text-gray-900">
                Performance Summary
            </h3>
            <p class="mt-1 text-sm text-gray-500">
                Key system metrics and averages
            </p>
        </div>
        <div class="px-4 py-5 sm:p-6">
            <div class="space-y-4">
                <div class="flex justify-between items-center">
                    <span class="text-sm text-gray-500">Daily Average Checkouts</span>
                    <span class="text-sm font-medium text-gray-900">
                        {{ round($stats['week_checkouts'] / 7) }}/day
                    </span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-sm text-gray-500">Average Checkout Duration</span>
                    <span class="text-sm font-medium text-gray-900">
                        {{ $stats['avg_checkout_duration'] }} minutes
                    </span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-sm text-gray-500">System Uptime</span>
                    <span class="text-sm font-medium text-gray-900">100%</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-sm text-gray-500">Data Last Updated</span>
                    <span class="text-sm font-medium text-gray-900">
                        {{ now()->format('M j, Y g:i A') }}
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Quick Reports -->
<div class="mt-8 bg-white shadow rounded-lg">
    <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
        <h3 class="text-lg leading-6 font-medium text-gray-900">
            Quick Reports
        </h3>
    </div>
    <div class="px-4 py-5 sm:p-6">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <a href="{{ route('reports.key-activity') }}?start_date={{ now()->subDays(7)->format('Y-m-d') }}&end_date={{ now()->format('Y-m-d') }}" 
               class="inline-flex items-center justify-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                <i class="fas fa-history mr-2"></i> Last 7 Days
            </a>
            <a href="{{ route('reports.current-holders') }}" 
               class="inline-flex items-center justify-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                <i class="fas fa-users mr-2"></i> Current Holders
            </a>
            <a href="{{ route('reports.overdue-keys') }}" 
               class="inline-flex items-center justify-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                <i class="fas fa-exclamation-triangle mr-2"></i> Overdue Keys
            </a>
            <a href="{{ route('reports.staff-activity') }}?start_date={{ now()->subDays(30)->format('Y-m-d') }}&end_date={{ now()->format('Y-m-d') }}" 
               class="inline-flex items-center justify-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                <i class="fas fa-user-chart mr-2"></i> Staff Activity
            </a>
        </div>
    </div>
</div>
@endsection
