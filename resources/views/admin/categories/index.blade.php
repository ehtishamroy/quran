@extends('layouts.admin')

@section('title', 'Blog Categories')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Blog Categories</h1>
        <a href="{{ route('admin.categories.create') }}" class="bg-[#084D3C] text-white px-4 py-2 rounded-lg hover:bg-green-800 flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Add Category
        </a>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-50 border-b">
                <tr>
                    <th class="text-left px-6 py-3 text-xs text-gray-500 uppercase tracking-wider">Name</th>
                    <th class="text-left px-6 py-3 text-xs text-gray-500 uppercase tracking-wider">Slug</th>
                    <th class="text-left px-6 py-3 text-xs text-gray-500 uppercase tracking-wider">Parent</th>
                    <th class="text-left px-6 py-3 text-xs text-gray-500 uppercase tracking-wider">Posts</th>
                    <th class="text-left px-6 py-3 text-xs text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($categories as $cat)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 font-medium text-gray-900">{{ $cat->name }}</td>
                        <td class="px-6 py-4 text-gray-500 text-sm">{{ $cat->slug }}</td>
                        <td class="px-6 py-4 text-gray-500 text-sm">—</td>
                        <td class="px-6 py-4 text-gray-500 text-sm">{{ $cat->posts->count() }}</td>
                        <td class="px-6 py-4 flex items-center gap-3">
                            <a href="{{ route('admin.categories.edit', $cat) }}" class="text-blue-600 hover:underline text-sm">Edit</a>
                            <form method="POST" action="{{ route('admin.categories.destroy', $cat) }}" onsubmit="return confirm('Delete this category?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-500 hover:underline text-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @foreach($cat->children as $child)
                    <tr class="hover:bg-gray-50 bg-gray-50/50">
                        <td class="px-6 py-4 font-medium text-gray-700 pl-12">↳ {{ $child->name }}</td>
                        <td class="px-6 py-4 text-gray-500 text-sm">{{ $child->slug }}</td>
                        <td class="px-6 py-4 text-gray-500 text-sm">{{ $cat->name }}</td>
                        <td class="px-6 py-4 text-gray-500 text-sm">{{ $child->posts->count() }}</td>
                        <td class="px-6 py-4 flex items-center gap-3">
                            <a href="{{ route('admin.categories.edit', $child) }}" class="text-blue-600 hover:underline text-sm">Edit</a>
                            <form method="POST" action="{{ route('admin.categories.destroy', $child) }}" onsubmit="return confirm('Delete this category?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-500 hover:underline text-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-gray-400">No categories found. <a href="{{ route('admin.categories.create') }}" class="text-[#084D3C] font-bold">Create one</a>.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
