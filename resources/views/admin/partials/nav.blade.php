<nav class="bg-blue-600 text-white shadow-lg">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center py-4">
            <div class="flex space-x-6">
                <a href="{{ route('admin.dashboard') }}" class="font-semibold hover:text-blue-200">Dashboard</a>
                @if(auth()->user()->isSuperAdmin())
                <a href="{{ route('admin.cities.index') }}" class="hover:text-blue-200">Cities</a>
                <a href="{{ route('admin.workshops.index') }}" class="hover:text-blue-200">Workshops</a>
                @endif
                <a href="{{ route('admin.parts.index') }}" class="hover:text-blue-200">Parts</a>
                <a href="{{ route('home') }}" class="hover:text-blue-200">Public Search</a>
            </div>
            <div class="flex items-center space-x-4">
                <span>{{ auth()->user()->name }}</span>
                <span class="text-sm bg-blue-700 px-2 py-1 rounded">
                    {{ ucfirst(str_replace('_', ' ', auth()->user()->role)) }}
                </span>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="hover:text-blue-200">Logout</button>
                </form>
            </div>
        </div>
    </div>
</nav>
