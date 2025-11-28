@extends('layouts.app')

@section('title', 'Edit Key')

@section('subtitle', 'Update key information')

@section('actions')
<a href="{{ route('keys.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
    <i class="fas fa-arrow-left mr-2"></i> Back to Keys
</a>
@endsection

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="bg-white shadow rounded-lg">
        <div class="px-4 py-5 sm:p-6">
            <form action="{{ route('keys.update', $key) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="space-y-6">
                    <!-- Basic Information -->
                    <div>
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Basic Information</h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Key Code -->
                            <div>
                                <label for="code" class="block text-sm font-medium text-gray-700">Key Code *</label>
                                <input type="text" name="code" id="code" required
                                       class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                       value="{{ old('code', $key->code) }}">
                                @error('code')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Key Label -->
                            <div>
                                <label for="label" class="block text-sm font-medium text-gray-700">Key Label *</label>
                                <input type="text" name="label" id="label" required
                                       class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                       value="{{ old('label', $key->label) }}">
                                @error('label')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="mt-4">
                            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                            <textarea name="description" id="description" rows="3"
                                      class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-blue-500 focus:border-blue-500">{{ old('description', $key->description) }}</textarea>
                        </div>
                    </div>

                    <!-- Key Properties -->
                    <div>
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Key Properties</h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Key Type -->
                            <div>
                                <label for="key_type" class="block text-sm font-medium text-gray-700">Key Type *</label>
                                <select name="key_type" id="key_type" required
                                        class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                    <option value="physical" {{ old('key_type', $key->key_type) == 'physical' ? 'selected' : '' }}>Physical Key</option>
                                    <option value="electronic" {{ old('key_type', $key->key_type) == 'electronic' ? 'selected' : '' }}>Electronic Key</option>
                                    <option value="master" {{ old('key_type', $key->key_type) == 'master' ? 'selected' : '' }}>Master Key</option>
                                    <option value="duplicate" {{ old('key_type', $key->key_type) == 'duplicate' ? 'selected' : '' }}>Duplicate Key</option>
                                </select>
                                @error('key_type')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Location -->
                            <div>
                                <label for="location_id" class="block text-sm font-medium text-gray-700">Location *</label>
                                <select name="location_id" id="location_id" required
                                        class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                    @foreach($locations as $location)
                                    <option value="{{ $location->id }}" {{ old('location_id', $key->location_id) == $location->id ? 'selected' : '' }}>
                                        {{ $location->name }} ({{ $location->campus }})
                                    </option>
                                    @endforeach
                                </select>
                                @error('location_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Status -->
                        <div class="mt-4">
                            <label for="status" class="block text-sm font-medium text-gray-700">Status *</label>
                            <select name="status" id="status" required
                                    class="mt-1 block w-full max-w-xs border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                <option value="available" {{ old('status', $key->status) == 'available' ? 'selected' : '' }}>Available</option>
                                <option value="checked_out" {{ old('status', $key->status) == 'checked_out' ? 'selected' : '' }}>Checked Out</option>
                                <option value="lost" {{ old('status', $key->status) == 'lost' ? 'selected' : '' }}>Lost</option>
                                <option value="maintenance" {{ old('status', $key->status) == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                            </select>
                            @error('status')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Current Status Information -->
                    @if($key->currentHolder)
                    <div class="bg-yellow-50 border border-yellow-200 rounded-md p-4">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <i class="fas fa-exclamation-triangle text-yellow-400"></i>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-yellow-800">Key Currently Checked Out</h3>
                                <div class="mt-2 text-sm text-yellow-700">
                                    <p>This key is currently held by <strong>{{ $key->currentHolder->holder_name }}</strong></p>
                                    <p>Checked out: {{ $key->currentHolder->created_at->format('M j, Y g:i A') }}</p>
                                    @if($key->currentHolder->expected_return_at)
                                    <p>Expected return: {{ $key->currentHolder->expected_return_at->format('M j, Y g:i A') }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Submit Buttons -->
                    <div class="flex justify-end space-x-3 pt-6 border-t border-gray-200">
                        <a href="{{ route('keys.show', $key) }}" 
                           class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                            Cancel
                        </a>
                        <button type="submit" 
                                class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <i class="fas fa-save mr-2"></i> Update Key
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
