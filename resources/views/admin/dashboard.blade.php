<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Robotics Catalog</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    @include('admin.partials.nav')

    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6">Admin Dashboard</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @if(auth()->user()->isSuperAdmin())
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-xl font-semibold mb-4">Manage Workshops</h2>
                <p class="text-gray-600 mb-4">Add, edit, or remove workshops and assign administrators.</p>
                <a href="{{ route('admin.workshops.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                    Go to Workshops
                </a>
            </div>
            @endif

            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-xl font-semibold mb-4">Manage Parts</h2>
                <p class="text-gray-600 mb-4">Add, edit, or remove electronic parts and tools.</p>
                <a href="{{ route('admin.parts.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                    Go to Parts
                </a>
            </div>
        </div>
    </div>
</body>
</html>
