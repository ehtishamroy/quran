@extends('layouts.admin')

@section('title', 'Settings')

@section('content')
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Site Settings</h1>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="p-6">
            <form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data">
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
                            <input type="file" name="general[site_logo]"
                                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[#084D3C]">
                            @if($logo = $settings['general']->where('key', 'general[site_logo]')->first()->value ?? null)
                                <img src="{{ asset('storage/' . $logo) }}" alt="Current Logo" class="h-12 mt-2">
                            @endif
                        </div>
                        <div class="col-span-1 md:col-span-2">
                            <label class="block text-gray-700 font-medium mb-2">Site Favicon (Upload)</label>
                            <input type="file" name="general[site_favicon]"
                                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[#084D3C]">
                            @if($favicon = $settings['general']->where('key', 'general[site_favicon]')->first()->value ?? null)
                                <img src="{{ asset('storage/' . $favicon) }}" alt="Current Favicon" class="h-8 mt-2">
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

                <!-- Homepage Hero Text -->
                <div class="mb-8">
                    <h2 class="text-xl font-semibold text-[#084D3C] border-b pb-2 mb-4">Homepage Hero Text</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-gray-700 font-medium mb-2">Hero Title</label>
                            <input type="text" name="home_hero[hero_title]"
                                value="{{ $settings['home_hero']->where('key', 'home_hero[hero_title]')->first()->value ?? 'Seek Knowledge' }}"
                                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[#084D3C]">
                        </div>
                        <div>
                            <label class="block text-gray-700 font-medium mb-2">Hero Highlighted Text</label>
                            <input type="text" name="home_hero[hero_highlight]"
                                value="{{ $settings['home_hero']->where('key', 'home_hero[hero_highlight]')->first()->value ?? 'From The Cradle' }}"
                                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[#084D3C]">
                        </div>
                        <div>
                            <label class="block text-gray-700 font-medium mb-2">Hero Subtitle</label>
                            <input type="text" name="home_hero[hero_subtitle]"
                                value="{{ $settings['home_hero']->where('key', 'home_hero[hero_subtitle]')->first()->value ?? 'To The Grave' }}"
                                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[#084D3C]">
                        </div>
                        <div class="col-span-2">
                            <label class="block text-gray-700 font-medium mb-2">Hero Description</label>
                            <textarea name="home_hero[hero_description]" rows="2"
                                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[#084D3C]">{{ $settings['home_hero']->where('key', 'home_hero[hero_description]')->first()->value ?? 'Join thousands of students worldwide learning Quran, Tajweed, and Islamic Studies from certified tutors.' }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- About Us Text -->
                <div class="mb-8">
                    <h2 class="text-xl font-semibold text-[#084D3C] border-b pb-2 mb-4">About Us Section</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="col-span-2">
                            <label class="block text-gray-700 font-medium mb-2">About Us Title Highlight</label>
                            <input type="text" name="about_us[about_title_highlight]"
                                value="{{ $settings['about_us']->where('key', 'about_us[about_title_highlight]')->first()->value ?? 'Suffa Islamic Center' }}"
                                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[#084D3C]">
                        </div>
                        <div class="col-span-2">
                            <label class="block text-gray-700 font-medium mb-2">About Us Description</label>
                            <textarea name="about_us[about_description]" rows="4"
                                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[#084D3C]">{{ $settings['about_us']->where('key', 'about_us[about_description]')->first()->value ?? 'We are dedicated to spreading the light of the Quran and Sunnah. Our mission is to provide accessible, high-quality Islamic education to students of all ages across the globe.' }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- Homepage Images -->
                <div class="mb-8">
                    <h2 class="text-xl font-semibold text-[#084D3C] border-b pb-2 mb-4">Homepage Images</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-gray-700 font-medium mb-2">About Us Section Image</label>
                            <input type="file" name="homepage_images[about_image]"
                                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[#084D3C]">
                            @if($aboutImg = $settings['homepage_images']->where('key', 'homepage_images[about_image]')->first()->value ?? null)
                                <img src="{{ asset('storage/' . $aboutImg) }}" alt="About Image" class="h-20 mt-2 rounded">
                            @endif
                            <p class="text-sm text-gray-500 mt-1">Leave empty to use the default image.</p>
                        </div>
                        <div>
                            <label class="block text-gray-700 font-medium mb-2">Stats Banner Background Image</label>
                            <input type="file" name="homepage_images[stats_bg]"
                                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[#084D3C]">
                            @if($statsBg = $settings['homepage_images']->where('key', 'homepage_images[stats_bg]')->first()->value ?? null)
                                <img src="{{ asset('storage/' . $statsBg) }}" alt="Stats Background" class="h-20 mt-2 rounded">
                            @endif
                            <p class="text-sm text-gray-500 mt-1">Leave empty to use the default image.</p>
                        </div>
                    </div>
                </div>

                <!-- Pricing Display -->
                <div class="mb-8">
                    <h2 class="text-xl font-semibold text-[#084D3C] border-b pb-2 mb-4">Pricing Display</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="col-span-2">
                            @php
                                $showPricing = $settings['general']->where('key', 'general[show_pricing]')->first()->value ?? '1';
                            @endphp
                            <label class="flex items-center cursor-pointer">
                                <div class="relative">
                                    <input type="hidden" name="general[show_pricing]" value="0">
                                    <input type="checkbox" id="show_pricing" name="general[show_pricing]" value="1" {{ $showPricing === '1' ? 'checked' : '' }} class="sr-only">
                                    <div class="block bg-gray-200 w-14 h-8 rounded-full transition config-bg"></div>
                                    <div
                                        class="dot absolute left-1 top-1 bg-white w-6 h-6 rounded-full transition config-transform">
                                    </div>
                                </div>
                                <div class="ml-3 text-gray-700 font-medium">Show Pricing on Homepage</div>
                            </label>
                            <style>
                                input:checked~.config-bg {
                                    background-color: #084D3C;
                                }

                                input:checked~.config-transform {
                                    transform: translateX(100%);
                                }
                            </style>
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