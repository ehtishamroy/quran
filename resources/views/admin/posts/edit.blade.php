@extends('layouts.admin')

@section('title', 'Edit Post')

@section('content')
    <div class="max-w-4xl mx-auto bg-white rounded-lg shadow overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-xl font-bold text-gray-800">Edit Post</h2>
        </div>
        <div class="p-6">
            <form action="{{ route('admin.posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-6">
                    <label class="block text-gray-700 font-medium mb-2">Title</label>
                    <input type="text" name="title" value="{{ old('title', $post->title) }}" required
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[#084D3C]">
                    @error('title') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 font-medium mb-2">Featured Image</label>
                    <input type="file" name="image" accept="image/*"
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[#084D3C]">
                    @if($post->image_path)
                        <div class="mt-2">
                            <img src="{{ asset('storage/' . $post->image_path) }}" alt="" class="h-32 rounded object-cover">
                        </div>
                    @endif
                    @error('image') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 font-medium mb-2">Content</label>
                    <textarea name="content" rows="10" required
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[#084D3C]">{{ old('content', $post->content) }}</textarea>
                    @error('content') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="mb-6">
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="is_published" value="1" {{ old('is_published', $post->is_published) ? 'checked' : '' }} class="form-checkbox h-5 w-5 text-[#084D3C] rounded focus:ring-[#084D3C]">
                        <span class="ml-2 text-gray-700 font-medium">Publish immediately</span>
                    </label>
                </div>

                <div class="flex justify-end space-x-4">
                    <a href="{{ route('admin.posts.index') }}"
                        class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400">Cancel</a>
                    <button type="submit" class="px-4 py-2 bg-[#084D3C] text-white rounded-lg hover:bg-green-800">Update
                        Post</button>
                </div>
            </form>
        </div>
    </div>
@endsection