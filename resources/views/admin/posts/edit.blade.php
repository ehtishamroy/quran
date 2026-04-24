@extends('layouts.admin')

@section('title', 'Edit Post')

@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-xl font-bold text-gray-800">Edit Post: {{ $post->title }}</h2>
            </div>
            <div class="p-6">
                <form action="{{ route('admin.posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                        <!-- Main Content -->
                        <div class="lg:col-span-2 space-y-5">
                            <div>
                                <label class="block text-gray-700 font-medium mb-2">Title <span class="text-red-500">*</span></label>
                                <input type="text" name="title" value="{{ old('title', $post->title) }}" required
                                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[#084D3C]">
                                @error('title') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label class="block text-gray-700 font-medium mb-2">Featured Image</label>
                                <input type="file" name="image" accept="image/*"
                                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[#084D3C]">
                                @if($post->image_path)
                                    <div class="mt-2">
                                        <img src="{{ asset('storage/' . $post->image_path) }}" alt="" class="h-32 rounded object-cover">
                                        <p class="text-xs text-gray-400 mt-1">Upload a new image to replace the current one.</p>
                                    </div>
                                @endif
                                @error('image') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label class="block text-gray-700 font-medium mb-2">Content <span class="text-red-500">*</span></label>
                                <textarea name="content" rows="14" required
                                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[#084D3C]">{{ old('content', $post->content) }}</textarea>
                                @error('content') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <!-- Sidebar -->
                        <div class="space-y-5">
                            <!-- Publish -->
                            <div class="bg-gray-50 border rounded-lg p-4">
                                <h3 class="font-semibold text-gray-800 mb-3">Publishing</h3>
                                <label class="inline-flex items-center">
                                    <input type="checkbox" name="is_published" value="1"
                                        {{ old('is_published', $post->is_published) ? 'checked' : '' }}
                                        class="form-checkbox h-5 w-5 text-[#084D3C]">
                                    <span class="ml-2 text-gray-700 font-medium">Published</span>
                                </label>
                                <p class="text-xs text-gray-400 mt-1">Published: {{ $post->created_at->format('M d, Y') }}</p>
                            </div>

                            <!-- Category -->
                            <div class="bg-gray-50 border rounded-lg p-4">
                                <h3 class="font-semibold text-gray-800 mb-3">Category</h3>
                                <select name="category_id" class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-[#084D3C]">
                                    <option value="">— No Category —</option>
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat->id }}" {{ old('category_id', $post->category_id) == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                                        @foreach($cat->children as $child)
                                            <option value="{{ $child->id }}" {{ old('category_id', $post->category_id) == $child->id ? 'selected' : '' }}>&nbsp;&nbsp;↳ {{ $child->name }}</option>
                                        @endforeach
                                    @endforeach
                                </select>
                            </div>

                            <!-- SEO -->
                            <div class="bg-gray-50 border rounded-lg p-4">
                                <h3 class="font-semibold text-gray-800 mb-3">🔍 SEO Settings</h3>
                                <div class="space-y-3">
                                    <div>
                                        <label class="block text-gray-600 text-sm font-medium mb-1">Meta Title</label>
                                        <input type="text" name="meta_title" value="{{ old('meta_title', $post->meta_title) }}" maxlength="255"
                                            placeholder="Leave blank to use post title"
                                            class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-[#084D3C] text-sm">
                                    </div>
                                    <div>
                                        <label class="block text-gray-600 text-sm font-medium mb-1">Meta Description</label>
                                        <textarea name="meta_description" rows="3" maxlength="500"
                                            placeholder="Brief summary for search engines"
                                            class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-[#084D3C] text-sm">{{ old('meta_description', $post->meta_description) }}</textarea>
                                    </div>
                                    <div>
                                        <label class="block text-gray-600 text-sm font-medium mb-1">Keywords</label>
                                        <input type="text" name="meta_keywords" value="{{ old('meta_keywords', $post->meta_keywords) }}"
                                            placeholder="quran, islamic, tajweed"
                                            class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-[#084D3C] text-sm">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end space-x-4 mt-6 border-t pt-4">
                        <a href="{{ route('admin.posts.index') }}" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400">Cancel</a>
                        <button type="submit" class="px-6 py-2 bg-[#084D3C] text-white rounded-lg hover:bg-green-800">Update Post</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection