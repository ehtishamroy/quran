@extends('layouts.admin')

@section('title', 'Settings')

@section('content')
<h1 class="text-3xl font-bold text-gray-800 mb-6">Site Settings</h1>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <div class="p-6">
        <form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- THEME COLORS --}}
            <div class="mb-8">
                <h2 class="text-xl font-semibold text-[#084D3C] border-b pb-2 mb-4">🎨 Theme Colors</h2>
                <p class="text-sm text-gray-500 mb-4">Customize the website's brand colors. Changes apply globally across the entire site.</p>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Primary Color</label>
                        <div class="flex items-center gap-3">
                            <input type="color" name="theme[primary_color]"
                                value="{{ $settings['theme']->where('key', 'theme[primary_color]')->first()->value ?? '#084D3C' }}"
                                class="h-10 w-16 border rounded cursor-pointer">
                            <input type="text" id="primary_color_text"
                                value="{{ $settings['theme']->where('key', 'theme[primary_color]')->first()->value ?? '#084D3C' }}"
                                class="flex-1 px-3 py-2 border rounded-lg text-sm font-mono"
                                oninput="document.querySelector('[name=\'theme[primary_color]\']').value=this.value">
                        </div>
                        <p class="text-xs text-gray-400 mt-1">Used for: navbar, hero, footers, buttons</p>
                    </div>
                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Secondary / Accent Color</label>
                        <div class="flex items-center gap-3">
                            <input type="color" name="theme[secondary_color]"
                                value="{{ $settings['theme']->where('key', 'theme[secondary_color]')->first()->value ?? '#DB9E30' }}"
                                class="h-10 w-16 border rounded cursor-pointer">
                            <input type="text" id="secondary_color_text"
                                value="{{ $settings['theme']->where('key', 'theme[secondary_color]')->first()->value ?? '#DB9E30' }}"
                                class="flex-1 px-3 py-2 border rounded-lg text-sm font-mono"
                                oninput="document.querySelector('[name=\'theme[secondary_color]\']').value=this.value">
                        </div>
                        <p class="text-xs text-gray-400 mt-1">Used for: highlights, badges, hover states</p>
                    </div>
                    <div class="md:col-span-3">
                        <div class="bg-gray-50 border rounded-lg p-4">
                            <p class="text-sm font-medium text-gray-700 mb-2">Color Preview:</p>
                            <div class="flex gap-3 flex-wrap">
                                <div id="preview-primary" class="px-4 py-2 rounded text-white text-sm font-bold" style="background:{{ $settings['theme']->where('key', 'theme[primary_color]')->first()->value ?? '#084D3C' }}">Primary Button</div>
                                <div id="preview-secondary" class="px-4 py-2 rounded text-white text-sm font-bold" style="background:{{ $settings['theme']->where('key', 'theme[secondary_color]')->first()->value ?? '#DB9E30' }}">Secondary Button</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- HERO SECTION --}}
            <div class="mb-8">
                <h2 class="text-xl font-semibold text-[#084D3C] border-b pb-2 mb-4">🦸 Hero Section</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Hero Background Color</label>
                        <div class="flex items-center gap-3">
                            <input type="color" name="home_hero[hero_bg_color]"
                                value="{{ $settings['home_hero']->where('key', 'home_hero[hero_bg_color]')->first()->value ?? '#084D3C' }}"
                                class="h-10 w-16 border rounded cursor-pointer">
                            <input type="text"
                                value="{{ $settings['home_hero']->where('key', 'home_hero[hero_bg_color]')->first()->value ?? '#084D3C' }}"
                                class="flex-1 px-3 py-2 border rounded-lg text-sm font-mono"
                                oninput="document.querySelector('[name=\'home_hero[hero_bg_color]\']').value=this.value">
                        </div>
                        <p class="text-xs text-gray-400 mt-1">Applied as a solid background color overlay.</p>
                    </div>
                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Hero Background Image (optional)</label>
                        <input type="file" name="home_hero[hero_bg_image]" accept="image/*"
                            class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[#084D3C]">
                        @if($heroBgImg = $settings['home_hero']->where('key', 'home_hero[hero_bg_image]')->first()->value ?? null)
                            <img src="{{ asset('storage/' . $heroBgImg) }}" class="h-20 mt-2 rounded object-cover w-full" alt="Hero BG">
                            <p class="text-xs text-gray-400 mt-1">Upload new image to replace. Image takes priority over color.</p>
                        @else
                            <p class="text-xs text-gray-400 mt-1">Upload an image to use as hero background. Leave empty for solid color.</p>
                        @endif
                    </div>
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

            {{-- STATS / COUNTERS --}}
            <div class="mb-8">
                <h2 class="text-xl font-semibold text-[#084D3C] border-b pb-2 mb-4">📊 Stats & Counters</h2>
                <p class="text-sm text-gray-500 mb-4">For numeric counters (e.g. 500, 50), the website will animate from 1 to this number. For non-numeric like "100%" or "24/7", it displays as-is.</p>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @for($i = 1; $i <= 4; $i++)
                    @php
                        $defaults = [
                            1 => ['value' => '500', 'label' => 'Students', 'suffix' => '+'],
                            2 => ['value' => '50', 'label' => 'Expert Tutors', 'suffix' => '+'],
                            3 => ['value' => '100', 'label' => 'Satisfaction Rate', 'suffix' => '%'],
                            4 => ['value' => '24/7', 'label' => 'Support', 'suffix' => ''],
                        ];
                    @endphp
                    <div class="bg-gray-50 border rounded-lg p-4">
                        <h4 class="font-medium text-gray-700 mb-3">Counter {{ $i }}</h4>
                        <div class="space-y-2">
                            <div>
                                <label class="text-xs text-gray-500 font-medium">Value (number only for animation)</label>
                                <input type="text" name="stats[counter_{{ $i }}_value]"
                                    value="{{ $settings['stats']->where('key', 'stats[counter_'.$i.'_value]')->first()->value ?? $defaults[$i]['value'] }}"
                                    class="w-full px-3 py-2 border rounded-lg text-sm focus:ring-2 focus:ring-[#084D3C]" placeholder="e.g. 500">
                            </div>
                            <div>
                                <label class="text-xs text-gray-500 font-medium">Suffix (optional)</label>
                                <input type="text" name="stats[counter_{{ $i }}_suffix]"
                                    value="{{ $settings['stats']->where('key', 'stats[counter_'.$i.'_suffix]')->first()->value ?? $defaults[$i]['suffix'] }}"
                                    class="w-full px-3 py-2 border rounded-lg text-sm focus:ring-2 focus:ring-[#084D3C]" placeholder="e.g. + or %">
                            </div>
                            <div>
                                <label class="text-xs text-gray-500 font-medium">Label</label>
                                <input type="text" name="stats[counter_{{ $i }}_label]"
                                    value="{{ $settings['stats']->where('key', 'stats[counter_'.$i.'_label]')->first()->value ?? $defaults[$i]['label'] }}"
                                    class="w-full px-3 py-2 border rounded-lg text-sm focus:ring-2 focus:ring-[#084D3C]" placeholder="e.g. Students">
                            </div>
                        </div>
                    </div>
                    @endfor
                </div>
                <div class="mt-4">
                    <label class="block text-gray-700 font-medium mb-2">Stats Banner Background Image</label>
                    <input type="file" name="homepage_images[stats_bg]"
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[#084D3C]">
                    @if($statsBg = $settings['homepage_images']->where('key', 'homepage_images[stats_bg]')->first()->value ?? null)
                        <img src="{{ asset('storage/' . $statsBg) }}" alt="Stats Background" class="h-20 mt-2 rounded">
                    @endif
                    <p class="text-sm text-gray-500 mt-1">Leave empty to use the default image.</p>
                </div>
            </div>

            {{-- SEO --}}
            <div class="mb-8">
                <h2 class="text-xl font-semibold text-[#084D3C] border-b pb-2 mb-4">🔍 Global SEO Settings</h2>
                <p class="text-sm text-gray-500 mb-4">These settings apply to the homepage. Individual blog posts have their own SEO fields.</p>
                <div class="grid grid-cols-1 gap-4">
                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Homepage Meta Title</label>
                        <input type="text" name="seo[meta_title]" maxlength="255"
                            value="{{ $settings['seo']->where('key', 'seo[meta_title]')->first()->value ?? '' }}"
                            placeholder="Suffa Islamic Center – Learn Quran Online"
                            class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[#084D3C]">
                        <p class="text-xs text-gray-400 mt-1">Ideal length: 50–60 characters. Leave blank to use Site Name.</p>
                    </div>
                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Homepage Meta Description</label>
                        <textarea name="seo[meta_description]" rows="2" maxlength="500"
                            placeholder="Join thousands learning Quran, Tajweed & Islamic Studies from certified teachers."
                            class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[#084D3C]">{{ $settings['seo']->where('key', 'seo[meta_description]')->first()->value ?? '' }}</textarea>
                        <p class="text-xs text-gray-400 mt-1">Ideal length: 150–160 characters.</p>
                    </div>
                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Homepage Meta Keywords</label>
                        <input type="text" name="seo[meta_keywords]"
                            value="{{ $settings['seo']->where('key', 'seo[meta_keywords]')->first()->value ?? '' }}"
                            placeholder="quran online, learn tajweed, islamic center, hifz program"
                            class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[#084D3C]">
                    </div>
                    <div>
                        <label class="block text-gray-700 font-medium mb-2">OG / Social Share Image</label>
                        <input type="file" name="seo[og_image]" accept="image/*"
                            class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[#084D3C]">
                        @if($ogImg = $settings['seo']->where('key', 'seo[og_image]')->first()->value ?? null)
                            <img src="{{ asset('storage/' . $ogImg) }}" class="h-20 mt-2 rounded" alt="OG Image">
                        @endif
                        <p class="text-xs text-gray-400 mt-1">Recommended: 1200×630px. Shown when shared on Facebook, WhatsApp, etc.</p>
                    </div>
                </div>
            </div>

            {{-- GENERAL SETTINGS --}}
            <div class="mb-8">
                <h2 class="text-xl font-semibold text-[#084D3C] border-b pb-2 mb-4">⚙️ General Details</h2>
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

            {{-- CONTACT INFORMATION --}}
            <div class="mb-8">
                <h2 class="text-xl font-semibold text-[#084D3C] border-b pb-2 mb-4">📞 Contact Information</h2>
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
                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Address</label>
                        <textarea name="contact_address" rows="2"
                            class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[#084D3C]">{{ $settings['contact']->where('key', 'contact_address')->first()->value ?? '' }}</textarea>
                    </div>
                </div>
            </div>

            {{-- SOCIAL MEDIA --}}
            <div class="mb-8">
                <h2 class="text-xl font-semibold text-[#084D3C] border-b pb-2 mb-4">🌐 Social Media Links</h2>
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

            {{-- ABOUT US --}}
            <div class="mb-8">
                <h2 class="text-xl font-semibold text-[#084D3C] border-b pb-2 mb-4">ℹ️ About Us Section</h2>
                <div class="grid grid-cols-1 gap-6">
                    <div>
                        <label class="block text-gray-700 font-medium mb-2">About Us Title Highlight</label>
                        <input type="text" name="about_us[about_title_highlight]"
                            value="{{ $settings['about_us']->where('key', 'about_us[about_title_highlight]')->first()->value ?? 'Suffa Islamic Center' }}"
                            class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[#084D3C]">
                    </div>
                    <div>
                        <label class="block text-gray-700 font-medium mb-2">About Us Description</label>
                        <textarea name="about_us[about_description]" rows="4"
                            class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[#084D3C]">{{ $settings['about_us']->where('key', 'about_us[about_description]')->first()->value ?? 'We are dedicated to spreading the light of the Quran and Sunnah.' }}</textarea>
                    </div>
                    <div>
                        <label class="block text-gray-700 font-medium mb-2">About Us Section Image</label>
                        <input type="file" name="homepage_images[about_image]"
                            class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[#084D3C]">
                        @if($aboutImg = $settings['homepage_images']->where('key', 'homepage_images[about_image]')->first()->value ?? null)
                            <img src="{{ asset('storage/' . $aboutImg) }}" alt="About Image" class="h-20 mt-2 rounded">
                        @endif
                    </div>
                </div>
            </div>

            {{-- PRICING DISPLAY --}}
            <div class="mb-8">
                <h2 class="text-xl font-semibold text-[#084D3C] border-b pb-2 mb-4">💰 Pricing Display</h2>
                @php $showPricing = $settings['general']->where('key', 'general[show_pricing]')->first()->value ?? '1'; @endphp
                <label class="flex items-center cursor-pointer gap-4">
                    <div class="relative">
                        <input type="hidden" name="general[show_pricing]" value="0">
                        <input type="checkbox" id="show_pricing" name="general[show_pricing]" value="1"
                            {{ $showPricing === '1' ? 'checked' : '' }} class="sr-only peer">
                        <div class="block bg-gray-200 peer-checked:bg-[#084D3C] w-14 h-8 rounded-full transition"></div>
                        <div class="dot absolute left-1 top-1 bg-white w-6 h-6 rounded-full transition peer-checked:translate-x-6"></div>
                    </div>
                    <div>
                        <span class="text-gray-700 font-medium">Show Pricing on Homepage</span>
                        <p class="text-xs text-gray-400">When off, course prices are hidden from public visitors.</p>
                    </div>
                </label>
            </div>

            <div class="flex justify-end">
                <button type="submit"
                    class="bg-[#DB9E30] text-white px-8 py-3 rounded-lg font-bold hover:bg-yellow-600 transition text-lg">
                    Save All Settings
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    // Live color preview
    document.querySelectorAll('input[type=color]').forEach(el => {
        el.addEventListener('input', function() {
            const name = this.getAttribute('name');
            // Sync text input
            const sibling = this.parentElement.querySelector('input[type=text]');
            if (sibling) sibling.value = this.value;
            // Update preview
            if (name.includes('primary_color')) {
                document.getElementById('preview-primary').style.background = this.value;
            }
            if (name.includes('secondary_color')) {
                document.getElementById('preview-secondary').style.background = this.value;
            }
        });
    });
</script>
@endsection