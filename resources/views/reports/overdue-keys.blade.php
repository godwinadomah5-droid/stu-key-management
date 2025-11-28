@extends('layouts.app')

@section('title', 'Overdue Keys')

@section('subtitle', 'Keys past their expected return date')

@section('actions')
<a href="{{ route('reports.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
    <i class="fas fa-arrow-left mr-2"></i> Back to Reports
</a>
@endsection

@section('content')
<div class="bg-white shadow rounded-lg">
    <!-- Results -->
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
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
                        Checked Out
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Expected Return
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Overdue By
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($overdueKeys as $log)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 h-10 w-10 bg-red-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-key text-red-600"></i>
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900">{{ $log->key->label }}</div>
                                <div class="text-sm text-gray-500">{{ $log->key->code }}</div>
                            </div>
                        </div>
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
                        {{ $log->created_at->format('M j, Y g:i A') }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">{{ $log->expected_return_at->format('M j, Y g:i A') }}</div>
                        <div class="text-sm text-red-600 font-medium">
                            {{ $log->expected_return_at->diffForHumans() }}
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-red-600 font-medium">
                        {{ $log->expected_return_at->diffInHours(now()) }} hours
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <div class="flex space-x-2">
                            <a href="tel:{{ $log->holder_phone }}" 
                               class="text-blue-600 hover:text-blue-900"
                               title="Call Holder">
                                <i class="fas fa-phone"></i>
                            </a>
                            @can('access kiosk')
                            <a href="{{ route('kiosk.checkin', $log->key) }}" 
                               class="text-green-600 hover:text-green-900"
                               title="Check In Key">
                                <i class="fas fa-arrow-left"></i>
                            </a>
                            @endcan
                            @can('manage keys')
                            <form action="{{ route('keys.mark-lost', $log->key) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" 
                                        class="text-red-600 hover:text-red-900"
                                        title="Mark as Lost"
                                        onclick="return confirm('Are you sure you want to mark this key as lost?')">
                                    <i class="fas fa-exclamation-triangle"></i>
                                </button>
                            </form>
                            @endcan
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-6 py-4 text-center text-sm text-gray-500">
                        <i class="fas fa-check-circle text-3xl text-green-300 mb-2 block"></i>
                        No overdue keys found. Great job!
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if($overdueKeys->hasPages())
    <div class="px-4 py-4 border-t border-gray-200 sm:px-6">
        {{ $overdueKeys->links() }}
    </div>
    @endif
</div>

<!-- Urgent Actions -->
@if($overdueKeys->count() > 0)
<div class="mt-6 bg-red-50 border border-red-200 rounded-lg p-6">
    <div class="flex">
        <div class="flex-shrink-0">
            <i class="fas fa-exclamation-triangle text-red-400 text-xl"></i>
        </div>
        <div class="ml-3">
            <h3 class="text-sm font-medium text-red-800">Urgent Action Required</h3>
            <div class="mt-2 text-sm text-red-700">
                <p>There are {{ $overdueKeys->count() }} keys that are past their expected return date.</p>
                <ul class="list-disc list-inside mt-1 space-y-1">
                    <li>Contact key holders to remind them to return the keys</li>
                    <li>Consider marking keys as lost if they are significantly overdue</li>
                    <li>Update security protocols if necessary</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endif
@endsection
