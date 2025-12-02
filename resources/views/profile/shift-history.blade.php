@extends('layouts.app')

@section('title', 'Shift History')

@section('subtitle', 'Your security shift records')

@section('actions')
<a href="{{ route('profile.show') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
    <i class="fas fa-arrow-left mr-2"></i> Back to Profile
</a>
@if(auth()->user()->hasRole('security') && !auth()->user()->isOnShift())
<form action="{{ route('profile.start-shift') }}" method="POST" class="inline">
    @csrf
    <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700">
        <i class="fas fa-play mr-2"></i> Start New Shift
    </button>
</form>
@endif
@endsection

@section('content')
<div class="bg-white shadow rounded-lg">
    <!-- Shifts Table -->
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Shift Date
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Duration
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Transactions
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Status
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($shifts as $shift)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">{{ $shift->start_at->format('M j, Y') }}</div>
                        <div class="text-sm text-gray-500">
                            {{ $shift->start_at->format('g:i A') }}
                            @if($shift->end_at)
                            - {{ $shift->end_at->format('g:i A') }}
                            @endif
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">
                            {{ $shift->getDurationInMinutes() }} minutes
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">
                            {{ $shift->getCheckoutCount() }} transactions
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($shift->end_at)
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                            Completed
                        </span>
                        @else
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            <i class="fas fa-circle animate-pulse mr-1"></i> Active
                        </span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <div class="flex space-x-2">
                            @if(!$shift->end_at)
                            <form action="{{ route('profile.end-shift') }}" method="POST">
                                @csrf
                                <input type="hidden" name="shift_id" value="{{ $shift->id }}">
                                <button type="submit" 
                                        class="text-red-600 hover:text-red-900"
                                        onclick="return confirm('Are you sure you want to end this shift?')">
                                    <i class="fas fa-stop"></i>
                                </button>
                            </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">
                        <i class="fas fa-clock text-3xl text-gray-300 mb-2 block"></i>
                        No shift records found.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if($shifts->hasPages())
    <div class="px-4 py-4 border-t border-gray-200 sm:px-6">
        {{ $shifts->links() }}
    </div>
    @endif
</div>

<!-- Stats -->
<div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-4">
    <div class="bg-white overflow-hidden shadow rounded-lg">
        <div class="p-5">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <i class="fas fa-clock text-2xl text-blue-600"></i>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500 truncate">Total Shifts</dt>
                        <dd class="text-lg font-medium text-gray-900">{{ $shifts->total() }}</dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>
    
    <div class="bg-white overflow-hidden shadow rounded-lg">
        <div class="p-5">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <i class="fas fa-play-circle text-2xl text-green-600"></i>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500 truncate">Active Shifts</dt>
                        <dd class="text-lg font-medium text-gray-900">
                            {{ $shifts->whereNull('end_at')->count() }}
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
                    <i class="fas fa-chart-line text-2xl text-orange-600"></i>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500 truncate">Avg. Duration</dt>
                        <dd class="text-lg font-medium text-gray-900">
                            @php
                                $completedShifts = $shifts->whereNotNull('end_at');
                                $avgDuration = $completedShifts->isNotEmpty() ? 
                                    $completedShifts->avg(fn($shift) => $shift->getDurationInMinutes()) : 0;
                            @endphp
                            {{ round($avgDuration) }} minutes
                        </dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>
</div>

@if(auth()->user()->isOnShift())
<div class="mt-6 bg-green-50 border border-green-200 rounded-lg p-6">
    <div class="flex items-center">
        <div class="flex-shrink-0">
            <i class="fas fa-info-circle text-2xl text-green-600"></i>
        </div>
        <div class="ml-4">
            <h3 class="text-lg font-medium text-green-800">Currently On Shift</h3>
            <p class="text-green-700">
                Your current shift started at {{ auth()->user()->current_shift->start_at->format('g:i A') }}
                ({{ auth()->user()->current_shift->start_at->diffForHumans() }})
            </p>
        </div>
    </div>
</div>
@endif
@endsection
