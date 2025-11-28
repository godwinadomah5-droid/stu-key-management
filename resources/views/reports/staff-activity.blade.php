@extends('layouts.app')

@section('title', 'Staff Activity Report')

@section('subtitle', 'Key usage by staff members')

@section('actions')
<a href="{{ route('reports.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
    <i class="fas fa-arrow-left mr-2"></i> Back to Reports
</a>
@endsection

@section('content')
<div class="bg-white shadow rounded-lg">
    <!-- Filters -->
    <div class="px-4 py-5 sm:p-6 border-b border-gray-200">
        <form method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label for="start_date" class="block text-sm font-medium text-gray-700">Start Date</label>
                <input type="date" name="start_date" id="start_date" required
                       class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                       value="{{ $filters['start_date'] ?? now()->subDays(30)->format('Y-m-d') }}">
            </div>
            <div>
                <label for="end_date" class="block text-sm font-medium text-gray-700">End Date</label>
                <input type="date" name="end_date" id="end_date" required
                       class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                       value="{{ $filters['end_date'] ?? now()->format('Y-m-d') }}">
            </div>
            <div>
                <label for="staff_type" class="block text-sm font-medium text-gray-700">Staff Type</label>
                <select name="staff_type" id="staff_type" 
                        class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    <option value="">All Types</option>
                    <option value="hr" {{ ($filters['staff_type'] ?? '') == 'hr' ? 'selected' : '' }}>HR Staff</option>
                    <option value="perm_manual" {{ ($filters['staff_type'] ?? '') == 'perm_manual' ? 'selected' : '' }}>Permanent Manual</option>
                    <option value="temp" {{ ($filters['staff_type'] ?? '') == 'temp' ? 'selected' : '' }}>Temporary Staff</option>
                </select>
            </div>
            <div class="flex items-end space-x-2 md:col-span-3">
                <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                    <i class="fas fa-filter mr-2"></i> Apply Filters
                </button>
                <a href="{{ route('reports.staff-activity') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                    <i class="fas fa-refresh mr-2"></i> Reset
                </a>
            </div>
        </form>
    </div>

    <!-- Results Summary -->
    @if($staffActivity->count() > 0)
    <div class="px-4 py-4 border-b border-gray-200 bg-gray-50">
        <div class="flex flex-wrap items-center justify-between">
            <div class="text-sm text-gray-600">
                Showing {{ $staffActivity->firstItem() }} to {{ $staffActivity->lastItem() }} of {{ $staffActivity->total() }} results
            </div>
            <div class="text-sm text-gray-600">
                Page {{ $staffActivity->currentPage() }} of {{ $staffActivity->lastPage() }}
            </div>
        </div>
    </div>
    @endif

    <!-- Staff Activity Table -->
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Staff Member
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Type
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Phone
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Total Checkouts
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Avg Duration
                    </th>
                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($staffActivity as $activity)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">{{ $activity['holder_name'] }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @php
                            $typeClass = match($activity['holder_type']) {
                                'hr' => 'bg-blue-100 text-blue-800',
                                'perm_manual' => 'bg-green-100 text-green-800',
                                default => 'bg-orange-100 text-orange-800'
                            };
                            
                            $typeLabel = match($activity['holder_type']) {
                                'hr' => 'HR Staff',
                                'perm_manual' => 'Permanent Manual',
                                default => 'Temporary Staff'
                            };
                        @endphp
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $typeClass }}">
                            {{ $typeLabel }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $activity['holder_phone'] }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        {{ $activity['total_checkouts'] }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        @if($activity['avg_duration_minutes'])
                            {{ round($activity['avg_duration_minutes']) }} minutes
                        @else
                            N/A
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <a href="{{ route('reports.key-activity') }}?start_date={{ $filters['start_date'] }}&end_date={{ $filters['end_date'] }}&staff_type={{ $activity['holder_type'] }}&staff_id={{ $activity['holder_id'] }}" 
                           class="text-blue-600 hover:text-blue-900">
                            <i class="fas fa-eye mr-1"></i> View Activity
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-8 text-center">
                        <div class="flex flex-col items-center">
                            <i class="fas fa-users text-4xl text-gray-300 mb-4"></i>
                            <p class="text-gray-500 text-lg mb-2">No staff activity found</p>
                            <p class="text-gray-400 text-sm">Try adjusting your filters or date range</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if($staffActivity->hasPages())
    <div class="px-4 py-4 border-t border-gray-200 bg-white">
        <div class="flex flex-col sm:flex-row items-center justify-between">
            <div class="text-sm text-gray-700 mb-4 sm:mb-0">
                Showing {{ $staffActivity->firstItem() }} to {{ $staffActivity->lastItem() }} of {{ $staffActivity->total() }} results
            </div>
            <div class="flex items-center space-x-2">
                {{ $staffActivity->links() }}
            </div>
        </div>
    </div>
    @endif
</div>

<!-- Summary Stats -->
@if($staffActivity->count() > 0)
<div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-6">
    <div class="bg-white overflow-hidden shadow rounded-lg">
        <div class="p-5">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <i class="fas fa-users text-2xl text-blue-600"></i>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500 truncate">Active Staff</dt>
                        <dd class="text-lg font-medium text-gray-900">{{ $staffActivity->total() }}</dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>
    
    <div class="bg-white overflow-hidden shadow rounded-lg">
        <div class="p-5">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <i class="fas fa-key text-2xl text-green-600"></i>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500 truncate">Total Checkouts</dt>
                        <dd class="text-lg font-medium text-gray-900">
                            {{ collect($staffActivity->items())->sum('total_checkouts') }}
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
                    <i class="fas fa-clock text-2xl text-orange-600"></i>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500 truncate">Avg Checkout Duration</dt>
                        <dd class="text-lg font-medium text-gray-900">
                            @php
                                $durations = collect($staffActivity->items())->filter(function($item) {
                                    return !is_null($item['avg_duration_minutes']);
                                })->pluck('avg_duration_minutes');
                                $avgDuration = $durations->isNotEmpty() ? $durations->avg() : null;
                            @endphp
                            {{ $avgDuration ? round($avgDuration) . ' minutes' : 'N/A' }}
                        </dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@endsection
