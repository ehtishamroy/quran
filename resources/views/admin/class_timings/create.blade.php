@extends('layouts.admin')

@section('header')
    Add Class Timing
@endsection

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.class_timings.index') }}" class="text-gray-500 hover:text-[#084D3C] transition">
        <i class="fas fa-arrow-left mr-2"></i> Back to Class Timings
    </a>
</div>

<div class="bg-white rounded-lg shadow-sm border border-gray-100 p-8 max-w-2xl mx-auto">
    <form action="{{ route('admin.class_timings.store') }}" method="POST">
        @csrf
        
        <div class="mb-6">
            <label class="block text-gray-700 font-medium mb-2">Title (e.g., Pakistan Time)</label>
            <input type="text" name="title" value="{{ old('title') }}" required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[#084D3C] focus:outline-none">
            @error('title') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 font-medium mb-2">Time Range (e.g., 3 PM – 10 PM)</label>
            <input type="text" name="time_range" value="{{ old('time_range') }}" required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[#084D3C] focus:outline-none">
            @error('time_range') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 font-medium mb-2">FontAwesome Icon Class (e.g., far fa-clock)</label>
            <input type="text" name="icon" value="{{ old('icon', 'far fa-clock') }}" required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[#084D3C] focus:outline-none">
            @error('icon') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            <p class="text-xs text-gray-500 mt-1">Get icons from <a href="https://fontawesome.com/v6/search?m=free" target="_blank" class="text-blue-500 underline">FontAwesome</a></p>
        </div>

        <div class="mb-6">
            <label class="inline-flex items-center cursor-pointer">
                <input type="checkbox" name="is_active" value="1" class="sr-only peer" checked>
                <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#084D3C]"></div>
                <span class="ms-3 text-sm font-medium text-gray-700">Active (Visible on frontend)</span>
            </label>
        </div>

        <div class="flex justify-end pt-4 border-t">
            <button type="submit" class="bg-[#084D3C] text-white px-6 py-2 rounded-lg hover:opacity-90 transition font-medium">Save Timing</button>
        </div>
    </form>
</div>
@endsection
