@extends('layouts.app')

@section('title', $location->name)

@section('subtitle', 'Location details and key inventory')

@section('actions')
<a href="{{ route('locations.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
    <i class="fas fa-arrow-left mr-2"></i> Back to Locations
</a>
@can('manage locations')
<a href="{{ route('locations.edit', $location) }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
    <i class="fas fa-edit mr-2"></i> Edit Location
</a>
@endcan
@endsection

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Location Information -->
    <div class="lg:col-span-2">
        <div class="bg-white shadow rounded-lg">
            <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                <h3 class="text-lg leading-6 font-medium text-gray-900">
                    Location Information
                </h3>
            </div>
            <div class="px-4 py-5 sm:p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Location Name</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $location->name }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Campus</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $location->campus }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Building</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $location->building }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Room</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $location->room ?? 'N/A' }}</p>
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700">Full Address</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $location->full_address }}</p>
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700">Description</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $location->description ?? 'No description provided' }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Status</label>
                        <span class="mt-1 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                            {{ $location->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $location->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Created</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $location->created_at->format('M j, Y g:i A') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Keys at this Location -->
        <div class="mt-8 bg-white shadow rounded-lg">
            <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                <h3 class="text-lg leading-6 font-medium text-gray-900">
                    Keys at this Location
                </h3>
                <p class="mt-1 text-sm text-gray-500">
                    {{ $keys->total() }} keys assigned to this location
                </p>
            </div>
            <div class="px-4 py-5 sm:p-6">
                @if($keys->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Key
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Current Holder
                                </th>
                                <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($keys as $key)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ $key->label }}</div>
                                    <div class="text-sm text-gray-500">{{ $key->code }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @php
                                        $statusClasses = [
                                            'available' => 'bg-green-100 text-green-800',
                                            'checked_out' => 'bg-orange-100 text-orange-800', 
                                            'lost' => 'bg-red-100 text-red-800',
                                            'maintenance' => 'bg-yellow-100 text-yellow-800'
                                        ];
                                        $statusClass = $statusClasses[$key->status] ?? 'bg-gray-100 text-gray-800';
                                    @endphp
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $statusClass }}">
                                        {{ ucfirst(str_replace('_', ' ', $key->status)) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($key->current_holder)
                                    <div class="text-sm text-gray-900">{{ $key->current_holder->holder_name }}</div>
                                    <div class="text-sm text-gray-500">{{ $key->current_holder->holder_phone }}</div>
                                    @else
                                    <span class="text-sm text-gray-500">-</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a href="{{ route('keys.show', $key) }}" 
                                       class="text-blue-600 hover:text-blue-900">
                                        View
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($keys->hasPages())
                <div class="mt-4 px-4 py-4 border-t border-gray-200 sm:px-6">
                    {{ $keys->links() }}
                </div>
                @endif

                @else
                <div class="text-center py-8">
                    <i class="fas fa-key text-4xl text-gray-300 mb-4"></i>
                    <p class="text-gray-500">No keys assigned to this location yet.</p>
                    @can('manage keys')
                    <a href="{{ route('keys.create') }}" class="mt-4 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                        <i class="fas fa-plus mr-2"></i> Add Key
                    </a>
                    @endcan
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Sidebar Stats -->
    <div class="space-y-6">
        <!-- Key Statistics -->
        <div class="bg-white shadow rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Key Statistics</h3>
                <div class="space-y-3">
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-500">Total Keys</span>
                        <span class="text-sm font-medium text-gray-900">{{ $location->keys()->count() }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-500">Available</span>
                        <span class="text-sm font-medium text-green-600">{{ $location->getAvailableKeysCount() }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-500">Checked Out</span>
                        <span class="text-sm font-medium text-orange-600">{{ $location->getCheckedOutKeysCount() }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-500">Other Status</span>
                        <span class="text-sm font-medium text-gray-900">
                            {{ $location->keys()->whereNotIn('status', ['available', 'checked_out'])->count() }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-white shadow rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Quick Actions</h3>
                <div class="space-y-2">
                    @can('manage keys')
                    <a href="{{ route('keys.create') }}?location_id={{ $location->id }}" 
                       class="w-full inline-flex justify-center items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                        <i class="fas fa-plus mr-2"></i> Add Key Here
                    </a>
                    @endcan
                    @can('access kiosk')
                    <a href="{{ route('kiosk.scan') }}" 
                       class="w-full inline-flex justify-center items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                        <i class="fas fa-qrcode mr-2"></i> Scan Key
                    </a>
                    @endcan
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
