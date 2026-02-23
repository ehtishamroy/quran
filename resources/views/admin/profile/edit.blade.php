@extends('layouts.admin')

@section('title', 'Edit Profile')

@section('content')
    <div class="max-w-4xl mx-auto bg-white rounded-lg shadow overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-xl font-bold text-gray-800">My Profile</h2>
        </div>
        <div class="p-6">
            <form action="{{ route('admin.profile.update') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Name</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                            class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[#084D3C]">
                        @error('name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Email</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                            class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[#084D3C]">
                        @error('email') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium mb-2">New Password (Optional)</label>
                        <input type="password" name="password" autocomplete="new-password"
                            class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[#084D3C]">
                        @error('password') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        <p class="text-xs text-gray-500 mt-1">Leave blank to keep current password.</p>
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Confirm New Password</label>
                        <input type="password" name="password_confirmation" autocomplete="new-password"
                            class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[#084D3C]">
                    </div>
                </div>

                <div class="flex justify-end space-x-4">
                    <button type="submit" class="px-4 py-2 bg-[#084D3C] text-white rounded-lg hover:bg-green-800">Update
                        Profile</button>
                </div>
            </form>
        </div>
    </div>
@endsection