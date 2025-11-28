@extends('layouts.app')

@section('title', 'Key Activity Report')

@section('subtitle', 'Detailed key checkout and checkin history')

@section('actions')
<a href="{{ route('reports.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
    <i class="fas fa-arrow-left mr-2"></i> Back to Reports
</a>
@endsection

@section('content')
<div class="bg-white shadow rounded-lg">
    <!-- Filters -->
    <div class="px-4 py-5 sm:p-6 border-b border-gray-200">
        <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
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
                <label for="location_id" class="block text-sm font-medium text-gray-700">Location</label>
                <select name="location_id" id="location_id" class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    <option value="">All Locations</option>
                    @foreach($locations as $location)
                    <option value="{{ $location->id }}" {{ ($filters['location_id'] ?? '') == $location->id ? 'selected' : '' }}>
                        {{ $location->name }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="action" class="block text-sm font-medium text-gray-700">Action Type</label>
                <select name="action" id="action" class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    <option value="">All Actions</option>
                    <option value="checkout" {{ ($filters['action'] ?? '') == 'checkout' ? 'selected' : '' }}>Checkout Only</option>
                    <option value="checkin" {{ ($filters['action'] ?? '') == 'checkin' ? 'selected' : '' }}>Checkin Only</option>
                </select>
            </div>
            <div class="flex items-end space-x-2 md:col-span-4">
                <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                    <i class="fas fa-filter mr-2"></i> Apply Filters
                </button>
                <a href="{{ route('reports.key-activity') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                    <i class="fas fa-refresh mr-2"></i> Reset
                </a>
            </div>
        </form>
    </div>

    <!-- Results Summary -->
    @if($logs->count() > 0)
    <div class="px-4 py-4 border-b border-gray-200 bg-gray-50">
        <div class="flex flex-wrap items-center justify-between">
            <div class="text-sm text-gray-600">
                Showing {{ $logs->firstItem() }} to {{ $logs->lastItem() }} of {{ $logs->total() }} results
            </div>
            <div class="text-sm text-gray-600">
                Page {{ $logs->currentPage() }} of {{ $logs->lastPage() }}
            </div>
        </div>
    </div>
    @endif

    <!-- Results Table -->
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Date & Time
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Action
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Key
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Location
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Holder
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Security Officer
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Status
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($logs as $log)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">{{ $log->created_at->format('M j, Y') }}</div>
                        <div class="text-sm text-gray-500">{{ $log->created_at->format('g:i A') }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                            {{ $log->action === 'checkout' ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800' }}">
                            <i class="fas fa-{{ $log->action === 'checkout' ? 'arrow-right' : 'arrow-left' }} mr-1"></i>
                            {{ ucfirst($log->action) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">{{ $log->key->label }}</div>
                        <div class="text-sm text-gray-500">{{ $log->key->code }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">{{ $log->key->location->name }}</div>
                        <div class="text-sm text-gray-500">{{ $log->key->location->campus }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">{{ $log->holder_name }}</div>
                        <div class="text-sm text-gray-500">{{ $log->holder_phone }}</div>
                        <div class="text-xs text-gray-400">{{ $log->holder_type_label }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        {{ $log->receiver_name }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex flex-col space-y-1">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                {{ $log->verified ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                <i class="fas fa-{{ $log->verified ? 'check' : 'times' }} mr-1"></i>
                                {{ $log->verified ? 'Verified' : 'Unverified' }}
                            </span>
                            @if($log->discrepancy)
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                <i class="fas fa-exclamation-triangle mr-1"></i>
                                Discrepancy
                            </span>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-6 py-8 text-center">
                        <div class="flex flex-col items-center">
                            <i class="fas fa-search text-4xl text-gray-300 mb-4"></i>
                            <p class="text-gray-500 text-lg mb-2">No activity found</p>
                            <p class="text-gray-400 text-sm">Try adjusting your filters or search criteria</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination - Use Laravel's built-in pagination -->
    @if($logs->hasPages())
        @include('components.pagination', ['logs' => $logs])
    @endif
</div>

<!-- Export Options -->
@if($logs->count() > 0)
<div class="mt-6 bg-white shadow rounded-lg">
    <div class="px-4 py-5 sm:p-6">
        <h3 class="text-lg font-medium text-gray-900 mb-4">Export Data</h3>
        <form action="{{ route('reports.export-key-activity') }}" method="POST" class="flex flex-col sm:flex-row items-end space-y-4 sm:space-y-0 sm:space-x-4">
            @csrf
            <input type="hidden" name="start_date" value="{{ $filters['start_date'] ?? now()->subDays(30)->format('Y-m-d') }}">
            <input type="hidden" name="end_date" value="{{ $filters['end_date'] ?? now()->format('Y-m-d') }}">
            <input type="hidden" name="location_id" value="{{ $filters['location_id'] ?? '' }}">
            <input type="hidden" name="action" value="{{ $filters['action'] ?? '' }}">
            <div class="flex-1">
                <label for="export_format" class="block text-sm font-medium text-gray-700">Format</label>
                <select name="format" id="export_format" required
                        class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    <option value="csv">CSV</option>
                    <option value="excel">Excel</option>
                    <option value="pdf">PDF</option>
                </select>
            </div>
            <div>
                <button type="submit" 
                        class="w-full sm:w-auto inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                    <i class="fas fa-download mr-2"></i> Export Results
                </button>
            </div>
        </form>
    </div>
</div>
@endif
@endsection
