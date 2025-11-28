@if(auth()->user()->role === 'security')
<a href="{{ route('security.dashboard') }}" class="block bg-blue-500 hover:bg-blue-600 text-white p-4 rounded-lg text-center transition duration-200">
    <h4 class="font-bold text-lg">Security Dashboard</h4>
    <p class="text-blue-100">Access security features</p>
</a>
@endif

@if(auth()->user()->role === 'hr')
<a href="{{ route('hr.dashboard') }}" class="block bg-purple-500 hover:bg-purple-600 text-white p-4 rounded-lg text-center transition duration-200">
    <h4 class="font-bold text-lg">HR Dashboard</h4>
    <p class="text-purple-100">Access HR features</p>
</a>
@endif