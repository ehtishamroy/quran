{{--
    Shared Navbar Partial
    Required variables (passed from controller or set in this file):
    - $getSetting (closure)
    - $menuItems (Collection of MenuItem)
    - $primaryColor (string hex)
    - $secondaryColor (string hex)
--}}
@php
    $primaryColor   = $primaryColor   ?? ($getSetting('theme[primary_color]')   ?? '#084D3C');
    $secondaryColor = $secondaryColor ?? ($getSetting('theme[secondary_color]') ?? '#DB9E30');
@endphp

<!-- Top Bar -->
<div class="bg-primary text-white py-2 text-sm border-b border-green-800 hidden md:block">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center">
        <div class="flex space-x-6">
            @if($phone = $getSetting('contact_phone'))
                <span class="flex items-center hover:text-secondary transition"><i class="fas fa-phone-alt mr-2 text-secondary"></i> {{ $phone }}</span>
            @endif
            @if($email = $getSetting('contact_email'))
                <span class="flex items-center hover:text-secondary transition"><i class="fas fa-envelope mr-2 text-secondary"></i> {{ $email }}</span>
            @endif
            <span class="flex items-center"><i class="fas fa-clock mr-2 text-secondary"></i> Mon - Fri: 9:00 - 18:00</span>
        </div>
        <div class="flex items-center space-x-4">
            <div class="flex space-x-3 border-r border-green-700 pr-4">
                @if($fb = $getSetting('social_facebook')) <a href="{{ $fb }}" class="hover:text-secondary transition"><i class="fab fa-facebook-f"></i></a> @endif
                @if($tw = $getSetting('social_twitter'))  <a href="{{ $tw }}" class="hover:text-secondary transition"><i class="fab fa-twitter"></i></a>   @endif
                @if($ig = $getSetting('social_instagram'))<a href="{{ $ig }}" class="hover:text-secondary transition"><i class="fab fa-instagram"></i></a>  @endif
                @if($yt = $getSetting('social_youtube'))  <a href="{{ $yt }}" class="hover:text-secondary transition"><i class="fab fa-youtube"></i></a>    @endif
            </div>
            <div>
                @auth
                    <a href="{{ url('/admin/dashboard') }}" class="font-medium hover:text-secondary">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="font-medium hover:text-secondary"><i class="fas fa-user mr-1"></i> Login</a>
                @endauth
            </div>
        </div>
    </div>
</div>

<!-- Navigation -->
<nav class="bg-white shadow-lg sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            <!-- Logo -->
            <div class="flex items-center">
                <a href="{{ route('home') }}" class="flex-shrink-0 flex items-center gap-3">
                    @if($logo = $getSetting('general[site_logo]') ?? $getSetting('site_logo'))
                        <img class="h-14 w-auto" src="{{ asset('storage/' . $logo) }}" alt="Logo">
                    @else
                        <div class="w-10 h-10 bg-primary rounded-full flex items-center justify-center text-white text-xl">
                            <i class="fas fa-quran"></i>
                        </div>
                        <div>
                            <h1 class="text-2xl font-serif font-bold text-primary leading-none">Suffa</h1>
                            <span class="text-xs text-secondary font-medium tracking-wider uppercase">Islamic Center</span>
                        </div>
                    @endif
                </a>
            </div>

            <!-- Desktop Menu -->
            <div class="hidden lg:flex items-center space-x-8">
                @if($menuItems->count() > 0)
                    @foreach($menuItems as $menuItem)
                        @if($menuItem->is_button)
                            <a href="{{ $menuItem->url }}" target="{{ $menuItem->target }}"
                                class="bg-primary text-white px-6 py-2.5 rounded-full font-bold shadow-md hover:opacity-90 transition transform hover:-translate-y-0.5">
                                {{ $menuItem->title }}
                            </a>
                        @elseif($menuItem->children->count() > 0)
                            <div class="relative group">
                                <button class="text-gray-800 hover:text-primary font-medium text-sm uppercase tracking-wide transition flex items-center gap-1">
                                    {{ $menuItem->title }}
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                    </svg>
                                </button>
                                <div class="absolute top-full left-0 bg-white shadow-xl rounded-lg py-2 min-w-[180px] hidden group-hover:block z-50">
                                    @foreach($menuItem->children as $child)
                                        <a href="{{ $child->url }}" target="{{ $child->target }}"
                                            class="block px-4 py-2 text-gray-700 hover:bg-gray-50 hover:text-primary text-sm">{{ $child->title }}</a>
                                    @endforeach
                                </div>
                            </div>
                        @else
                            <a href="{{ $menuItem->url }}" target="{{ $menuItem->target }}"
                                class="text-gray-800 hover:text-primary font-medium text-sm uppercase tracking-wide transition">{{ $menuItem->title }}</a>
                        @endif
                    @endforeach
                @else
                    <a href="{{ route('home') }}" class="text-gray-800 hover:text-primary font-medium text-sm uppercase tracking-wide transition">Home</a>
                    <a href="{{ route('home') }}#about" class="text-gray-800 hover:text-primary font-medium text-sm uppercase tracking-wide transition">About</a>
                    <a href="{{ route('courses.index') }}" class="text-gray-800 hover:text-primary font-medium text-sm uppercase tracking-wide transition">Courses</a>
                    <a href="{{ route('home') }}#teachers" class="text-gray-800 hover:text-primary font-medium text-sm uppercase tracking-wide transition">Teachers</a>
                    <a href="{{ route('blog.index') }}" class="text-gray-800 hover:text-primary font-medium text-sm uppercase tracking-wide transition">Blog</a>
                    <a href="{{ route('home') }}#contact" class="bg-primary text-white px-6 py-2.5 rounded-full font-bold shadow-md hover:opacity-90 transition transform hover:-translate-y-0.5">Contact Us</a>
                @endif
            </div>

            <!-- Mobile Menu Button -->
            <div class="lg:hidden flex items-center">
                <button onclick="document.getElementById('mobile-nav').classList.toggle('hidden')"
                    class="text-gray-700 hover:text-primary focus:outline-none p-2 border border-gray-200 rounded">
                    <i class="fas fa-bars text-xl"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-nav" class="hidden lg:hidden border-t border-gray-100 bg-white shadow-md">
        <div class="px-4 py-4 space-y-2">
            @if($menuItems->count() > 0)
                @foreach($menuItems as $menuItem)
                    <a href="{{ $menuItem->url }}" target="{{ $menuItem->target }}"
                        class="{{ $menuItem->is_button ? 'block text-center bg-primary text-white px-4 py-2 rounded-full font-bold' : 'block text-gray-800 hover:text-primary font-medium py-2 border-b border-gray-50' }}">
                        {{ $menuItem->title }}
                    </a>
                    @foreach($menuItem->children as $child)
                        <a href="{{ $child->url }}" target="{{ $child->target }}"
                            class="block text-gray-600 hover:text-primary font-medium py-1.5 pl-4 text-sm border-b border-gray-50">
                            ↳ {{ $child->title }}
                        </a>
                    @endforeach
                @endforeach
            @else
                <a href="{{ route('home') }}" class="block text-gray-800 hover:text-primary font-medium py-2 border-b border-gray-50">Home</a>
                <a href="{{ route('home') }}#about" class="block text-gray-800 hover:text-primary font-medium py-2 border-b border-gray-50">About</a>
                <a href="{{ route('courses.index') }}" class="block text-gray-800 hover:text-primary font-medium py-2 border-b border-gray-50">Courses</a>
                <a href="{{ route('home') }}#teachers" class="block text-gray-800 hover:text-primary font-medium py-2 border-b border-gray-50">Teachers</a>
                <a href="{{ route('blog.index') }}" class="block text-gray-800 hover:text-primary font-medium py-2 border-b border-gray-50">Blog</a>
                <a href="{{ route('home') }}#contact" class="block text-center bg-primary text-white px-4 py-2 rounded-full font-bold mt-2">Contact Us</a>
            @endif
        </div>
    </div>
</nav>
