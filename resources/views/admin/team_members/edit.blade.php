@extends('layouts.admin')

@section('title', 'Edit Team Member')

@section('content')
    <div class="max-w-4xl mx-auto bg-white rounded-lg shadow overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-xl font-bold text-gray-800">Edit Team Member</h2>
        </div>
        <div class="p-6">
            <form action="{{ route('admin.team-members.update', $teamMember->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Name</label>
                        <input type="text" name="name" value="{{ old('name', $teamMember->name) }}" required
                            class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[#084D3C]">
                        @error('name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Role / Title</label>
                        <input type="text" name="role" value="{{ old('role', $teamMember->role) }}" required
                            class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[#084D3C]">
                        @error('role') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Display Order</label>
                        <input type="number" name="display_order"
                            value="{{ old('display_order', $teamMember->display_order) }}"
                            class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[#084D3C]">
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Profile Image</label>
                        <input type="file" name="image" accept="image/*"
                            class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[#084D3C]">
                        @if($teamMember->image_path)
                            <div class="mt-2">
                                <img src="{{ asset('storage/' . $teamMember->image_path) }}" alt=""
                                    class="h-16 w-16 object-cover rounded-full">
                            </div>
                        @endif
                        @error('image') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 font-medium mb-2">Social Media Links (Optional)</label>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div
                            class="flex items-center border rounded-lg px-3 py-2 bg-gray-50 focus-within:ring-2 focus-within:ring-[#084D3C]">
                            <i class="fab fa-facebook text-blue-600 mr-2"></i>
                            <input type="url" name="social_links[facebook]" placeholder="Facebook URL"
                                value="{{ old('social_links.facebook', $teamMember->social_links['facebook'] ?? '') }}"
                                class="w-full bg-transparent outline-none">
                        </div>
                        <div
                            class="flex items-center border rounded-lg px-3 py-2 bg-gray-50 focus-within:ring-2 focus-within:ring-[#084D3C]">
                            <i class="fab fa-twitter text-blue-400 mr-2"></i>
                            <input type="url" name="social_links[twitter]" placeholder="Twitter URL"
                                value="{{ old('social_links.twitter', $teamMember->social_links['twitter'] ?? '') }}"
                                class="w-full bg-transparent outline-none">
                        </div>
                        <div
                            class="flex items-center border rounded-lg px-3 py-2 bg-gray-50 focus-within:ring-2 focus-within:ring-[#084D3C]">
                            <i class="fab fa-instagram text-pink-500 mr-2"></i>
                            <input type="url" name="social_links[instagram]" placeholder="Instagram URL"
                                value="{{ old('social_links.instagram', $teamMember->social_links['instagram'] ?? '') }}"
                                class="w-full bg-transparent outline-none">
                        </div>
                    </div>
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 font-medium mb-2">Bio</label>
                    <textarea name="bio" rows="4"
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[#084D3C]">{{ old('bio', $teamMember->bio) }}</textarea>
                </div>

                <div class="flex justify-end space-x-4">
                    <a href="{{ route('admin.team-members.index') }}"
                        class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400">Cancel</a>
                    <button type="submit" class="px-4 py-2 bg-[#084D3C] text-white rounded-lg hover:bg-green-800">Update
                        Member</button>
                </div>
            </form>
        </div>
    </div>
@endsection