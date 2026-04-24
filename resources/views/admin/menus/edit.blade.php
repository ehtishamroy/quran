@extends('layouts.admin')

@section('title', 'Edit Menu Item')

@section('content')
    <div class="max-w-2xl mx-auto bg-white rounded-lg shadow overflow-hidden">
        <div class="px-6 py-4 border-b"><h2 class="text-xl font-bold text-gray-800">Edit Menu Item</h2></div>
        <div class="p-6">
            <form action="{{ route('admin.menus.update', $menu) }}" method="POST">
                @csrf @method('PUT')
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2">Title <span class="text-red-500">*</span></label>
                    <input type="text" name="title" value="{{ old('title', $menu->title) }}" required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[#084D3C]">
                    @error('title') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2">URL <span class="text-red-500">*</span></label>
                    <input type="text" name="url" value="{{ old('url', $menu->url) }}" required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[#084D3C]">
                    <p class="text-xs text-gray-400 mt-1">Use <code>/</code> for home, <code>#section</code> for page anchors, or a full URL for external links.</p>
                    @error('url') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Parent (optional)</label>
                        <select name="parent_id" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[#084D3C]">
                            <option value="">— Top Level —</option>
                            @foreach($parents as $parent)
                                <option value="{{ $parent->id }}" {{ old('parent_id', $menu->parent_id) == $parent->id ? 'selected' : '' }}>{{ $parent->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Order</label>
                        <input type="number" name="order" value="{{ old('order', $menu->order) }}" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[#084D3C]">
                    </div>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2">Link Target</label>
                    <select name="target" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[#084D3C]">
                        <option value="_self" {{ old('target', $menu->target) === '_self' ? 'selected' : '' }}>Same Tab (_self)</option>
                        <option value="_blank" {{ old('target', $menu->target) === '_blank' ? 'selected' : '' }}>New Tab (_blank)</option>
                    </select>
                </div>
                <div class="mb-6 space-y-3">
                    <label class="flex items-center gap-3 cursor-pointer">
                        <input type="checkbox" name="is_button" value="1" {{ old('is_button', $menu->is_button) ? 'checked' : '' }} class="w-5 h-5 rounded text-[#084D3C]">
                        <span class="text-gray-700">Style as a CTA Button</span>
                    </label>
                    <label class="flex items-center gap-3 cursor-pointer">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', $menu->is_active) ? 'checked' : '' }} class="w-5 h-5 rounded text-[#084D3C]">
                        <span class="text-gray-700">Active (visible on website)</span>
                    </label>
                </div>
                <div class="flex justify-end gap-4">
                    <a href="{{ route('admin.menus.index') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300">Cancel</a>
                    <button type="submit" class="px-4 py-2 bg-[#084D3C] text-white rounded-lg hover:bg-green-800">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
@endsection
