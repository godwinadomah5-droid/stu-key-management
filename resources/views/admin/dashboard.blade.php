@extends('layouts.app')

@section('title', 'Dashboard - STU Key Management')

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
        <div class="bg-gray-50 px-5 py-3">
            <div class="text-sm">
                <span class="text-gray-500">Registered in system</span>
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
        <div class="bg-gray-50 px-5 py-3">
            <div class="text-sm">
                <span class="text-gray-500">Ready for checkout</span>
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
        <div class="bg-gray-50 px-5 py-3">
            <div class="text-sm">
                <span class="text-gray-500">Currently with staff</span>
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
        <div class="bg-gray-50 px-5 py-3">
            <div class="text-sm">
                <a href="{{ route('reports.overdue-keys') }}" class="text-red-600 hover:text-red-500">
                    Review overdue keys →
                </a>
            </div>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Recent Activity -->
    <div class="lg:col-span-2">
        <div class="bg-white shadow rounded-lg">
            <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-lg leading-6 font-medium text-gray-900">
                            Recent Activity
                        </h3>
                        <p class="mt-1 text-sm text-gray-500">
                            Latest key transactions in the system
                        </p>
                    </div>
                    <a href="{{ route('reports.key-activity') }}" class="text-sm font-medium text-blue-600 hover:text-blue-500">
                        View all →
                    </a>
                </div>
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
                                        <p class="text-xs text-gray-400 mt-1">
                                            {{ $activity->created_at->diffForHumans() }} • 
                                            {{ $activity->key->location->campus }}
                                        </p>
                                    </div>
                                    <div class="text-right text-sm whitespace-nowrap text-gray-500">
                                        {{ $activity->receiver->name }}
                                        @if($activity->discrepancy)
                                        <span class="ml-2 inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-red-100 text-red-800">
                                            <i class="fas fa-exclamation-triangle mr-1"></i> Issue
                                        </span>
                                        @endif
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

    <!-- Busiest Locations -->
    <div>
        <div class="bg-white shadow rounded-lg">
            <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                <h3 class="text-lg leading-6 font-medium text-gray-900">
                    Busiest Locations
                </h3>
                <p class="mt-1 text-sm text-gray-500">
                    Last 7 days activity
                </p>
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
                                                {{ $location->campus }}
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
                <div class="mt-4">
                    <a href="{{ route('locations.index') }}" class="text-sm font-medium text-blue-600 hover:text-blue-500">
                        View all locations →
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
@can('access kiosk')
<div class="mt-8 bg-white shadow rounded-lg">
    <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
        <h3 class="text-lg leading-6 font-medium text-gray-900">
            Quick Actions
        </h3>
        <p class="mt-1 text-sm text-gray-500">
            Fast access to common tasks
        </p>
    </div>
    <div class="px-4 py-5 sm:p-6">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <a href="{{ route('kiosk.scan') }}" class="inline-flex items-center justify-center px-4 py-3 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                <i class="fas fa-qrcode mr-2"></i> Scan Key
            </a>
            <a href="{{ route('keys.index') }}" class="inline-flex items-center justify-center px-4 py-3 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                <i class="fas fa-key mr-2"></i> Manage Keys
            </a>
            <a href="{{ route('hr.staff.index') }}" class="inline-flex items-center justify-center px-4 py-3 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                <i class="fas fa-users mr-2"></i> Staff Directory
            </a>
            <a href="{{ route('reports.index') }}" class="inline-flex items-center justify-center px-4 py-3 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                <i class="fas fa-chart-bar mr-2"></i> View Reports
            </a>
        </div>
    </div>
</div>
@endcan

<!-- System Status -->
<div class="mt-8 bg-white shadow rounded-lg">
    <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
        <h3 class="text-lg leading-6 font-medium text-gray-900">
            System Status
        </h3>
    </div>
    <div class="px-4 py-5 sm:p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            <div class="p-4 border border-gray-200 rounded-lg">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <i class="fas fa-database text-2xl text-green-600"></i>
                    </div>
                    <div class="ml-4">
                        <h4 class="text-sm font-medium text-gray-900">Database</h4>
                        <p class="text-sm text-gray-500">Connected</p>
                    </div>
                </div>
            </div>
            
            <div class="p-4 border border-gray-200 rounded-lg">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <i class="fas fa-sms text-2xl text-blue-600"></i>
                    </div>
                    <div class="ml-4">
                        <h4 class="text-sm font-medium text-gray-900">SMS Notifications</h4>
                        <p class="text-sm text-gray-500">
                            @if(config('services.sms.default') == 'hubtel' && config('services.hubtel.client_id'))
                            Active
                            @else
                            Disabled
                            @endif
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="p-4 border border-gray-200 rounded-lg">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <i class="fas fa-sync-alt text-2xl text-orange-600"></i>
                    </div>
                    <div class="ml-4">
                        <h4 class="text-sm font-medium text-gray-900">HR Sync</h4>
                        <p class="text-sm text-gray-500">
                            @if(config('services.hr_sync.enabled'))
                            Enabled
                            @else
                            Disabled
                            @endif
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="p-4 border border-gray-200 rounded-lg">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <i class="fas fa-shield-alt text-2xl text-purple-600"></i>
                    </div>
                    <div class="ml-4">
                        <h4 class="text-sm font-medium text-gray-900">Security</h4>
                        <p class="text-sm text-gray-500">HTTPS Active</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
// Update last login time display
document.addEventListener('DOMContentLoaded', function() {
    const lastLoginTime = document.getElementById('lastLoginTime');
    if (lastLoginTime) {
        // You can update this with actual last login time from user model
        lastLoginTime.textContent = 'Just now';
    }
});
</script>
@endpush
