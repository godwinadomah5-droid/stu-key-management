@extends('layouts.app')

@section('title', 'System Health')

@section('subtitle', 'Monitor system performance and status')

@section('actions')
<a href="{{ route('admin.settings') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
    <i class="fas fa-cog mr-2"></i> Settings
</a>
@endsection

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
    <!-- System Status -->
    <div class="bg-white overflow-hidden shadow rounded-lg">
        <div class="p-5">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <i class="fas fa-server text-2xl text-green-600"></i>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500 truncate">System Status</dt>
                        <dd class="text-lg font-medium text-gray-900">Operational</dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>

    <!-- Disk Space -->
    <div class="bg-white overflow-hidden shadow rounded-lg">
        <div class="p-5">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <i class="fas fa-hdd text-2xl text-blue-600"></i>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500 truncate">Disk Space</dt>
                        <dd class="text-lg font-medium text-gray-900">{{ number_format($health['disk_space'], 1) }} GB Free</dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>

    <!-- Queue Workers -->
    <div class="bg-white overflow-hidden shadow rounded-lg">
        <div class="p-5">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <i class="fas fa-tasks text-2xl text-orange-600"></i>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500 truncate">Pending Jobs</dt>
                        <dd class="text-lg font-medium text-gray-900">{{ $health['queue_workers'] }}</dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
    <!-- System Information -->
    <div class="bg-white shadow rounded-lg">
        <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
            <h3 class="text-lg leading-6 font-medium text-gray-900">System Information</h3>
        </div>
        <div class="px-4 py-5 sm:p-6">
            <div class="space-y-3">
                <div class="flex justify-between">
                    <span class="text-sm text-gray-500">Laravel Version</span>
                    <span class="text-sm font-medium text-gray-900">{{ app()->version() }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-sm text-gray-500">PHP Version</span>
                    <span class="text-sm font-medium text-gray-900">{{ PHP_VERSION }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-sm text-gray-500">Environment</span>
                    <span class="text-sm font-medium text-gray-900">{{ app()->environment() }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-sm text-gray-500">Last Cron Run</span>
                    <span class="text-sm font-medium text-gray-900">{{ $health['last_cron'] ?? 'Never' }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Issues -->
    <div class="bg-white shadow rounded-lg">
        <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
            <h3 class="text-lg leading-6 font-medium text-gray-900">Recent Issues</h3>
        </div>
        <div class="px-4 py-5 sm:p-6">
            @if($health['failed_jobs'] > 0)
            <div class="bg-red-50 border border-red-200 rounded-md p-4 mb-4">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <i class="fas fa-exclamation-triangle text-red-400"></i>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-red-800">Failed Jobs</h3>
                        <div class="mt-2 text-sm text-red-700">
                            <p>{{ $health['failed_jobs'] }} jobs failed in the last 24 hours</p>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            @if($health['pending_notifications'] > 0)
            <div class="bg-yellow-50 border border-yellow-200 rounded-md p-4">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <i class="fas fa-bell text-yellow-400"></i>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-yellow-800">Pending Notifications</h3>
                        <div class="mt-2 text-sm text-yellow-700">
                            <p>{{ $health['pending_notifications'] }} notifications pending delivery</p>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            @if($health['failed_jobs'] == 0 && $health['pending_notifications'] == 0)
            <div class="text-center py-8">
                <i class="fas fa-check-circle text-4xl text-green-300 mb-4"></i>
                <p class="text-gray-500">No recent issues detected</p>
            </div>
            @endif
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="mt-8 bg-white shadow rounded-lg">
    <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
        <h3 class="text-lg leading-6 font-medium text-gray-900">Maintenance</h3>
    </div>
    <div class="px-4 py-5 sm:p-6">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <button onclick="clearCache()" 
                    class="inline-flex items-center justify-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                <i class="fas fa-broom mr-2"></i> Clear Cache
            </button>
            <button onclick="runBackup()" 
                    class="inline-flex items-center justify-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                <i class="fas fa-download mr-2"></i> Run Backup
            </button>
            <button onclick="optimizeDatabase()" 
                    class="inline-flex items-center justify-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                <i class="fas fa-database mr-2"></i> Optimize DB
            </button>
            <button onclick="runCron()" 
                    class="inline-flex items-center justify-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                <i class="fas fa-clock mr-2"></i> Run Cron
            </button>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function clearCache() {
    if (confirm('Are you sure you want to clear all caches?')) {
        fetch('/admin/clear-cache', { method: 'POST' })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Cache cleared successfully');
                    location.reload();
                }
            });
    }
}

function runBackup() {
    alert('Backup functionality would be implemented here');
}

function optimizeDatabase() {
    alert('Database optimization would be implemented here');
}

function runCron() {
    alert('Cron job execution would be implemented here');
}
</script>
@endpush
