@extends('layouts.admin')

@section('title', 'Add Category')

@section('content')
    <div class="max-w-2xl mx-auto bg-white rounded-lg shadow overflow-hidden">
        <div class="px-6 py-4 border-b"><h2 class="text-xl font-bold text-gray-800">Add New Category</h2></div>
        <div class="p-6">
            <form action="{{ route('admin.categories.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2">Category Name <span class="text-red-500">*</span></label>
                    <input type="text" name="name" value="{{ old('name') }}" required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[#084D3C]">
                    @error('name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2">Parent Category (optional)</label>
                    <select name="parent_id" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[#084D3C]">
                        <option value="">— No Parent (Top Level) —</option>
                        @foreach($parents as $parent)
                            <option value="{{ $parent->id }}" {{ old('parent_id') == $parent->id ? 'selected' : '' }}>{{ $parent->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2">Description (optional)</label>
                    <textarea name="description" rows="3" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[#084D3C]">{{ old('description') }}</textarea>
                </div>
                <div class="mb-6">
                    <label class="block text-gray-700 font-medium mb-2">Display Order</label>
                    <input type="number" name="order" value="{{ old('order', 0) }}" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[#084D3C]">
                </div>
                <div class="flex justify-end gap-4">
                    <a href="{{ route('admin.categories.index') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300">Cancel</a>
                    <button type="submit" class="px-4 py-2 bg-[#084D3C] text-white rounded-lg hover:bg-green-800">Create Category</button>
                </div>
            </form>
        </div>
    </div>
@endsection
