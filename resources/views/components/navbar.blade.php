<nav class="bg-blue-600 p-4 text-white">
    <div class="container mx-auto flex justify-between">
        <a href="{{ route('dashboard') }}" class="font-semibold text-lg">Key Management</a>
        <div>
            @auth
                <a href="{{ route('logout') }}" class="ml-4 hover:underline">Logout</a>
            @endauth
        </div>
    </div>
</nav>
