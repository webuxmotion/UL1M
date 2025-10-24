<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parts - Robotics Catalog</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    @include('admin.partials.nav')

    <div class="container mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold">Parts & Components</h1>
            <a href="{{ route('admin.parts.create') }}" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                Add Part
            </a>
        </div>

        @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
        @endif

        <div class="bg-white rounded-lg shadow overflow-x-auto">
            <table class="min-w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Description</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Category</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Manufacturer</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Part Number</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Quantity</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Price</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Workshop</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($parts as $part)
                    <tr>
                        <td class="px-6 py-4">{{ $part->name }}</td>
                        <td class="px-6 py-4">{{ Str::limit($part->description ?? 'N/A', 50) }}</td>
                        <td class="px-6 py-4">{{ $part->category }}</td>
                        <td class="px-6 py-4">{{ $part->manufacturer ?? 'N/A' }}</td>
                        <td class="px-6 py-4">{{ $part->part_number ?? 'N/A' }}</td>
                        <td class="px-6 py-4">{{ $part->quantity }}</td>
                        <td class="px-6 py-4">{{ $part->price ? '$' . number_format($part->price, 2) : 'N/A' }}</td>
                        <td class="px-6 py-4">{{ $part->workshop->name }}</td>
                        <td class="px-6 py-4">
                            <a href="{{ route('admin.parts.edit', $part) }}" class="text-blue-600 hover:text-blue-800 mr-3">Edit</a>
                            <form action="{{ route('admin.parts.destroy', $part) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $parts->links() }}
        </div>
    </div>
</body>
</html>
