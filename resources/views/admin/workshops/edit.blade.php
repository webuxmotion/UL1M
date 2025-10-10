<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Workshop - Robotics Catalog</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    @include('admin.partials.nav')

    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6">Edit Workshop</h1>

        <div class="bg-white rounded-lg shadow p-6 max-w-2xl">
            <form action="{{ route('admin.workshops.update', $workshop) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">Name</label>
                    <input type="text" name="name" value="{{ old('name', $workshop->name) }}"
                           class="w-full border rounded px-3 py-2 @error('name') border-red-500 @enderror" required>
                    @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">City</label>
                    <input type="text" name="city" value="{{ old('city', $workshop->city) }}"
                           class="w-full border rounded px-3 py-2 @error('city') border-red-500 @enderror" required>
                    @error('city')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">Address</label>
                    <textarea name="address" rows="3"
                              class="w-full border rounded px-3 py-2 @error('address') border-red-500 @enderror" required>{{ old('address', $workshop->address) }}</textarea>
                    @error('address')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">Phone</label>
                    <input type="text" name="phone" value="{{ old('phone', $workshop->phone) }}"
                           class="w-full border rounded px-3 py-2 @error('phone') border-red-500 @enderror" required>
                    @error('phone')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 font-semibold mb-2">Workshop Admin</label>
                    <select name="admin_id" class="w-full border rounded px-3 py-2">
                        <option value="">None</option>
                        @foreach($admins as $admin)
                        <option value="{{ $admin->id }}" {{ old('admin_id', $workshop->admin_id) == $admin->id ? 'selected' : '' }}>
                            {{ $admin->name }} ({{ $admin->email }})
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="flex space-x-3">
                    <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600">
                        Update Workshop
                    </button>
                    <a href="{{ route('admin.workshops.index') }}" class="bg-gray-300 text-gray-700 px-6 py-2 rounded hover:bg-gray-400">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
