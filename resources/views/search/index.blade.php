<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UL1M - Fast Embed Robotics Workshops</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .vertical-text {
            writing-mode: vertical-rl;
            transform: rotate(180deg);
        }
    </style>
</head>
<body class="bg-white">
    <!-- Header -->
    <header class="border-b">
        <div class="container mx-auto px-6 py-4">
            <div class="flex justify-between items-center">
                <div class="flex items-center gap-4">
                    <a href="{{ route('home') }}" class="bg-black text-white px-6 py-3 font-bold text-2xl hover:bg-gray-800 transition">
                        UL1M
                    </a>
                    <h1 class="text-2xl font-semibold">Fast Embed Robotics Workshops</h1>
                </div>
                <div class="flex gap-6 text-lg">
                    <a href="#" class="hover:text-gray-600">About</a>
                    @auth
                        @if(in_array(auth()->user()->role, ['super_admin', 'workshop_admin']))
                        <a href="{{ route('admin.dashboard') }}" class="hover:text-gray-600">Admin Panel</a>
                        @endif
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="hover:text-gray-600">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="hover:text-gray-600">Login</a>
                    @endauth
                </div>
            </div>
        </div>
    </header>

    <div class="container mx-auto px-6 py-8">
        <!-- City Filters -->
        <div class="flex gap-3 mb-8">
            <button onclick="filterCity('all')" class="city-filter px-6 py-2 rounded-full border-2 border-black bg-black text-white font-medium hover:bg-gray-800 transition">
                All Cities
            </button>
            @php
                $cities = \App\Models\City::whereHas('workshops')->orderBy('name')->get();
            @endphp
            @foreach($cities as $city)
            <button onclick="filterCity('{{ strtolower($city->name) }}')" class="city-filter px-6 py-2 rounded-full border-2 border-black hover:bg-black hover:text-white transition font-medium">
                {{ $city->name }}
            </button>
            @endforeach
        </div>

        <!-- Search Bar -->
        <form action="{{ route('home') }}" method="GET" class="mb-12">
            <div class="relative">
                <input
                    type="text"
                    name="search"
                    value="{{ $search }}"
                    placeholder="Find part or tool..."
                    class="w-full max-w-2xl px-6 py-4 border-2 border-gray-300 rounded-full text-lg focus:outline-none focus:border-black"
                >
                <button type="submit" class="absolute right-4 top-1/2 -translate-y-1/2 bg-black text-white px-6 py-2 rounded-full hover:bg-gray-800">
                    Search
                </button>
            </div>
        </form>

        <!-- Products Grouped by Workshop -->
        @if($groupedParts->count() > 0)
            @foreach($groupedParts as $workshopId => $parts)
                @php
                    $workshop = $parts->first()->workshop;
                @endphp
                <div class="mb-16 flex gap-0" data-city="{{ strtolower($workshop->city->name ?? '') }}">
                    <!-- Vertical Workshop Label -->
                    <div class="flex-shrink-0 border-r-2 border-black pr-4 mr-8">
                        <div class="vertical-text text-2xl font-bold whitespace-nowrap">
                            {{ $workshop->city->name ?? 'N/A' }}, {{ $workshop->name }}
                        </div>
                    </div>

                    <!-- Products Grid for this Workshop -->
                    <div class="flex-1">
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                            @foreach($parts as $part)
                            <div class="group">
                                <a href="{{ route('parts.show', $part) }}" class="block cursor-pointer">
                                    <!-- Product Image -->
                                    <div class="aspect-square bg-gray-100 rounded-lg mb-4 flex items-center justify-center overflow-hidden hover:shadow-lg transition relative">
                                        @if($part->image)
                                            <img src="{{ asset($part->image) }}"
                                                 alt="{{ $part->name }}"
                                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                        @else
                                            <img src="https://via.placeholder.com/400x400/e5e7eb/6b7280?text={{ urlencode($part->name) }}"
                                                 alt="{{ $part->name }}"
                                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                        @endif

                                        @auth
                                            @if(auth()->user()->canManageWorkshop($part->workshop_id))
                                            <div class="absolute top-2 right-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                                <span class="bg-black text-white text-xs px-2 py-1 rounded">Edit</span>
                                            </div>
                                            @endif
                                        @endauth
                                    </div>

                                    <!-- Product Info -->
                                    <h3 class="font-semibold text-lg mb-2 line-clamp-2">{{ $part->name }}</h3>

                                    <div class="flex items-center justify-between">
                                        <span class="text-gray-600">{{ $part->quantity }} pcs</span>
                                    </div>

                                    <!-- Additional Info -->
                                    <div class="mt-2 text-sm text-gray-500">
                                        <div>{{ $part->category }}</div>
                                        @if($part->manufacturer)
                                        <div>{{ $part->manufacturer }}</div>
                                        @endif
                                    </div>
                                </a>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="text-center py-20">
                <p class="text-gray-500 text-xl">
                    @if($search)
                        No parts found matching "{{ $search }}". Try a different search term.
                    @else
                        No parts available yet. Check back later!
                    @endif
                </p>
            </div>
        @endif
    </div>

    <script>
        function filterCity(city) {
            const workshopGroups = document.querySelectorAll('[data-city]');
            const buttons = document.querySelectorAll('.city-filter');

            // Update button states
            buttons.forEach(btn => {
                btn.classList.remove('bg-black', 'text-white');
                btn.classList.add('bg-white', 'text-black');
            });
            event.target.classList.remove('bg-white', 'text-black');
            event.target.classList.add('bg-black', 'text-white');

            // Filter workshop groups
            workshopGroups.forEach(group => {
                if (city === 'all' || group.dataset.city === city) {
                    group.style.display = 'flex';
                } else {
                    group.style.display = 'none';
                }
            });
        }
    </script>
</body>
</html>
