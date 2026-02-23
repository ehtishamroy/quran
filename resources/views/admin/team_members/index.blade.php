@extends('layouts.admin')

@section('title', 'Team Members')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Team Members</h1>
        <a href="{{ route('admin.team-members.create') }}" class="bg-[#084D3C] text-white px-4 py-2 rounded-lg hover:bg-green-800 transition">
            + Add New Member
        </a>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Image</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name & Role</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($teamMembers as $member)
                    <tr>
                         <td class="px-6 py-4 whitespace-nowrap text-gray-500">
                            {{ $member->display_order }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($member->image_path)
                                <img class="h-10 w-10 rounded-full object-cover" src="{{ asset('storage/' . $member->image_path) }}" alt="">
                            @else
                                <div class="h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center text-gray-500">
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                </div>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">{{ $member->name }}</div>
                            <div class="text-sm text-gray-500">{{ $member->role }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <a href="{{ route('admin.team-members.edit', $member->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</a>
                            <form action="{{ route('admin.team-members.destroy', $member->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-4 text-center text-gray-500">No team members found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
