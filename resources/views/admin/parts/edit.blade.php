<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Part - Robotics Catalog</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    @include('admin.partials.nav')

    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6">Edit Part/Component</h1>

        <div class="bg-white rounded-lg shadow p-6 max-w-2xl">
            <form action="{{ route('admin.parts.update', $part) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">Name *</label>
                    <input type="text" name="name" value="{{ old('name', $part->name) }}"
                           class="w-full border rounded px-3 py-2 @error('name') border-red-500 @enderror" required>
                    @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">Description</label>
                    <textarea name="description" rows="3"
                              class="w-full border rounded px-3 py-2 @error('description') border-red-500 @enderror">{{ old('description', $part->description) }}</textarea>
                    @error('description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Category *</label>
                        <select name="category" class="w-full border rounded px-3 py-2 @error('category') border-red-500 @enderror" required>
                            <option value="">Select category</option>
                            <option value="Microcontroller" {{ old('category', $part->category) == 'Microcontroller' ? 'selected' : '' }}>Microcontroller</option>
                            <option value="Sensor" {{ old('category', $part->category) == 'Sensor' ? 'selected' : '' }}>Sensor</option>
                            <option value="Motor" {{ old('category', $part->category) == 'Motor' ? 'selected' : '' }}>Motor</option>
                            <option value="Display" {{ old('category', $part->category) == 'Display' ? 'selected' : '' }}>Display</option>
                            <option value="Power Supply" {{ old('category', $part->category) == 'Power Supply' ? 'selected' : '' }}>Power Supply</option>
                            <option value="Tool" {{ old('category', $part->category) == 'Tool' ? 'selected' : '' }}>Tool</option>
                            <option value="Cable/Connector" {{ old('category', $part->category) == 'Cable/Connector' ? 'selected' : '' }}>Cable/Connector</option>
                            <option value="Other" {{ old('category', $part->category) == 'Other' ? 'selected' : '' }}>Other</option>
                        </select>
                        @error('category')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Manufacturer</label>
                        <input type="text" name="manufacturer" value="{{ old('manufacturer', $part->manufacturer) }}"
                               class="w-full border rounded px-3 py-2">
                    </div>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">Part Number</label>
                    <input type="text" name="part_number" value="{{ old('part_number', $part->part_number) }}"
                           class="w-full border rounded px-3 py-2">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">Product Image</label>

                    @if($part->image)
                    <div class="mb-3 flex items-start gap-4">
                        <img src="{{ asset($part->image) }}" alt="{{ $part->name }}" class="w-32 h-32 object-cover rounded border">
                        <div>
                            <p class="text-sm text-gray-600 mb-2">Current image</p>
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="checkbox" name="delete_image" value="1" class="rounded">
                                <span class="text-sm text-red-600">Delete current image</span>
                            </label>
                        </div>
                    </div>
                    @endif

                    <input type="file" name="image" accept="image/*"
                           class="w-full border rounded px-3 py-2 @error('image') border-red-500 @enderror">
                    @error('image')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                    <p class="text-gray-500 text-sm mt-1">Upload a new image to replace the current one. Max size: 2MB.</p>
                </div>

                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Quantity *</label>
                        <input type="number" name="quantity" value="{{ old('quantity', $part->quantity) }}" min="0"
                               class="w-full border rounded px-3 py-2 @error('quantity') border-red-500 @enderror" required>
                        @error('quantity')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Price</label>
                        <input type="number" name="price" value="{{ old('price', $part->price) }}" step="0.01" min="0"
                               class="w-full border rounded px-3 py-2">
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4 mb-6">
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Price</label>
                        <input type="number" name="price" value="{{ old('price', $part->price) }}" step="0.01" min="0"
                               class="w-full border rounded px-3 py-2">
                    </div>

                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Workshop *</label>
                        <select name="workshop_id" class="w-full border rounded px-3 py-2 @error('workshop_id') border-red-500 @enderror" required>
                            <option value="">Select workshop</option>
                            @foreach($workshops as $workshop)
                            <option value="{{ $workshop->id }}" {{ old('workshop_id', $part->workshop_id) == $workshop->id ? 'selected' : '' }}>
                                {{ $workshop->name }} - {{ $workshop->city }}
                            </option>
                            @endforeach
                        </select>
                        @error('workshop_id')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex space-x-3">
                    <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600">
                        Update Part
                    </button>
                    <a href="{{ route('admin.parts.index') }}" class="bg-gray-300 text-gray-700 px-6 py-2 rounded hover:bg-gray-400">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
