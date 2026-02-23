@extends('layouts.admin')

@section('title', 'Settings')

@section('content')
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Site Settings</h1>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="p-6">
            <form method="POST" action="{{ route('admin.settings.update', 'all') }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- General Settings -->
                <div class="mb-8">
                    <h2 class="text-xl font-semibold text-[#084D3C] border-b pb-2 mb-4">General Details</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-gray-700 font-medium mb-2">Site Name</label>
                            <input type="text" name="site_name"
                                value="{{ $settings['general']->where('key', 'site_name')->first()->value ?? 'Suffa Islamic Center' }}"
                                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[#084D3C]">
                        </div>
                        <div>
                            <label class="block text-gray-700 font-medium mb-2">Site Logo (Upload)</label>
                            <input type="file" name="site_logo"
                                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[#084D3C]">
                            @if($logo = $settings['general']->where('key', 'site_logo')->first()->value ?? null)
                                <img src="{{ asset('storage/' . $logo) }}" alt="Current Logo" class="h-12 mt-2">
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Contact Information -->
                <div class="mb-8">
                    <h2 class="text-xl font-semibold text-[#084D3C] border-b pb-2 mb-4">Contact Information</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-gray-700 font-medium mb-2">Phone Number</label>
                            <input type="text" name="contact_phone"
                                value="{{ $settings['contact']->where('key', 'contact_phone')->first()->value ?? '' }}"
                                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[#084D3C]">
                        </div>
                        <div>
                            <label class="block text-gray-700 font-medium mb-2">WhatsApp Number</label>
                            <input type="text" name="whatsapp_number"
                                value="{{ $settings['contact']->where('key', 'whatsapp_number')->first()->value ?? '' }}"
                                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[#084D3C]">
                        </div>
                        <div>
                            <label class="block text-gray-700 font-medium mb-2">Email Address</label>
                            <input type="email" name="contact_email"
                                value="{{ $settings['contact']->where('key', 'contact_email')->first()->value ?? '' }}"
                                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[#084D3C]">
                        </div>
                        <div class="col-span-2">
                            <label class="block text-gray-700 font-medium mb-2">Address</label>
                            <textarea name="contact_address" rows="2"
                                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[#084D3C]">{{ $settings['contact']->where('key', 'contact_address')->first()->value ?? '' }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- Social Media -->
                <div class="mb-8">
                    <h2 class="text-xl font-semibold text-[#084D3C] border-b pb-2 mb-4">Social Media Links</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-gray-700 font-medium mb-2">Facebook URL</label>
                            <input type="url" name="social_facebook"
                                value="{{ $settings['social']->where('key', 'social_facebook')->first()->value ?? '' }}"
                                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[#084D3C]">
                        </div>
                        <div>
                            <label class="block text-gray-700 font-medium mb-2">Instagram URL</label>
                            <input type="url" name="social_instagram"
                                value="{{ $settings['social']->where('key', 'social_instagram')->first()->value ?? '' }}"
                                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[#084D3C]">
                        </div>
                        <div>
                            <label class="block text-gray-700 font-medium mb-2">Twitter/X URL</label>
                            <input type="url" name="social_twitter"
                                value="{{ $settings['social']->where('key', 'social_twitter')->first()->value ?? '' }}"
                                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[#084D3C]">
                        </div>
                        <div>
                            <label class="block text-gray-700 font-medium mb-2">YouTube URL</label>
                            <input type="url" name="social_youtube"
                                value="{{ $settings['social']->where('key', 'social_youtube')->first()->value ?? '' }}"
                                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[#084D3C]">
                        </div>
                    </div>
                </div>

                <div class="flex justify-end">
                    <button type="submit"
                        class="bg-[#DB9E30] text-white px-6 py-3 rounded-lg font-bold hover:bg-yellow-600 transition">
                        Save Settings
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection