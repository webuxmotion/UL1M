<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Part - Robotics Catalog</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    @include('admin.partials.nav')

    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6">Add Part/Component</h1>

        <div class="bg-white rounded-lg shadow p-6 max-w-2xl">
            <form action="{{ route('admin.parts.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">Name *</label>
                    <input type="text" name="name" value="{{ old('name') }}"
                           class="w-full border rounded px-3 py-2 @error('name') border-red-500 @enderror" required>
                    @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">Description</label>
                    <textarea name="description" rows="3"
                              class="w-full border rounded px-3 py-2 @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
                    @error('description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Category *</label>
                        <select name="category" class="w-full border rounded px-3 py-2 @error('category') border-red-500 @enderror" required>
                            <option value="">Select category</option>
                            <option value="Microcontroller" {{ old('category') == 'Microcontroller' ? 'selected' : '' }}>Microcontroller</option>
                            <option value="Sensor" {{ old('category') == 'Sensor' ? 'selected' : '' }}>Sensor</option>
                            <option value="Motor" {{ old('category') == 'Motor' ? 'selected' : '' }}>Motor</option>
                            <option value="Display" {{ old('category') == 'Display' ? 'selected' : '' }}>Display</option>
                            <option value="Power Supply" {{ old('category') == 'Power Supply' ? 'selected' : '' }}>Power Supply</option>
                            <option value="Tool" {{ old('category') == 'Tool' ? 'selected' : '' }}>Tool</option>
                            <option value="Cable/Connector" {{ old('category') == 'Cable/Connector' ? 'selected' : '' }}>Cable/Connector</option>
                            <option value="Other" {{ old('category') == 'Other' ? 'selected' : '' }}>Other</option>
                        </select>
                        @error('category')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Manufacturer</label>
                        <input type="text" name="manufacturer" value="{{ old('manufacturer') }}"
                               class="w-full border rounded px-3 py-2">
                    </div>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">Part Number</label>
                    <input type="text" name="part_number" value="{{ old('part_number') }}"
                           class="w-full border rounded px-3 py-2">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">Product Image</label>
                    <input type="file" name="image" accept="image/*"
                           class="w-full border rounded px-3 py-2 @error('image') border-red-500 @enderror">
                    @error('image')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                    <p class="text-gray-500 text-sm mt-1">Max size: 2MB. Formats: JPEG, PNG, JPG, GIF, WEBP</p>
                </div>

                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Quantity *</label>
                        <input type="number" name="quantity" value="{{ old('quantity', 0) }}" min="0"
                               class="w-full border rounded px-3 py-2 @error('quantity') border-red-500 @enderror" required>
                        @error('quantity')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Price</label>
                        <input type="number" name="price" value="{{ old('price') }}" step="0.01" min="0"
                               class="w-full border rounded px-3 py-2">
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4 mb-6">
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Price</label>
                        <input type="number" name="price" value="{{ old('price') }}" step="0.01" min="0"
                               class="w-full border rounded px-3 py-2">
                    </div>

                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Workshop *</label>
                        <select name="workshop_id" class="w-full border rounded px-3 py-2 @error('workshop_id') border-red-500 @enderror" required>
                            <option value="">Select workshop</option>
                            @foreach($workshops as $workshop)
                            <option value="{{ $workshop->id }}" {{ old('workshop_id') == $workshop->id ? 'selected' : '' }}>
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
                        Add Part
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
