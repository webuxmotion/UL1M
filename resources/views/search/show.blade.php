<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $part->name }} - UL1M</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .prose {
            color: #374151;
            max-width: 65ch;
        }
        .prose p {
            margin-top: 0.5em;
            margin-bottom: 0.5em;
        }
        .prose strong {
            font-weight: 600;
            color: #111827;
        }
        .prose em {
            font-style: italic;
        }
        .prose ul, .prose ol {
            margin-top: 0.5em;
            margin-bottom: 0.5em;
            padding-left: 1.5em;
        }
        .prose ul {
            list-style-type: disc;
        }
        .prose ol {
            list-style-type: decimal;
        }
        .prose li {
            margin-top: 0.25em;
            margin-bottom: 0.25em;
        }
        .prose a {
            color: #2563eb;
            text-decoration: underline;
        }
        .prose a:hover {
            color: #1d4ed8;
        }
        .prose h1, .prose h2, .prose h3, .prose h4 {
            font-weight: 600;
            margin-top: 1em;
            margin-bottom: 0.5em;
            color: #111827;
        }
        .prose h1 {
            font-size: 1.5em;
        }
        .prose h2 {
            font-size: 1.3em;
        }
        .prose h3 {
            font-size: 1.1em;
        }
        .prose img {
            max-width: 100%;
            height: auto;
            border-radius: 0.5rem;
            margin: 1em 0;
        }
        .prose table {
            width: 100%;
            border-collapse: collapse;
            margin: 1em 0;
        }
        .prose th, .prose td {
            border: 1px solid #e5e7eb;
            padding: 0.5em;
            text-align: left;
        }
        .prose th {
            background-color: #f3f4f6;
            font-weight: 600;
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
                    <a href="{{ route('home') }}" class="hover:text-gray-600">Home</a>
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

    <div class="container mx-auto px-6 py-12">
        <div class="max-w-6xl mx-auto">
            <!-- Back Button -->
            <a href="{{ route('home') }}" class="inline-flex items-center text-gray-600 hover:text-black mb-6">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                Back to Catalog
            </a>

            <div class="grid md:grid-cols-2 gap-12">
                <!-- Product Image -->
                <div>
                    <div class="aspect-square bg-gray-100 rounded-lg overflow-hidden">
                        @if($part->image)
                            <img src="{{ asset($part->image) }}" alt="{{ $part->name }}" class="w-full h-full object-cover">
                        @else
                            <img src="https://via.placeholder.com/600x600/e5e7eb/6b7280?text={{ urlencode($part->name) }}"
                                 alt="{{ $part->name }}" class="w-full h-full object-cover">
                        @endif
                    </div>
                </div>

                <!-- Product Details -->
                <div>
                    <h1 class="text-4xl font-bold mb-4">{{ $part->name }}</h1>

                    @if($part->description)
                    <div class="bg-gray-50 border-l-4 border-blue-500 p-4 mb-6">
                        <div class="text-gray-700 text-lg leading-relaxed prose prose-lg max-w-none">
                            {!! $part->description !!}
                        </div>
                    </div>
                    @endif

                    <div class="space-y-4 mb-8">
                        <div class="flex items-center gap-3">
                            <span class="bg-black text-white px-4 py-2 rounded-full text-sm font-semibold">
                                {{ $part->category }}
                            </span>
                            <span class="text-2xl font-bold text-green-600">{{ $part->quantity }} pcs available</span>
                        </div>

                        @if($part->manufacturer)
                        <div class="border-t pt-4">
                            <p class="text-sm text-gray-500">Manufacturer</p>
                            <p class="text-lg font-semibold">{{ $part->manufacturer }}</p>
                        </div>
                        @endif

                        @if($part->part_number)
                        <div class="border-t pt-4">
                            <p class="text-sm text-gray-500">Part Number</p>
                            <p class="text-lg font-semibold">{{ $part->part_number }}</p>
                        </div>
                        @endif

                        <div class="border-t pt-4">
                            <p class="text-sm text-gray-500">Available at Workshop</p>
                            <p class="text-xl font-bold">{{ $part->workshop->name }}</p>
                            <p class="text-gray-600">{{ $part->workshop->city->name ?? 'N/A' }}</p>
                            <p class="text-gray-600">{{ $part->workshop->address }}</p>
                            <p class="text-gray-600">{{ $part->workshop->phone }}</p>
                        </div>
                    </div>

                    <!-- Admin Actions -->
                    @auth
                        @if(auth()->user()->canManageWorkshop($part->workshop_id))
                        <div class="bg-gray-50 border-2 border-gray-200 rounded-lg p-6">
                            <h3 class="font-bold text-lg mb-4">Admin Actions</h3>
                            <div class="flex gap-3">
                                <a href="{{ route('admin.parts.edit', $part) }}"
                                   class="bg-black text-white px-6 py-3 rounded-full hover:bg-gray-800 transition font-semibold inline-flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                    Edit Part
                                </a>

                                <form action="{{ route('admin.parts.destroy', $part) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this part?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="bg-red-600 text-white px-6 py-3 rounded-full hover:bg-red-700 transition font-semibold inline-flex items-center">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                        Delete Part
                                    </button>
                                </form>
                            </div>
                        </div>
                        @endif
                    @endauth

                    @guest
                    <div class="bg-blue-50 border-2 border-blue-200 rounded-lg p-6">
                        <p class="text-sm text-gray-600">
                            This part is available for free use at our workshop. Visit us to use it in your robotics projects!
                        </p>
                    </div>
                    @endguest
                </div>
            </div>
        </div>
    </div>
</body>
</html>
