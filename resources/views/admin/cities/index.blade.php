<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cities - Robotics Catalog</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    @include('admin.partials.nav')

    <div class="container mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold">Cities</h1>
            <a href="{{ route('admin.cities.create') }}" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                Add City
            </a>
        </div>

        @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
        @endif

        @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            {{ session('error') }}
        </div>
        @endif

        <div class="bg-white rounded-lg shadow overflow-hidden">
            <table class="min-w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">City Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Country</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Workshops</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($cities as $city)
                    <tr>
                        <td class="px-6 py-4 font-medium">{{ $city->name }}</td>
                        <td class="px-6 py-4">{{ $city->country }}</td>
                        <td class="px-6 py-4">{{ $city->workshops_count }}</td>
                        <td class="px-6 py-4">
                            <a href="{{ route('admin.cities.edit', $city) }}" class="text-blue-600 hover:text-blue-800 mr-3">Edit</a>
                            <form action="{{ route('admin.cities.destroy', $city) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800" onclick="return confirm('Are you sure? This city cannot be deleted if it has workshops.')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $cities->links() }}
        </div>
    </div>
</body>
</html>
