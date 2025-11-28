@extends('layouts.app')

@section('title', $key->label)

@section('subtitle', 'Key details and history')

@section('actions')
<div class="flex space-x-2">
    @can('access kiosk')
        @if($key->isAvailable())
        <a href="{{ route('kiosk.checkout', $key) }}" 
           class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700">
            <i class="fas fa-arrow-right mr-2"></i> Check Out
        </a>
        @elseif($key->isCheckedOut())
        <a href="{{ route('kiosk.checkin', $key) }}" 
           class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
            <i class="fas fa-arrow-left mr-2"></i> Check In
        </a>
        @endif
    @endcan
    
    @can('manage keys')
    <a href="{{ route('keys.edit', $key) }}" 
       class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
        <i class="fas fa-edit mr-2"></i> Edit
    </a>
    
    <a href="{{ route('keys.print-tags', $key) }}" 
       class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
        <i class="fas fa-print mr-2"></i> Print QR
    </a>
    @endcan
    
    <a href="{{ route('keys.index') }}" 
       class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
        <i class="fas fa-arrow-left mr-2"></i> Back
    </a>
</div>
@endsection

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Key Information -->
    <div class="lg:col-span-2 space-y-6">
        <!-- Key Details Card -->
        <div class="bg-white shadow rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Key Information</h3>
                        
                        <dl class="space-y-3">
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Key Code</dt>
                                <dd class="text-sm text-gray-900">{{ $key->code }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Label</dt>
                                <dd class="text-sm text-gray-900">{{ $key->label }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Type</dt>
                                <dd class="text-sm text-gray-900 capitalize">{{ $key->key_type }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Status</dt>
                                <dd>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                        {{ $key->status === 'available' ? 'bg-green-100 text-green-800' : 
                                           $key->status === 'checked_out' ? 'bg-orange-100 text-orange-800' : 
                                           $key->status === 'lost' ? 'bg-red-100 text-red-800' : 
                                           'bg-yellow-100 text-yellow-800' }}">
                                        {{ ucfirst(str_replace('_', ' ', $key->status)) }}
                                    </span>
                                </dd>
                            </div>
                        </dl>
                    </div>
                    
                    <div>
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Location</h3>
                        
                        <dl class="space-y-3">
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Location</dt>
                                <dd class="text-sm text-gray-900">{{ $key->location->name }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Campus</dt>
                                <dd class="text-sm text-gray-900">{{ $key->location->campus }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Building</dt>
                                <dd class="text-sm text-gray-900">{{ $key->location->building }}</dd>
                            </div>
                            @if($key->location->room)
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Room</dt>
                                <dd class="text-sm text-gray-900">{{ $key->location->room }}</dd>
                            </div>
                            @endif
                        </dl>
                    </div>
                </div>
                
                @if($key->description)
                <div class="mt-6 pt-6 border-t border-gray-200">
                    <h4 class="text-sm font-medium text-gray-500">Description</h4>
                    <p class="mt-1 text-sm text-gray-900">{{ $key->description }}</p>
                </div>
                @endif
            </div>
        </div>

        <!-- Current Status -->
        @if($currentLog)
        <div class="bg-white shadow rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Current Status</h3>
                
                <div class="bg-{{ $currentLog->isOverdue() ? 'red' : 'blue' }}-50 border border-{{ $currentLog->isOverdue() ? 'red' : 'blue' }}-200 rounded-md p-4">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-{{ $currentLog->isOverdue() ? 'exclamation-triangle' : 'user-check' }} text-{{ $currentLog->isOverdue() ? 'red' : 'blue' }}-400"></i>
                        </div>
                        <div class="ml-3 flex-1">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h4 class="text-sm font-medium text-{{ $currentLog->isOverdue() ? 'red' : 'blue' }}-800">
                                        Currently checked out to {{ $currentLog->holder_name }}
                                    </h4>
                                    <div class="mt-1 text-sm text-{{ $currentLog->isOverdue() ? 'red' : 'blue' }}-700">
                                        <p>Phone: {{ $currentLog->holder_phone }}</p>
                                        <p>Checked out: {{ $currentLog->created_at->format('M j, Y g:i A') }}</p>
                                        <p>Processed by: {{ $currentLog->receiver_name }}</p>
                                        @if($currentLog->expected_return_at)
                                        <p>Expected return: {{ $currentLog->expected_return_at->format('M j, Y g:i A') }}</p>
                                        @endif
                                        @if($currentLog->isOverdue())
                                        <p class="font-bold">OVERDUE: {{ $currentLog->getDurationInMinutes() }} minutes overdue</p>
                                        @endif
                                    </div>
                                </div>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                    {{ $currentLog->verified ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $currentLog->verified ? 'Verified' : 'Discrepancy' }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- QR Tags -->
        @if($key->keyTags->count() > 0)
        <div class="bg-white shadow rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">QR Tags</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach($key->keyTags as $tag)
                    <div class="border border-gray-200 rounded-md p-4">
                        <div class="flex justify-between items-start">
                            <div>
                                <h4 class="text-sm font-medium text-gray-900">QR Tag</h4>
                                <p class="text-sm text-gray-500">{{ $tag->uuid }}</p>
                                <p class="text-xs text-gray-400 mt-1">
                                    @if($tag->printed_at)
                                    Printed: {{ $tag->printed_at->format('M j, Y') }}
                                    @else
                                    Not printed
                                    @endif
                                </p>
                            </div>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                {{ $tag->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $tag->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </div>
                    </div>
                    @endforeach
                </div>
                
                @can('manage keys')
                <div class="mt-4 pt-4 border-t border-gray-200">
                    <form action="{{ route('keys.generate-tags', $key) }}" method="POST" class="flex items-center space-x-2">
                        @csrf
                        <select name="count" class="border border-gray-300 rounded-md px-3 py-2 text-sm">
                            <option value="1">1 Tag</option>
                            <option value="2">2 Tags</option>
                            <option value="3">3 Tags</option>
                        </select>
                        <button type="submit" 
                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                            Generate More Tags
                        </button>
                    </form>
                </div>
                @endcan
            </div>
        </div>
        @endif
    </div>

    <!-- Sidebar -->
    <div class="space-y-6">
        <!-- Quick Actions -->
        <div class="bg-white shadow rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Quick Actions</h3>
                
                <div class="space-y-2">
                    @can('access kiosk')
                        @if($key->isAvailable())
                        <a href="{{ route('kiosk.checkout', $key) }}" 
                           class="w-full inline-flex justify-center items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700">
                            <i class="fas fa-arrow-right mr-2"></i> Check Out Key
                        </a>
                        @elseif($key->isCheckedOut())
                        <a href="{{ route('kiosk.checkin', $key) }}" 
                           class="w-full inline-flex justify-center items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                            <i class="fas fa-arrow-left mr-2"></i> Check In Key
                        </a>
                        @endif
                    @endcan
                    
                    @can('manage keys')
                    <a href="{{ route('keys.print-tags', $key) }}" 
                       class="w-full inline-flex justify-center items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                        <i class="fas fa-print mr-2"></i> Print QR Tags
                    </a>
                    
                    @if($key->isCheckedOut())
                    <form action="{{ route('keys.mark-lost', $key) }}" method="POST">
                        @csrf
                        <button type="submit" 
                                class="w-full inline-flex justify-center items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700"
                                onclick="return confirm('Are you sure you want to mark this key as lost? This action cannot be undone.')">
                            <i class="fas fa-exclamation-triangle mr-2"></i> Mark as Lost
                        </button>
                    </form>
                    @endif
                    @endcan
                </div>
            </div>
        </div>

        <!-- Key Statistics -->
        <div class="bg-white shadow rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Statistics</h3>
                
                <div class="space-y-3">
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-500">Total Checkouts</span>
                        <span class="text-sm font-medium text-gray-900">
                            {{ $key->keyLogs()->where('action', 'checkout')->count() }}
                        </span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-500">Last Checkout</span>
                        <span class="text-sm font-medium text-gray-900">
                            @if($key->lastLog)
                                {{ $key->lastLog->created_at->diffForHumans() }}
                            @else
                                Never
                            @endif
                        </span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-500">Created</span>
                        <span class="text-sm font-medium text-gray-900">
                            {{ $key->created_at->diffForHumans() }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Activity History -->
<div class="mt-8 bg-white shadow rounded-lg">
    <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
        <h3 class="text-lg leading-6 font-medium text-gray-900">
            Activity History
        </h3>
        <p class="mt-1 text-sm text-gray-500">
            Recent key checkouts and checkins
        </p>
    </div>
    <div class="px-4 py-5 sm:p-6">
        @if($history->count() > 0)
        <div class="flow-root">
            <ul class="-mb-8">
                @foreach($history as $log)
                <li class="relative pb-8">
                    <div class="relative flex space-x-3">
                        <div>
                            <span class="h-8 w-8 rounded-full flex items-center justify-center ring-8 ring-white 
                                {{ $log->action === 'checkout' ? 'bg-green-500' : 'bg-blue-500' }}">
                                <i class="fas fa-{{ $log->action === 'checkout' ? 'arrow-right' : 'arrow-left' }} text-white text-sm"></i>
                            </span>
                        </div>
                        <div class="min-w-0 flex-1 pt-1.5">
                            <div>
                                <p class="text-sm text-gray-500">
                                    Key was {{ $log->action === 'checkout' ? 'checked out' : 'checked in' }}
                                    by <span class="font-medium text-gray-900">{{ $log->holder_name }}</span>
                                </p>
                                <p class="text-xs text-gray-400 mt-1">
                                    {{ $log->created_at->format('M j, Y g:i A') }} • 
                                    Processed by {{ $log->receiver_name }}
                                </p>
                                @if($log->action === 'checkout' && $log->expected_return_at)
                                <p class="text-xs text-gray-400">
                                    Expected return: {{ $log->expected_return_at->format('M j, Y g:i A') }}
                                </p>
                                @endif
                                @if($log->notes)
                                <p class="text-xs text-gray-500 mt-1">{{ $log->notes }}</p>
                                @endif
                            </div>
                            <div class="mt-2 flex space-x-2">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                    {{ $log->verified ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $log->verified ? 'Verified' : 'Discrepancy' }}
                                </span>
                            </div>
                        </div>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
        
        <!-- Pagination -->
        @if($history->hasPages())
        <div class="mt-4 pt-4 border-t border-gray-200">
            {{ $history->links() }}
        </div>
        @endif
        
        @else
        <div class="text-center py-8">
            <i class="fas fa-history text-4xl text-gray-300 mb-4"></i>
            <p class="text-gray-500">No activity history found for this key.</p>
        </div>
        @endif
    </div>
</div>
@endsection
