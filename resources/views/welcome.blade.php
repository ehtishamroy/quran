<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $getSetting('site_name') ?? 'Suffa Islamic Center' }}</title>
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        colors: {
                            primary: '#084D3C',
                            secondary: '#DB9E30',
                            accent: '#F3F4F6'
                        },
                        fontFamily: {
                            sans: ['Inter', 'sans-serif'],
                            serif: ['Playfair Display', 'serif'],
                        }
                    }
                }
            }
        </script>
    @endif
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&display=swap"
        rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <style>
        .pattern-overlay {
            background-color: #084D3C;
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%230b5e49' fill-opacity='0.1'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }

        .hero-pattern {
            background-image: url("data:image/svg+xml,%3Csvg width='20' height='20' viewBox='0 0 20 20' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='%23ffffff' fill-opacity='0.05' fill-rule='evenodd'%3E%3Ccircle cx='3' cy='3' r='3'/%3E%3Ccircle cx='13' cy='13' r='3'/%3E%3C/g%3E%3C/svg%3E");
        }

        .text-shadow {
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }
    </style>
</head>

<body class="font-sans antialiased text-gray-800 bg-gray-50">

    <!-- Top Bar -->
    <div class="bg-primary text-white py-2 text-sm border-b border-green-800 hidden md:block">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center">
            <div class="flex space-x-6">
                @if($phone = $getSetting('contact_phone'))
                    <span class="flex items-center hover:text-secondary transition"><i
                            class="fas fa-phone-alt mr-2 text-secondary"></i> {{ $phone }}</span>
                @endif
                @if($email = $getSetting('contact_email'))
                    <span class="flex items-center hover:text-secondary transition"><i
                            class="fas fa-envelope mr-2 text-secondary"></i> {{ $email }}</span>
                @endif
                <span class="flex items-center"><i class="fas fa-clock mr-2 text-secondary"></i> Mon - Fri: 9:00 -
                    18:00</span>
            </div>
            <div class="flex items-center space-x-4">
                <div class="flex space-x-3 border-r border-green-700 pr-4">
                    @if($fb = $getSetting('social_facebook')) <a href="{{ $fb }}"
                    class="hover:text-secondary transition"><i class="fab fa-facebook-f"></i></a> @endif
                    @if($tw = $getSetting('social_twitter')) <a href="{{ $tw }}"
                    class="hover:text-secondary transition"><i class="fab fa-twitter"></i></a> @endif
                    @if($ig = $getSetting('social_instagram')) <a href="{{ $ig }}"
                    class="hover:text-secondary transition"><i class="fab fa-instagram"></i></a> @endif
                    @if($yt = $getSetting('social_youtube')) <a href="{{ $yt }}"
                    class="hover:text-secondary transition"><i class="fab fa-youtube"></i></a> @endif
                </div>
                <div>
                    @auth
                        <a href="{{ url('/admin/dashboard') }}" class="font-medium hover:text-secondary">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="font-medium hover:text-secondary"><i
                                class="fas fa-user mr-1"></i> Login</a>
                    @endauth
                </div>
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="bg-white shadow-lg sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20">
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="flex-shrink-0 flex items-center gap-3">
                        @if($logo = $getSetting('site_logo'))
                            <img class="h-14 w-auto" src="{{ asset('storage/' . $logo) }}" alt="Logo">
                        @else
                            <!-- Fallback Logo Icon -->
                            <div
                                class="w-10 h-10 bg-primary rounded-full flex items-center justify-center text-white text-xl">
                                <i class="fas fa-quran"></i>
                            </div>
                            <div>
                                <h1 class="text-2xl font-serif font-bold text-primary leading-none">Suffa</h1>
                                <span class="text-xs text-secondary font-medium tracking-wider uppercase">Islamic
                                    Center</span>
                            </div>
                        @endif
                    </a>
                </div>

                <!-- Desktop Menu -->
                <div class="hidden lg:flex items-center space-x-8">
                    <a href="{{ route('home') }}"
                        class="text-gray-800 hover:text-primary font-medium text-sm uppercase tracking-wide transition">Home</a>
                    <a href="#about"
                        class="text-gray-800 hover:text-primary font-medium text-sm uppercase tracking-wide transition">About</a>
                    <a href="{{ route('courses.index') }}"
                        class="text-gray-800 hover:text-primary font-medium text-sm uppercase tracking-wide transition">Courses</a>
                    <a href="#teachers"
                        class="text-gray-800 hover:text-primary font-medium text-sm uppercase tracking-wide transition">Teachers</a>
                    <a href="{{ route('blog.index') }}"
                        class="text-gray-800 hover:text-primary font-medium text-sm uppercase tracking-wide transition">Blog</a>
                    <a href="#contact"
                        class="bg-primary text-white px-6 py-2.5 rounded-full font-bold shadow-md hover:bg-green-800 transition transform hover:-translate-y-0.5">
                        Contact Us
                    </a>
                </div>

                <!-- Mobile menu button -->
                <div class="lg:hidden flex items-center">
                    <button
                        class="text-gray-700 hover:text-primary focus:outline-none p-2 border border-gray-200 rounded">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                </div>
            </div>
        </div>
    <!-- Alpine.js -->
    <script src="//unpkg.com/alpinejs" defer></script>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="relative bg-primary overflow-hidden min-h-[600px] flex items-center">
        <!-- Background Pattern/Image -->
        <div class="absolute inset-0 pattern-overlay opacity-50"></div>
        <div class="absolute inset-0 bg-gradient-to-r from-primary via-primary/90 to-transparent"></div>

        <!-- Decoration Geometric Shapes -->
        <div class="absolute top-0 right-0 -mt-20 -mr-20 w-80 h-80 bg-secondary opacity-10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 -mb-20 -ml-20 w-60 h-60 bg-white opacity-5 rounded-full blur-3xl"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 w-full">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                <div class="text-white space-y-6 slide-in-left">
                    <div
                        class="inline-flex items-center space-x-2 bg-white/10 px-4 py-2 rounded-full border border-white/20">
                        <span class="w-2 h-2 bg-secondary rounded-full animate-pulse"></span>
                        <span class="text-sm font-medium tracking-wider uppercase text-secondary">Start Your Journey
                            Today</span>
                    </div>

                    <h1 class="text-5xl md:text-6xl font-serif font-bold leading-tight text-shadow">
                        {{ $getSetting('home_hero[hero_title]') ?? 'Seek Knowledge' }} <br>
                        <span class="text-secondary">{{ $getSetting('home_hero[hero_highlight]') ?? 'From The Cradle' }}</span> <br>
                        {{ $getSetting('home_hero[hero_subtitle]') ?? 'To The Grave' }}
                    </h1>

                    <p class="text-lg text-gray-200 max-w-lg leading-relaxed">
                        {{ $getSetting('home_hero[hero_description]') ?? 'Join thousands of students worldwide learning Quran, Tajweed, and Islamic Studies from certified tutors.' }}
                    </p>

                    <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4 pt-4">
                        <a href="#courses"
                            class="bg-secondary text-white px-8 py-4 rounded-lg font-bold text-lg hover:bg-yellow-600 transition shadow-lg text-center flex items-center justify-center">
                            Explore Courses <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                        <a href="#contact"
                            class="border border-white/30 text-white bg-white/5 backdrop-blur-sm px-8 py-4 rounded-lg font-bold text-lg hover:bg-white hover:text-primary transition text-center">
                            Free Evaluation
                        </a>
                    </div>

                    <div class="flex items-center space-x-6 pt-4 text-sm text-gray-300">
                        <div class="flex items-center"><i class="fas fa-check-circle text-secondary mr-2"></i> Certified
                            Teachers</div>
                        <div class="flex items-center"><i class="fas fa-check-circle text-secondary mr-2"></i> 24/7
                            Support</div>
                    </div>
                </div>

                <!-- Hero Image/Graphic -->
                <div class="hidden md:flex justify-end relative">
                    <div class="relative w-96 h-96 lg:w-[500px] lg:h-[500px]">
                        <!-- Decorative Border -->
                        <div
                            class="absolute inset-0 border-2 border-secondary/30 rounded-full transform rotate-12 scale-105">
                        </div>
                        <div
                            class="absolute inset-0 border-2 border-white/10 rounded-full transform -rotate-12 scale-105">
                        </div>

                        <!-- Main Circle Image Area -->
                        <div
                            class="absolute inset-4 bg-primary rounded-full overflow-hidden border-4 border-secondary shadow-2xl flex items-center justify-center relative">
                            <!-- Overlay Pattern -->
                            <div class="absolute inset-0 hero-pattern opacity-30"></div>

                            <!-- Content inside circle -->
                            <div class="text-center p-8 relative z-10">
                                <i class="fas fa-quran text-8xl text-secondary mb-4 opacity-80"></i>
                                <h3 class="text-2xl font-serif text-white mb-2">Read. Recite. Rise.</h3>
                                <p class="text-green-100 text-sm">"The best of you are those who learn the Quran and
                                    teach it."</p>
                            </div>

                            <!-- Floating Badges -->
                            <div
                                class="absolute top-10 left-10 bg-white text-primary p-3 rounded-xl shadow-lg animate-bounce duration-[3000ms]">
                                <i class="fas fa-star text-secondary"></i> 4.9 Rating
                            </div>
                            <div
                                class="absolute bottom-10 right-10 bg-white text-primary p-3 rounded-xl shadow-lg animate-bounce duration-[4000ms]">
                                <i class="fas fa-users text-secondary"></i> 5k+ Students
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bottom Curve/Wave -->
        <div class="absolute bottom-0 left-0 w-full leading-none text-gray-50">
            <svg class="block w-full h-12 md:h-24" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120"
                preserveAspectRatio="none">
                <path
                    d="M985.66,92.83C906.67,72,823.78,31,743.84,14.19c-82.26-17.34-168.06-16.33-250.45.39-57.84,11.73-114,31.07-172,41.86A600.21,600.21,0,0,1,0,27.35V120H1200V95.8C1132.19,118.92,1055.71,111.31,985.66,92.83Z"
                    fill="currentColor"></path>
            </svg>
        </div>
    </section>

    <!-- Features / Services Section (Overlapping) -->
    <section class="relative -mt-24 z-20 pb-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Feature 1 -->
                <div class="bg-white p-8 rounded-xl shadow-xl border-b-4 border-secondary hover:-translate-y-2 transition duration-300 group">
                    <div class="w-16 h-16 bg-green-50 rounded-full flex items-center justify-center mb-6 group-hover:bg-primary transition duration-300">
                        <i class="fas fa-quran text-3xl text-primary group-hover:text-white transition duration-300"></i>
                    </div>
                    <h3 class="text-xl font-bold text-primary mb-3 font-serif">Quran Recitation</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">
                        Learn to recite the Quran with proper Tajweed rules from qualified tutors.
                    </p>
                </div>

                <!-- Feature 2 -->
                <div class="bg-white p-8 rounded-xl shadow-xl border-b-4 border-primary hover:-translate-y-2 transition duration-300 group">
                    <div class="w-16 h-16 bg-yellow-50 rounded-full flex items-center justify-center mb-6 group-hover:bg-secondary transition duration-300">
                        <i class="fas fa-brain text-3xl text-secondary group-hover:text-white transition duration-300"></i>
                    </div>
                    <h3 class="text-xl font-bold text-primary mb-3 font-serif">Hifz Program</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">
                        Comprehensive memorization courses for kids and adults with regular revision.
                    </p>
                </div>

                <!-- Feature 3 -->
                <div class="bg-white p-8 rounded-xl shadow-xl border-b-4 border-secondary hover:-translate-y-2 transition duration-300 group">
                    <div class="w-16 h-16 bg-green-50 rounded-full flex items-center justify-center mb-6 group-hover:bg-primary transition duration-300">
                         <i class="fas fa-language text-3xl text-primary group-hover:text-white transition duration-300"></i>
                    </div>
                    <h3 class="text-xl font-bold text-primary mb-3 font-serif">Arabic Language</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">
                        Master the language of the Quran, from basic alphabets to advanced grammar.
                    </p>
                </div>

                <!-- Feature 4 -->
                <div class="bg-white p-8 rounded-xl shadow-xl border-b-4 border-primary hover:-translate-y-2 transition duration-300 group">
                    <div class="w-16 h-16 bg-yellow-50 rounded-full flex items-center justify-center mb-6 group-hover:bg-secondary transition duration-300">
                         <i class="fas fa-praying-hands text-3xl text-secondary group-hover:text-white transition duration-300"></i>
                    </div>
                    <h3 class="text-xl font-bold text-primary mb-3 font-serif">Islamic Studies</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">
                        Learn Seerah, Fiqh, Aqeedah, and daily Duas to enrich your Islamic lifestyle.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-20 bg-white relative overflow-hidden">
        <div class="absolute top-0 right-0 opacity-5 pointer-events-none">
            <i class="fas fa-mosque text-[400px] text-primary transform translate-x-1/2 -translate-y-1/2"></i>
        </div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <!-- Image Grid -->
                <div class="relative">
                    <div class="relative z-10 rounded-2xl overflow-hidden shadow-2xl border-8 border-white">
                        <img src="https://images.unsplash.com/photo-1609599006353-e629797055af?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Islamic Center" class="w-full h-auto">
                    </div>
                    <!-- Decorative Frame -->
                    <div class="absolute top-10 left-10 w-full h-full border-4 border-secondary rounded-2xl -z-0"></div>
                </div>

                <!-- Text Content -->
                <div>
                    <h4 class="text-secondary font-bold uppercase tracking-widest text-sm mb-2">About Us</h4>
                    <h2 class="text-4xl md:text-5xl font-serif font-bold text-primary mb-6 leading-tight">
                        Welcome to <br> <span class="text-secondary">{{ $getSetting('about_us[about_title_highlight]') ?? 'Suffa Islamic Center' }}</span>
                    </h2>
                    <p class="text-gray-600 text-lg mb-6 leading-relaxed whitespace-pre-line">
                        {{ $getSetting('about_us[about_description]') ?? 'We are dedicated to spreading the light of the Quran and Sunnah. Our mission is to provide accessible, high-quality Islamic education to students of all ages across the globe.' }}
                    </p>
                    
                    <ul class="space-y-4 mb-8">
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-primary mt-1 mr-3 text-xl"></i>
                            <div>
                                <h5 class="font-bold text-gray-800">Qualified Tutors</h5>
                                <p class="text-sm text-gray-500">Ijazah certified teachers from Al-Azhar.</p>
                            </div>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-primary mt-1 mr-3 text-xl"></i>
                             <div>
                                <h5 class="font-bold text-gray-800">One-on-One Classes</h5>
                                <p class="text-sm text-gray-500">Personalized attention for every student.</p>
                            </div>
                        </li>
                         <li class="flex items-start">
                            <i class="fas fa-check-circle text-primary mt-1 mr-3 text-xl"></i>
                             <div>
                                <h5 class="font-bold text-gray-800">Flexible Timing</h5>
                                <p class="text-sm text-gray-500">Classes available 24/7 to suit your schedule.</p>
                            </div>
                        </li>
                    </ul>

                    <a href="#about" class="inline-flex items-center text-primary font-bold hover:text-secondary transition text-lg">
                        Learn More About Us <i class="fas fa-long-arrow-alt-right ml-2 text-2xl text-secondary"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Packages / Courses Section -->
    <section id="courses" class="py-24 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 max-w-2xl mx-auto">
                <h4 class="text-secondary font-bold uppercase tracking-widest text-sm mb-2">Our Courses</h4>
                <h2 class="text-4xl font-serif font-bold text-primary mb-6">Popular Islamic Courses</h2>
                 <div class="w-24 h-1 bg-secondary mx-auto rounded mb-6"></div>
                <p class="text-gray-600">
                    Choose from a variety of courses designed to help you and your family grow in faith and knowledge.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($packages as $package)
                    <div class="bg-white rounded-2xl shadow-lg overflow-hidden group hover:shadow-2xl transition duration-300 border border-gray-100 flex flex-col">
                        <!-- Card Header / Image placeholder -->


                        <!-- Card Body -->
                        <div class="p-8 flex-grow">
                             @if($package->is_popular)
                                <span class="bg-secondary text-white text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wide mb-4 inline-block">Most Popular</span>
                            @endif
                             <div class="flex items-center text-sm text-gray-500 mb-3">
                                <i class="fas fa-star text-yellow-400 mr-1"></i>
                                <i class="fas fa-star text-yellow-400 mr-1"></i>
                                <i class="fas fa-star text-yellow-400 mr-1"></i>
                                <i class="fas fa-star text-yellow-400 mr-1"></i>
                                <i class="fas fa-star text-yellow-400 mr-1"></i>
                                <span class="ml-2">(5.0)</span>
                            </div>

                            <h3 class="text-2xl font-bold text-gray-800 mb-4 group-hover:text-primary transition font-serif">{{ $package->title }}</h3>

                            <p class="text-gray-600 mb-6 text-sm line-clamp-2">{{ $package->description }}</p>

                            <div class="space-y-2 mb-6 border-t border-gray-100 pt-4">
                               <div class="flex justify-between text-sm text-gray-600">
                                   <span><i class="fas fa-calendar-alt text-secondary mr-2"></i> Classes:</span>
                                   <span class="font-bold">{{ $package->days_per_week }} Days/Week</span>
                               </div>
                               <div class="flex justify-between text-sm text-gray-600">
                                   <span><i class="fas fa-globe text-secondary mr-2"></i> Mode:</span>
                                   <span class="font-bold">Online</span>
                               </div>
                               <div class="flex justify-between text-sm text-gray-600">
                                   <span><i class="far fa-clock text-secondary mr-2"></i> Duration:</span>
                                   <span class="font-bold">{{ $package->duration_minutes }} Mins/Class</span>
                               </div>
                            </div>
                        </div>

                        <!-- Card Footer -->
                        <div class="px-8 pb-8 mt-auto">
                            <div class="flex items-center justify-between mb-4">
                                <div>
                                    <span class="text-xs text-gray-500 block">Monthly Fee</span>
                                    <span class="text-2xl font-bold text-primary">{{ $package->currency }} {{ $package->price }}</span>
                                </div>
                            </div>
                            <a href="{{ route('courses.show', $package->slug) }}" 
                               class="block w-full bg-primary text-white text-center py-3 rounded-xl font-bold hover:bg-green-900 transition shadow-lg group-hover:shadow-green-900/30">
                                View Course Details
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Counters / Stats Section -->
    <section class="py-20 bg-primary relative bg-fixed bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1519817650390-64a93db51149?ixlib=rb-1.2.1&auto=format&fit=crop&w=1500&q=80');">
        <div class="absolute inset-0 bg-primary/90"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center text-white">
                <div>
                     <div class="text-4xl font-bold mb-2 font-serif text-secondary">500+</div>
                     <div class="text-green-100 uppercase tracking-wider text-sm">Students</div>
                </div>
                <div>
                     <div class="text-4xl font-bold mb-2 font-serif text-secondary">50+</div>
                     <div class="text-green-100 uppercase tracking-wider text-sm">Expert Tutors</div>
                </div>
                 <div>
                     <div class="text-4xl font-bold mb-2 font-serif text-secondary">100%</div>
                     <div class="text-green-100 uppercase tracking-wider text-sm">Satisfaction</div>
                </div>
                 <div>
                     <div class="text-4xl font-bold mb-2 font-serif text-secondary">24/7</div>
                     <div class="text-green-100 uppercase tracking-wider text-sm">Support</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Special Bonuses Section -->
    <section class="py-20 bg-amber-50 relative overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-secondary to-yellow-200"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                 <h4 class="text-secondary font-bold uppercase tracking-widest text-sm mb-2">Exclusive Offers</h4>
                 <h2 class="text-3xl font-serif font-bold text-primary mb-4">Special Bonuses for You</h2>
                 <div class="w-24 h-1 bg-secondary mx-auto rounded"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                 <!-- Family Plan -->
                 <div class="bg-white rounded-2xl shadow-lg p-8 border-l-8 border-blue-500 relative overflow-hidden group hover:shadow-2xl transition">
                     <div class="absolute -right-10 -top-10 bg-blue-50 w-32 h-32 rounded-full group-hover:scale-150 transition duration-700"></div>
                     <div class="relative z-10 flex items-start">
                         <div class="bg-blue-100 p-4 rounded-full mr-6">
                             <i class="fas fa-users text-3xl text-blue-600"></i>
                         </div>
                         <div>
                             <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $familyPackage->title ?? 'Family Group Classes' }}</h3>
                             <p class="text-gray-600 mb-4 text-sm">{{ $familyPackage->description ?? 'Enroll 3+ Family Members and pay a discounted rate.' }}</p>
                             <div class="flex items-center space-x-4 mb-4">
                                 <span class="bg-blue-600 text-white px-3 py-1 rounded-full text-xs font-bold">{{ $familyPackage->days_per_week ?? 5 }} Days/Week</span>
                                 <span class="text-2xl font-bold text-blue-600">{{ $familyPackage->currency ?? '£' }}{{ $familyPackage->price ?? 100 }}<span class="text-sm font-normal text-gray-500">/mo</span></span>
                             </div>
                             <a href="#contact" onclick="document.getElementById('package_select').value='{{ $familyPackage->id ?? '' }}'" class="text-blue-600 font-bold text-sm hover:underline">Enroll Family Now <i class="fas fa-arrow-right ml-1"></i></a>
                         </div>
                     </div>
                 </div>

                 <!-- Bonus / Discount Plan -->
                 <div class="bg-white rounded-2xl shadow-lg p-8 border-l-8 border-secondary relative overflow-hidden group hover:shadow-2xl transition">
                     <div class="absolute -right-10 -top-10 bg-yellow-50 w-32 h-32 rounded-full group-hover:scale-150 transition duration-700"></div>
                     <div class="relative z-10 flex items-start">
                         <div class="bg-yellow-100 p-4 rounded-full mr-6">
                             <i class="fas fa-child text-3xl text-secondary"></i>
                         </div>
                         <div>
                             <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $bonusPackage->title ?? 'Grandparent Discount' }}</h3>
                             <p class="text-gray-600 mb-4 text-sm">{{ $bonusPackage->description ?? 'Special discount for grandparents joining with family.' }}</p>
                             <div class="flex items-center space-x-4 mb-4">
                                 <span class="bg-secondary text-white px-3 py-1 rounded-full text-xs font-bold">Limited Offer</span>
                                 <span class="text-2xl font-bold text-secondary">{{ $bonusPackage->currency ?? '£' }}{{ $bonusPackage->price ?? 40 }}<span class="text-sm font-normal text-gray-500">/mo</span></span>
                             </div>
                             <a href="#contact" onclick="document.getElementById('package_select').value='{{ $bonusPackage->id ?? '' }}'" class="text-secondary font-bold text-sm hover:underline">Claim Discount <i class="fas fa-arrow-right ml-1"></i></a>
                         </div>
                     </div>
                 </div>
            </div>
        </div>
    </section>

    <!-- Team Section -->
    <section id="teachers" class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
             <div class="text-center mb-16 max-w-2xl mx-auto">
                <h4 class="text-secondary font-bold uppercase tracking-widest text-sm mb-2">Our Guides</h4>
                <h2 class="text-4xl font-serif font-bold text-primary mb-6">Expert Islamic Scholars</h2>
                 <div class="w-24 h-1 bg-secondary mx-auto rounded mb-6"></div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach($teamMembers as $member)
                    <div class="bg-white rounded-xl overflow-hidden text-center group cursor-pointer hover:shadow-xl transition transform hover:-translate-y-1" onclick="openTeacherModal(@js($member))">
                        <div class="h-64 w-full bg-gray-100 overflow-hidden relative">
                            @if($member->image_path)
                                <img src="{{ asset('storage/' . $member->image_path) }}" alt="{{ $member->name }}" class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition duration-500">
                            @else
                                <div class="flex items-center justify-center h-full bg-green-50 text-primary">
                                    <i class="fas fa-user text-6xl opacity-20"></i>
                                </div>
                            @endif
                            
                            <!-- View Profile Overlay -->
                            <div class="absolute inset-0 bg-primary/60 opacity-0 group-hover:opacity-100 transition duration-300 flex items-center justify-center">
                                <span class="text-white font-bold border border-white px-4 py-2 rounded-full hover:bg-white hover:text-primary transition">View Profile</span>
                            </div>
                        </div>
                        <div class="p-6 border border-t-0 border-gray-100 rounded-b-xl shadow-sm">
                            <h3 class="text-lg font-bold text-gray-900 group-hover:text-primary transition">{{ $member->name }}</h3>
                            <p class="text-secondary font-medium text-sm">{{ $member->role }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        
        <!-- Teacher Modal -->
        <div id="teacherModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <!-- Background overlay -->
                <div class="fixed inset-0 bg-gray-900 bg-opacity-75 transition-opacity" aria-hidden="true" onclick="closeTeacherModal()"></div>
        
                <!-- Modal panel -->
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg w-full">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                                <div class="flex justify-between items-center mb-4">
                                    <h3 class="text-2xl leading-6 font-bold text-primary font-serif" id="modal-name">Teacher Name</h3>
                                    <button onclick="closeTeacherModal()" class="text-gray-400 hover:text-gray-500">
                                        <span class="sr-only">Close</span>
                                        <i class="fas fa-times text-xl"></i>
                                    </button>
                                </div>
                                <div class="mt-2 text-center">
                                    <img id="modal-image" src="" alt="" class="w-32 h-32 rounded-full object-cover mx-auto mb-4 border-4 border-secondary">
                                    <p id="modal-role" class="text-secondary font-bold uppercase tracking-wide text-sm mb-4">Role</p>
                                    <p id="modal-bio" class="text-gray-600 text-sm mb-6 leading-relaxed">Bio description...</p>
                                    
                                    <div class="flex justify-center space-x-4 border-t pt-4" id="modal-socials">
                                        <!-- Social icons injected here -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            function openTeacherModal(member) {
                document.getElementById('modal-name').textContent = member.name;
                document.getElementById('modal-role').textContent = member.role;
                document.getElementById('modal-bio').textContent = member.bio || 'No bio available.';
                
                const img = document.getElementById('modal-image');
                if (member.image_path) {
                    img.src = '/storage/' + member.image_path;
                    img.style.display = 'block';
                } else {
                    img.style.display = 'none';
                }
                
                const socialContainer = document.getElementById('modal-socials');
                socialContainer.innerHTML = '';
                
                if (member.social_links) {
                    const links = typeof member.social_links === 'string' ? JSON.parse(member.social_links) : member.social_links;
                    
                    if (links.facebook) {
                        socialContainer.innerHTML += `<a href="${links.facebook}" target="_blank" class="text-blue-600 hover:text-blue-800 text-2xl"><i class="fab fa-facebook"></i></a>`;
                    }
                    if (links.twitter) {
                        socialContainer.innerHTML += `<a href="${links.twitter}" target="_blank" class="text-blue-400 hover:text-blue-600 text-2xl"><i class="fab fa-twitter"></i></a>`;
                    }
                    if (links.instagram) {
                        socialContainer.innerHTML += `<a href="${links.instagram}" target="_blank" class="text-pink-600 hover:text-pink-800 text-2xl"><i class="fab fa-instagram"></i></a>`;
                    }
                }
                
                document.getElementById('teacherModal').classList.remove('hidden');
            }
            
            function closeTeacherModal() {
                document.getElementById('teacherModal').classList.add('hidden');
            }
        </script>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                 <h2 class="text-3xl font-serif font-bold text-primary mb-4">What Our Students Say</h2>
                 <div class="w-24 h-1 bg-secondary mx-auto rounded"></div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white p-8 rounded-2xl shadow-lg relative">
                    <i class="fas fa-quote-right text-4xl text-gray-100 absolute top-4 right-4"></i>
                    <div class="flex text-yellow-400 mb-4">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                    </div>
                    <p class="text-gray-600 italic mb-6">"Alhamdulillah, my son has improved his Tajweed significantly. The teachers are very patient and knowledgeable."</p>
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-primary rounded-full flex items-center justify-center text-white font-bold mr-3">A</div>
                        <div>
                            <h4 class="font-bold text-gray-900">Ahmed Khan</h4>
                            <p class="text-xs text-gray-500">Parent, USA</p>
                        </div>
                    </div>
                </div>
                 <div class="bg-white p-8 rounded-2xl shadow-lg relative">
                    <i class="fas fa-quote-right text-4xl text-gray-100 absolute top-4 right-4"></i>
                    <div class="flex text-yellow-400 mb-4">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                    </div>
                    <p class="text-gray-600 italic mb-6">"The flexible schedule is a blessing. I can learn Quran from home without disturbing my work routine."</p>
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-secondary rounded-full flex items-center justify-center text-white font-bold mr-3">S</div>
                        <div>
                            <h4 class="font-bold text-gray-900">Sarah Ali</h4>
                            <p class="text-xs text-gray-500">Student, UK</p>
                        </div>
                    </div>
                </div>
                 <div class="bg-white p-8 rounded-2xl shadow-lg relative">
                    <i class="fas fa-quote-right text-4xl text-gray-100 absolute top-4 right-4"></i>
                    <div class="flex text-yellow-400 mb-4">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                    </div>
                    <p class="text-gray-600 italic mb-6">"Highly recommended for anyone looking for authentic Islamic education online. Great platform!"</p>
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-primary rounded-full flex items-center justify-center text-white font-bold mr-3">M</div>
                        <div>
                            <h4 class="font-bold text-gray-900">Mohammed Z.</h4>
                            <p class="text-xs text-gray-500">Student, Canada</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA / Contact Form Section -->
    <section id="contact" class="py-20 bg-primary relative overflow-hidden">
        <!-- Background Decor -->
        <i class="fas fa-quran text-[400px] text-white opacity-5 absolute -right-20 top-1/2 transform -translate-y-1/2 pointer-events-none"></i>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16">
                <div class="text-white">
                    <h4 class="text-secondary font-bold uppercase tracking-widest text-sm mb-2">Join Us Now</h4>
                    <h2 class="text-4xl md:text-5xl font-serif font-bold mb-6">Start Your Free <br> <span class="text-secondary">Trial Class</span> Today</h2>
                    <p class="text-green-100 text-lg mb-8">
                        Experience our high-quality teaching with a free trial class. No credit card required. Fill out the form and we will contact you shortly.
                    </p>
                    
                    <div class="space-y-6">
                        @if($phone = $getSetting('contact_phone'))
                            <div class="flex items-center bg-white/10 p-4 rounded-xl border border-white/10">
                                <div class="w-12 h-12 bg-secondary rounded-full flex items-center justify-center text-white text-xl mr-4 flex-shrink-0">
                                    <i class="fas fa-phone-alt"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold text-lg">Call Us</h4>
                                    <p class="text-green-100">{{ $phone }}</p>
                                </div>
                            </div>
                        @endif

                        @if($whatsapp = $getSetting('whatsapp_number'))
                            <div class="flex items-center bg-white/10 p-4 rounded-xl border border-white/10">
                                <div class="w-12 h-12 bg-green-500 rounded-full flex items-center justify-center text-white text-xl mr-4 flex-shrink-0">
                                    <i class="fab fa-whatsapp"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold text-lg">WhatsApp</h4>
                                    <p class="text-green-100">{{ $whatsapp }}</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="bg-white p-8 md:p-10 rounded-2xl shadow-2xl">
                    <h3 class="text-2xl font-bold text-gray-800 mb-6">Book Your Free Trial</h3>
                    @if(session('success'))
                        <div x-data="{ open: true }" x-init="setTimeout(() => open = false, 5000)" x-show="open" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
                                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                                <div class="inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-sm w-full sm:p-6">
                                    <div>
                                        <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-green-100">
                                            <i class="fas fa-check text-green-600 text-xl"></i>
                                        </div>
                                        <div class="mt-3 text-center sm:mt-5">
                                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Enquiry Sent!</h3>
                                            <div class="mt-2">
                                                <p class="text-sm text-gray-500">{{ session('success') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-5 sm:mt-6">
                                        <button type="button" @click="open = false" class="inline-flex justify-center w-full rounded-md border border-transparent shadow-sm px-4 py-2 bg-primary text-base font-medium text-white hover:bg-green-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:text-sm">
                                            OK
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    <form action="{{ route('enquiry.submit') }}" method="POST">
                        @csrf
                        <div class="space-y-4">
                            <div>
                                <label class="block text-gray-700 font-medium mb-1 text-sm">Full Name</label>
                                <input type="text" name="name" required class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition">
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-gray-700 font-medium mb-1 text-sm">Email Address</label>
                                    <input type="email" name="email" required class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition">
                                </div>
                                <div>
                                    <label class="block text-gray-700 font-medium mb-1 text-sm">Phone Number</label>
                                    <input type="tel" name="phone" required class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition">
                                </div>
                            </div>
                            <div>
                                <label class="block text-gray-700 font-medium mb-1 text-sm">Interested Course</label>
                                <select name="package_id" id="package_select" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition">
                                    <option value="">-- Select a Course --</option>
                                    @foreach($packages as $package)
                                        <option value="{{ $package->id }}">{{ $package->title }} ({{ $package->currency }} {{ $package->price }})</option>
                                    @endforeach
                                    <option value="">Other / General Inquiry</option>
                                </select>
                            </div>
                             <div>
                                <label class="block text-gray-700 font-medium mb-1 text-sm">Message (Optional)</label>
                                <textarea name="message" rows="3" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition"></textarea>
                            </div>
                            <button type="submit" class="w-full bg-secondary text-white font-bold py-4 rounded-xl hover:bg-yellow-600 transition shadow-lg mt-2 uppercase tracking-wide">
                                Submit Enquiry
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Blog Preview Section -->
    @if($recentPosts->count() > 0)
        <section class="py-20 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-end mb-12">
                    <div>
                         <h4 class="text-secondary font-bold uppercase tracking-widest text-sm mb-2">Our Blog</h4>
                         <h2 class="text-3xl font-serif font-bold text-primary">Latest News & Articles</h2>
                    </div>
                    <a href="{{ route('blog.index') }}" class="text-primary font-bold hover:text-secondary transition flex items-center">View All <i class="fas fa-arrow-right ml-2"></i></a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @foreach($recentPosts as $post)
                        <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition group">
                            <a href="{{ route('blog.show', $post->slug) }}" class="block h-56 bg-gray-200 overflow-hidden relative">
                                 @if($post->image_path)
                                    <img src="{{ asset('storage/' . $post->image_path) }}" alt="{{ $post->title }}" class="w-full h-full object-cover transform group-hover:scale-110 transition duration-700">
                                @else
                                    <div class="flex items-center justify-center h-full bg-green-50 text-green-200">
                                        <i class="fas fa-image text-5xl"></i>
                                    </div>
                                @endif
                                <div class="absolute bottom-4 right-4 bg-white text-primary text-xs font-bold px-3 py-1 rounded shadow-sm">
                                    {{ $post->created_at->format('M d, Y') }}
                                </div>
                            </a>
                            <div class="p-6">
                                <h3 class="text-xl font-bold text-gray-900 mb-3 leading-tight">
                                    <a href="{{ route('blog.show', $post->slug) }}" class="group-hover:text-primary transition">{{ $post->title }}</a>
                                </h3>
                                <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                                    {{ Str::limit(strip_tags($post->content), 100) }}
                                </p>
                                <a href="{{ route('blog.show', $post->slug) }}" class="text-secondary font-semibold text-sm hover:underline uppercase tracking-wide">Read Details</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- Footer -->
    <footer class="bg-primary text-white pt-20 pb-10 border-t-8 border-secondary relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-16">
                <!-- Branding -->
                <div>
                     <div class="flex items-center gap-3 mb-6">
                         <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center text-primary text-xl">
                            <i class="fas fa-quran"></i>
                        </div>
                        <h2 class="text-2xl font-serif font-bold text-white">Suffa Center</h2>
                    </div>
                     <p class="text-green-100 text-sm leading-relaxed mb-6">
                        We are a leading online Islamic institute providing Quran, Hifz, and Arabic classes for students of all ages worldwide.
                     </p>
                     <div class="flex space-x-4">
                         @if($fb = $getSetting('social_facebook')) <a href="{{ $fb }}" class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center hover:bg-secondary transition"><i class="fab fa-facebook-f"></i></a> @endif
                         @if($ig = $getSetting('social_instagram')) <a href="{{ $ig }}" class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center hover:bg-secondary transition"><i class="fab fa-instagram"></i></a> @endif
                         @if($tw = $getSetting('social_twitter')) <a href="{{ $tw }}" class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center hover:bg-secondary transition"><i class="fab fa-twitter"></i></a> @endif
                         @if($yt = $getSetting('social_youtube')) <a href="{{ $yt }}" class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center hover:bg-secondary transition"><i class="fab fa-youtube"></i></a> @endif
                     </div>
                </div>

                <!-- Quick Links -->
                <div>
                     <h3 class="text-lg font-bold text-white mb-6 font-serif">Quick Links</h3>
                     <ul class="space-y-3 text-green-100 text-sm">
                         <li><a href="#home" class="hover:text-secondary transition flex items-center"><i class="fas fa-angle-right mr-2 text-secondary"></i> Home</a></li>
                         <li><a href="#about" class="hover:text-secondary transition flex items-center"><i class="fas fa-angle-right mr-2 text-secondary"></i> About Us</a></li>
                         <li><a href="#courses" class="hover:text-secondary transition flex items-center"><i class="fas fa-angle-right mr-2 text-secondary"></i> Our Courses</a></li>
                         <li><a href="#doctors" class="hover:text-secondary transition flex items-center"><i class="fas fa-angle-right mr-2 text-secondary"></i> Our Teachers</a></li>
                         <li><a href="{{ route('blog.index') }}" class="hover:text-secondary transition flex items-center"><i class="fas fa-angle-right mr-2 text-secondary"></i> Latest News</a></li>

                     </ul>
                </div>

                <!-- Courses -->
                <div>
                     <h3 class="text-lg font-bold text-white mb-6 font-serif">Our Courses</h3>
                     <ul class="space-y-3 text-green-100 text-sm">
                        @foreach($packages->take(4) as $package)
                            <li><a href="#courses" class="hover:text-secondary transition flex items-center"><i class="fas fa-angle-right mr-2 text-secondary"></i> {{ $package->title }}</a></li>
                        @endforeach
                     </ul>
                </div>

                <!-- Contact -->
                <div>
                     <h3 class="text-lg font-bold text-white mb-6 font-serif">Contact Info</h3>
                     <ul class="space-y-4 text-green-100 text-sm">
                         @if($phone = $getSetting('contact_phone'))
                            <li class="flex items-start">
                                <i class="fas fa-phone-alt mt-1 mr-3 text-secondary"></i>
                                <span>{{ $phone }}</span>
                            </li>
                         @endif
                         @if($email = $getSetting('contact_email'))
                            <li class="flex items-start">
                                <i class="fas fa-envelope mt-1 mr-3 text-secondary"></i>
                                <span>{{ $email }}</span>
                            </li>
                         @endif
                         @if($address = $getSetting('contact_address'))
                            <li class="flex items-start">
                                <i class="fas fa-map-marker-alt mt-1 mr-3 text-secondary"></i>
                                <span>{{ $address }}</span>
                            </li>
                         @endif
                     </ul>
                </div>
            </div>

            <!-- Copyright -->
            <div class="border-t border-green-800 pt-8 text-center text-green-200 text-sm flex flex-col md:flex-row justify-between items-center">
                <p>&copy; {{ date('Y') }} Suffa Islamic Center. All Rights Reserved.</p>
                <div class="mt-4 md:mt-0 space-x-4">
                    <a href="#" class="hover:text-white">Privacy Policy</a>
                    <a href="#" class="hover:text-white">Terms of Service</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Floating WhatsApp Button -->
    @if($whatsapp = $getSetting('whatsapp_number'))
        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $whatsapp) }}" target="_blank" class="fixed bottom-6 right-6 bg-green-500 text-white p-4 rounded-full shadow-lg hover:bg-green-600 transition z-50 flex items-center justify-center w-16 h-16 animate-bounce">
            <i class="fab fa-whatsapp text-4xl"></i>
        </a>
    @endif
    <!-- Scripts -->
    <script>
        // Sticky Nav Transition
        window.addEventListener('scroll', function () {
            const nav = document.querySelector('nav');
            if (window.scrollY > 50) {
                nav.classList.add('shadow-md');
            } else {
                nav.classList.remove('shadow-md');
            }
        });
    </script>
</body>

</html>