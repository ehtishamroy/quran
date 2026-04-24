@extends('layouts.admin')

@section('title', 'Menu Management')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Menu Management</h1>
            <p class="text-gray-500 text-sm mt-1">Control navigation links shown on the frontend. Drag to reorder.</p>
        </div>
        <a href="{{ route('admin.menus.create') }}" class="bg-[#084D3C] text-white px-4 py-2 rounded-lg hover:bg-green-800 flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Add Menu Item
        </a>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-50 border-b">
                <tr>
                    <th class="text-left px-6 py-3 text-xs text-gray-500 uppercase tracking-wider w-8">Order</th>
                    <th class="text-left px-6 py-3 text-xs text-gray-500 uppercase tracking-wider">Title</th>
                    <th class="text-left px-6 py-3 text-xs text-gray-500 uppercase tracking-wider">URL</th>
                    <th class="text-left px-6 py-3 text-xs text-gray-500 uppercase tracking-wider">Parent</th>
                    <th class="text-left px-6 py-3 text-xs text-gray-500 uppercase tracking-wider">Type</th>
                    <th class="text-left px-6 py-3 text-xs text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="text-left px-6 py-3 text-xs text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($items as $item)
                    <tr class="hover:bg-gray-50" id="row-{{ $item->id }}">
                        <td class="px-6 py-4 text-gray-400 font-mono text-sm">{{ $item->order }}</td>
                        <td class="px-6 py-4 font-semibold text-gray-900">{{ $item->title }}</td>
                        <td class="px-6 py-4 text-gray-500 text-sm truncate max-w-[200px]">{{ $item->url }}</td>
                        <td class="px-6 py-4 text-gray-400 text-sm">—</td>
                        <td class="px-6 py-4">
                            @if($item->is_button)
                                <span class="bg-[#DB9E30] text-white text-xs px-2 py-1 rounded-full">Button</span>
                            @else
                                <span class="bg-gray-200 text-gray-600 text-xs px-2 py-1 rounded-full">Link</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            @if($item->is_active)
                                <span class="bg-green-100 text-green-700 text-xs px-2 py-1 rounded-full">Active</span>
                            @else
                                <span class="bg-red-100 text-red-600 text-xs px-2 py-1 rounded-full">Hidden</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <a href="{{ route('admin.menus.edit', $item) }}" class="text-blue-600 hover:underline text-sm">Edit</a>
                                <form method="POST" action="{{ route('admin.menus.destroy', $item) }}" onsubmit="return confirm('Delete this menu item?')">
                                    @csrf @method('DELETE')
                                    <button class="text-red-500 hover:underline text-sm">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @foreach($item->children as $child)
                    <tr class="hover:bg-gray-50 bg-gray-50/30">
                        <td class="px-6 py-4 text-gray-400 font-mono text-sm">{{ $child->order }}</td>
                        <td class="px-6 py-4 font-medium text-gray-700 pl-12">↳ {{ $child->title }}</td>
                        <td class="px-6 py-4 text-gray-500 text-sm truncate max-w-[200px]">{{ $child->url }}</td>
                        <td class="px-6 py-4 text-gray-400 text-sm">{{ $item->title }}</td>
                        <td class="px-6 py-4">
                            @if($child->is_button)
                                <span class="bg-[#DB9E30] text-white text-xs px-2 py-1 rounded-full">Button</span>
                            @else
                                <span class="bg-gray-200 text-gray-600 text-xs px-2 py-1 rounded-full">Link</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            @if($child->is_active)
                                <span class="bg-green-100 text-green-700 text-xs px-2 py-1 rounded-full">Active</span>
                            @else
                                <span class="bg-red-100 text-red-600 text-xs px-2 py-1 rounded-full">Hidden</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <a href="{{ route('admin.menus.edit', $child) }}" class="text-blue-600 hover:underline text-sm">Edit</a>
                                <form method="POST" action="{{ route('admin.menus.destroy', $child) }}" onsubmit="return confirm('Delete this menu item?')">
                                    @csrf @method('DELETE')
                                    <button class="text-red-500 hover:underline text-sm">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-12 text-center text-gray-400">
                            No menu items yet. <a href="{{ route('admin.menus.create') }}" class="text-[#084D3C] font-bold">Create one</a>.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4 bg-blue-50 border border-blue-200 rounded-lg p-4 text-sm text-blue-700">
        <strong>Tip:</strong> If no menu items are added, the website will use the default built-in navigation. Add items here to override with custom navigation.
    </div>
@endsection
