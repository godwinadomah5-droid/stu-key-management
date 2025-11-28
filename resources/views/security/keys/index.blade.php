@extends('layouts.app')

@section('title', 'Key Management')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-6">Key Management</h1>
    
    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-lg font-semibold mb-4">Keys will be listed here</h2>
        <p class="text-gray-600">Key management interface coming soon...</p>
        
        <div class="mt-4">
            <a href="{{ route('security.dashboard') }}" 
               class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                Back to Security Dashboard
            </a>
        </div>
    </div>
</div>
@endsection