@extends('layouts.admin')

@section('title', 'Edit Package')

@section('content')
    <div class="max-w-4xl mx-auto bg-white rounded-lg shadow overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-xl font-bold text-gray-800">Edit Package</h2>
        </div>
        <div class="p-6">
            <form action="{{ route('admin.packages.update', $package->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Package Title</label>
                        <input type="text" name="title" value="{{ old('title', $package->title) }}" required
                            class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[#084D3C]">
                        @error('title') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Color Theme</label>
                        <select name="color_theme"
                            class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[#084D3C]">
                            <option value="green" {{ old('color_theme', $package->color_theme) == 'green' ? 'selected' : '' }}>Green</option>
                            <option value="blue" {{ old('color_theme', $package->color_theme) == 'blue' ? 'selected' : '' }}>
                                Blue</option>
                            <option value="red" {{ old('color_theme', $package->color_theme) == 'red' ? 'selected' : '' }}>Red
                            </option>
                            <option value="yellow" {{ old('color_theme', $package->color_theme) == 'yellow' ? 'selected' : '' }}>Yellow</option>
                            <option value="purple" {{ old('color_theme', $package->color_theme) == 'purple' ? 'selected' : '' }}>Purple</option>
                        </select>
                        @error('color_theme') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Price</label>
                        <input type="number" step="0.01" name="price" value="{{ old('price', $package->price) }}" required
                            class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[#084D3C]">
                        @error('price') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Currency</label>
                        <input type="text" name="currency" value="{{ old('currency', $package->currency) }}" required
                            maxlength="3" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[#084D3C]">
                        @error('currency') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Days Per Week</label>
                        <input type="number" name="days_per_week"
                            value="{{ old('days_per_week', $package->days_per_week) }}"
                            class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[#084D3C]">
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Duration (Minutes)</label>
                        <input type="number" name="duration_minutes"
                            value="{{ old('duration_minutes', $package->duration_minutes) }}"
                            class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[#084D3C]">
                    </div>
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 font-medium mb-2">Description</label>
                    <textarea name="description" rows="3"
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[#084D3C]">{{ old('description', $package->description) }}</textarea>
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 font-medium mb-2">Features (One per line)</label>
                    <textarea name="features" rows="5"
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[#084D3C]">{{ old('features', implode("\n", $package->features ?? [])) }}</textarea>
                    <p class="text-sm text-gray-500 mt-1">Enter each feature on a new line.</p>
                </div>

                <div class="mb-6">
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="is_popular" value="1" {{ old('is_popular', $package->is_popular) ? 'checked' : '' }} class="form-checkbox h-5 w-5 text-[#084D3C] rounded focus:ring-[#084D3C]">
                        <span class="ml-2 text-gray-700 font-medium">Mark as Popular / Recommended</span>
                    </label>
                </div>

                <div class="flex justify-end space-x-4">
                    <a href="{{ route('admin.packages.index') }}"
                        class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400">Cancel</a>
                    <button type="submit" class="px-4 py-2 bg-[#084D3C] text-white rounded-lg hover:bg-green-800">Update
                        Package</button>
                </div>
            </form>
        </div>
    </div>
@endsection