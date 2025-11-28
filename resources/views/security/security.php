# Run this command to create the directory and file
$securityViewsDir = ".\resources\views\security"
if (!(Test-Path $securityViewsDir)) { New-Item -ItemType Directory -Path $securityViewsDir -Force }

@'
@extends('layouts.app')

@section('title', 'Security Dashboard')

@section('subtitle', 'Key handover station management')

@section('actions')
@if(!auth()->user()->isOnShift())
<a href="{{ route('profile.start-shift') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700">
    <i class="fas fa-play mr-2"></i> Start Shift
</a>
@else
<span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
    <i class="fas fa-circle animate-pulse mr-1"></i> On Shift - {{ auth()->user()->current_shift->getDurationInMinutes() }} min
</span>
@endif
@endsection

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Quick Stats -->
    <div class="bg-white overflow-hidden shadow rounded-lg">
        <div class="p-5">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <i class="fas fa-key text-2xl text-blue-600"></i>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500 truncate">Available Keys</dt>
                        <dd class="text-lg font-medium text-gray-900">{{ \App\Models\Key::available()->count() }}</dd>
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
                        <dd class="text-lg font-medium text-gray-900">{{ \App\Models\Key::checkedOut()->count() }}</dd>
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
                        <dd class="text-lg font-medium text-gray-900">{{ \App\Models\KeyLog::overdue()->count() }}</dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white overflow-hidden shadow rounded-lg">
        <div class="p-5">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <i class="fas fa-clock text-2xl text-green-600"></i>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500 truncate">Shift Duration</dt>
                        <dd class="text-lg font-medium text-gray-900">
                            @if(auth()->user()->isOnShift())
                                {{ auth()->user()->current_shift->getDurationInMinutes() }} min
                            @else
                                Not started
                            @endif
                        </dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
    <!-- Quick Actions -->
    <div class="bg-white shadow rounded-lg">
        <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
            <h3 class="text-lg leading-6 font-medium text-gray-900">
                Quick Actions
            </h3>
            <p class="mt-1 text-sm text-gray-500">
                Fast access to common tasks
            </p>
        </div>
        <div class="px-4 py-5 sm:p-6">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <a href="{{ route('kiosk.scan') }}" 
                   class="flex items-center p-4 border border-gray-300 rounded-lg hover:bg-gray-50 transition">
                    <div class="flex-shrink-0">
                        <i class="fas fa-qrcode text-2xl text-blue-600"></i>
                    </div>
                    <div class="ml-4">
                        <h4 class="text-lg font-medium text-gray-900">Scan Key QR</h4>
                        <p class="text-sm text-gray-500">Process checkout or checkin</p>
                    </div>
                </a>

                <a href="{{ route('keys.index') }}?status=available" 
                   class="flex items-center p-4 border border-gray-300 rounded-lg hover:bg-gray-50 transition">
                    <div class="flex-shrink-0">
                        <i class="fas fa-arrow-right text-2xl text-green-600"></i>
                    </div>
                    <div class="ml-4">
                        <h4 class="text-lg font-medium text-gray-900">Check Out Key</h4>
                        <p class="text-sm text-gray-500">Browse available keys</p>
                    </div>
                </a>

                <a href="{{ route('keys.index') }}?status=checked_out" 
                   class="flex items-center p-4 border border-gray-300 rounded-lg hover:bg-gray-50 transition">
                    <div class="flex-shrink-0">
                        <i class="fas fa-arrow-left text-2xl text-orange-600"></i>
                    </div>
                    <div class="ml-4">
                        <h4 class="text-lg font-medium text-gray-900">Check In Key</h4>
                        <p class="text-sm text-gray-500">Return checked out keys</p>
                    </div>
                </a>

                <a href="{{ route('reports.current-holders') }}" 
                   class="flex items-center p-4 border border-gray-300 rounded-lg hover:bg-gray-50 transition">
                    <div class="flex-shrink-0">
                        <i class="fas fa-list text-2xl text-purple-600"></i>
                    </div>
                    <div class="ml-4">
                        <h4 class="text-lg font-medium text-gray-900">Current Holders</h4>
                        <p class="text-sm text-gray-500">View all checked out keys</p>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="bg-white shadow rounded-lg">
        <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
            <h3 class="text-lg leading-6 font-medium text-gray-900">
                Your Recent Activity
            </h3>
            <p class="mt-1 text-sm text-gray-500">
                Transactions processed in your current shift
            </p>
        </div>
        <div class="px-4 py-5 sm:p-6">
            @php
                $recentActivity = auth()->user()->keyLogsAsReceiver()
                    ->with(['key.location'])
                    ->whereHas('securityShift', function($query) {
                        $query->whereNull('end_at');
                    })
                    ->latest()
                    ->limit(5)
                    ->get();
            @endphp

            @if($recentActivity->count() > 0)
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
                            <div class="min-w-0 flex-1 pt-1.5">
                                <div>
                                    <p class="text-sm text-gray-500">
                                        <span class="font-medium text-gray-900">{{ $activity->key->label }}</span>
                                        was {{ $activity->action === 'checkout' ? 'checked out' : 'checked in' }}
                                        by <span class="font-medium">{{ $activity->holder_name }}</span>
                                    </p>
                                    <p class="text-xs text-gray-400 mt-1">
                                        {{ $activity->created_at->diffForHumans() }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
            @else
            <div class="text-center py-8">
                <i class="fas fa-history text-4xl text-gray-300 mb-4"></i>
                <p class="text-gray-500">No activity in current shift</p>
                <p class="text-sm text-gray-400 mt-1">Start processing key transactions to see activity here</p>
            </div>
            @endif
        </div>
    </div>
</div>

<!-- Shift Information -->
@if(auth()->user()->isOnShift())
<div class="mt-8 bg-green-50 border border-green-200 rounded-lg p-6">
    <div class="flex items-center justify-between">
        <div class="flex items-center">
            <div class="flex-shrink-0">
                <i class="fas fa-clock text-2xl text-green-600"></i>
            </div>
            <div class="ml-4">
                <h3 class="text-lg font-medium text-green-800">Active Shift</h3>
                <p class="text-green-700">
                    Started: {{ auth()->user()->current_shift->start_at->format('M j, Y g:i A') }}
                    ({{ auth()->user()->current_shift->start_at->diffForHumans() }})
                </p>
                <p class="text-sm text-green-600 mt-1">
                    Duration: {{ auth()->user()->current_shift->getDurationInMinutes() }} minutes • 
                    Transactions: {{ $recentActivity->count() }}
                </p>
            </div>
        </div>
        <form action="{{ route('profile.end-shift') }}" method="POST">
            @csrf
            <button type="submit" 
                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700">
                <i class="fas fa-stop mr-2"></i> End Shift
            </button>
        </form>
    </div>
</div>
@else
<div class="mt-8 bg-yellow-50 border border-yellow-200 rounded-lg p-6">
    <div class="flex items-center">
        <div class="flex-shrink-0">
            <i class="fas fa-exclamation-triangle text-2xl text-yellow-600"></i>
        </div>
        <div class="ml-4">
            <h3 class="text-lg font-medium text-yellow-800">Shift Not Started</h3>
            <p class="text-yellow-700">
                You need to start your shift before processing key transactions.
            </p>
            <form action="{{ route('profile.start-shift') }}" method="POST" class="mt-2">
                @csrf
                <button type="submit" 
                        class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700">
                    <i class="fas fa-play mr-2"></i> Start Shift Now
                </button>
            </form>
        </div>
    </div>
</div>
@endif

<!-- Overdue Keys Alert -->
@php
    $overdueKeys = \App\Models\KeyLog::overdue()->count();
@endphp
@if($overdueKeys > 0)
<div class="mt-6 bg-red-50 border border-red-200 rounded-lg p-4">
    <div class="flex">
        <div class="flex-shrink-0">
            <i class="fas fa-exclamation-circle text-red-400"></i>
        </div>
        <div class="ml-3">
            <h3 class="text-sm font-medium text-red-800">
                {{ $overdueKeys }} Overdue Key{{ $overdueKeys > 1 ? 's' : '' }}
            </h3>
            <div class="mt-2 text-sm text-red-700">
                <p>There {{ $overdueKeys > 1 ? 'are' : 'is' }} {{ $overdueKeys }} key{{ $overdueKeys > 1 ? 's' : '' }} past their expected return date.</p>
            </div>
            <div class="mt-2">
                <a href="{{ route('reports.overdue-keys') }}" 
                   class="inline-flex items-center text-sm font-medium text-red-800 hover:text-red-900">
                    View overdue keys
                    <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
        </div>
    </div>
</div>
@endif
@endsection

@push('scripts')
<script>
    // Auto-refresh dashboard every 30 seconds
    setTimeout(function() {
        window.location.reload();
    }, 30000);
</script>
@endpush
'@ | Out-File -FilePath .\resources\views\security\dashboard.blade.php -Encoding UTF8