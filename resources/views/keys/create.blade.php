@extends('layouts.app')

@section('title', 'Add New Key')

@section('subtitle', 'Register a new key in the system')

@section('actions')
<a href="{{ route('keys.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
    <i class="fas fa-arrow-left mr-2"></i> Back to Keys
</a>
@endsection

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="bg-white shadow rounded-lg">
        <div class="px-4 py-5 sm:p-6">
            <form action="{{ route('keys.store') }}" method="POST">
                @csrf
                
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
                                       placeholder="e.g., ADM001"
                                       value="{{ old('code') }}">
                                @error('code')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Key Label -->
                            <div>
                                <label for="label" class="block text-sm font-medium text-gray-700">Key Label *</label>
                                <input type="text" name="label" id="label" required
                                       class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                       placeholder="e.g., Main Office Key"
                                       value="{{ old('label') }}">
                                @error('label')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="mt-4">
                            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                            <textarea name="description" id="description" rows="3"
                                      class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                      placeholder="Optional description of the key...">{{ old('description') }}</textarea>
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
                                    <option value="">Select Key Type</option>
                                    <option value="physical" {{ old('key_type') == 'physical' ? 'selected' : '' }}>Physical Key</option>
                                    <option value="electronic" {{ old('key_type') == 'electronic' ? 'selected' : '' }}>Electronic Key</option>
                                    <option value="master" {{ old('key_type') == 'master' ? 'selected' : '' }}>Master Key</option>
                                    <option value="duplicate" {{ old('key_type') == 'duplicate' ? 'selected' : '' }}>Duplicate Key</option>
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
                                    <option value="">Select Location</option>
                                    @foreach($locations as $location)
                                    <option value="{{ $location->id }}" {{ old('location_id') == $location->id ? 'selected' : '' }}>
                                        {{ $location->name }} ({{ $location->campus }})
                                    </option>
                                    @endforeach
                                </select>
                                @error('location_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- QR Code Generation -->
                    <div>
                        <h3 class="text-lg font-medium text-gray-900 mb-4">QR Code Setup</h3>
                        
                        <div class="space-y-4">
                            <div class="flex items-center">
                                <input type="checkbox" name="generate_qr" id="generate_qr" value="1" 
                                       class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                                       {{ old('generate_qr') ? 'checked' : 'checked' }}>
                                <label for="generate_qr" class="ml-2 block text-sm text-gray-900">
                                    Generate QR code tag for this key
                                </label>
                            </div>

                            <div id="qr-options" class="ml-6 space-y-2">
                                <div>
                                    <label for="qr_count" class="block text-sm font-medium text-gray-700">Number of QR Tags</label>
                                    <select name="qr_count" id="qr_count"
                                            class="mt-1 block w-full max-w-xs border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                        <option value="1">1 Tag</option>
                                        <option value="2">2 Tags</option>
                                        <option value="3">3 Tags</option>
                                        <option value="5">5 Tags</option>
                                    </select>
                                </div>
                                <p class="text-sm text-gray-500">
                                    QR codes will be generated immediately and can be printed later.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Buttons -->
                    <div class="flex justify-end space-x-3 pt-6 border-t border-gray-200">
                        <a href="{{ route('keys.index') }}" 
                           class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                            Cancel
                        </a>
                        <button type="submit" 
                                class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <i class="fas fa-save mr-2"></i> Create Key
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const generateQrCheckbox = document.getElementById('generate_qr');
    const qrOptions = document.getElementById('qr-options');
    
    function toggleQrOptions() {
        if (generateQrCheckbox.checked) {
            qrOptions.style.display = 'block';
        } else {
            qrOptions.style.display = 'none';
        }
    }
    
    generateQrCheckbox.addEventListener('change', toggleQrOptions);
    toggleQrOptions(); // Initial state
});
</script>
@endpush
