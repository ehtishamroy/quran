@extends('layouts.admin')

@section('title', 'Blog Posts')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Blog Posts</h1>
        <a href="{{ route('admin.posts.create') }}" class="bg-[#084D3C] text-white px-4 py-2 rounded-lg hover:bg-green-800 transition">
            + Create New Post
        </a>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Author</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                     <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($posts as $post)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                @if($post->image_path)
                                    <img class="h-10 w-10 min-w-10 rounded object-cover mr-3" src="{{ asset('storage/' . $post->image_path) }}" alt="">
                                @endif
                                <div class="text-sm font-medium text-gray-900 truncate max-w-xs" title="{{ $post->title }}">{{ $post->title }}</div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $post->user->name ?? 'Unknown' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($post->is_published)
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Published</span>
                            @else
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">Draft</span>
                            @endif
                        </td>
                         <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $post->created_at->format('M d, Y') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <a href="{{ route('admin.posts.edit', $post->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</a>
                            <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-gray-500">No posts found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
         <div class="px-6 py-4 border-t border-gray-200">
            {{ $posts->links() }}
        </div>
    </div>
@endsection
