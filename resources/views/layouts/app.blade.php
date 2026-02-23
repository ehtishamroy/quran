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
                    <a href="{{ route('home') }}#about"
                        class="text-gray-800 hover:text-primary font-medium text-sm uppercase tracking-wide transition">About</a>
                    <a href="{{ route('courses.index') }}"
                        class="text-gray-800 hover:text-primary font-medium text-sm uppercase tracking-wide transition">Courses</a>
                    <a href="{{ route('home') }}#teachers"
                        class="text-gray-800 hover:text-primary font-medium text-sm uppercase tracking-wide transition">Teachers</a>
                    <a href="{{ route('blog.index') }}"
                        class="text-gray-800 hover:text-primary font-medium text-sm uppercase tracking-wide transition">Blog</a>
                    <a href="{{ route('home') }}#contact"
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
    </nav>

    <!-- Main Content -->
    @yield('content')

    <!-- Footer -->
    <footer class="bg-primary text-white pt-20 pb-10 border-t-8 border-secondary relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-16">
                <!-- Branding -->
                <div>
                    <div class="flex items-center gap-3 mb-6">
                        <div
                            class="w-10 h-10 bg-white rounded-full flex items-center justify-center text-primary text-xl">
                            <i class="fas fa-quran"></i>
                        </div>
                        <h2 class="text-2xl font-serif font-bold text-white">Suffa Center</h2>
                    </div>
                    <p class="text-green-100 text-sm leading-relaxed mb-6">
                        We are a leading online Islamic institute providing Quran, Hifz, and Arabic classes for students
                        of all ages worldwide.
                    </p>
                    <div class="flex space-x-4">
                        @if($fb = $getSetting('social_facebook')) <a href="{{ $fb }}"
                            class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center hover:bg-secondary transition"><i
                        class="fab fa-facebook-f"></i></a> @endif
                        @if($ig = $getSetting('social_instagram')) <a href="{{ $ig }}"
                            class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center hover:bg-secondary transition"><i
                        class="fab fa-instagram"></i></a> @endif
                        @if($tw = $getSetting('social_twitter')) <a href="{{ $tw }}"
                            class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center hover:bg-secondary transition"><i
                        class="fab fa-twitter"></i></a> @endif
                        @if($yt = $getSetting('social_youtube')) <a href="{{ $yt }}"
                            class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center hover:bg-secondary transition"><i
                        class="fab fa-youtube"></i></a> @endif
                    </div>
                </div>

                <!-- Quick Links -->
                <div>
                    <h3 class="text-lg font-bold text-white mb-6 font-serif">Quick Links</h3>
                    <ul class="space-y-3 text-green-100 text-sm">
                        <li><a href="{{ route('home') }}" class="hover:text-secondary transition flex items-center"><i
                                    class="fas fa-angle-right mr-2 text-secondary"></i> Home</a></li>
                        <li><a href="{{ route('home') }}#about"
                                class="hover:text-secondary transition flex items-center"><i
                                    class="fas fa-angle-right mr-2 text-secondary"></i> About Us</a></li>
                        <li><a href="{{ route('courses.index') }}"
                                class="hover:text-secondary transition flex items-center"><i
                                    class="fas fa-angle-right mr-2 text-secondary"></i> Our Courses</a></li>
                        <li><a href="{{ route('home') }}#teachers"
                                class="hover:text-secondary transition flex items-center"><i
                                    class="fas fa-angle-right mr-2 text-secondary"></i> Our Teachers</a></li>
                        <li><a href="{{ route('blog.index') }}"
                                class="hover:text-secondary transition flex items-center"><i
                                    class="fas fa-angle-right mr-2 text-secondary"></i> Latest News</a></li>
                        <li><a href="{{ route('login') }}" class="hover:text-secondary transition flex items-center"><i
                                    class="fas fa-angle-right mr-2 text-secondary"></i> Admin Login</a></li>
                    </ul>
                </div>

                <!-- Courses -->
                <div>
                    <h3 class="text-lg font-bold text-white mb-6 font-serif">Our Courses</h3>
                    <ul class="space-y-3 text-green-100 text-sm">
                        <!-- Assuming packages are shared, or distinct check -->
                        @if(isset($packages))
                            @foreach($packages->take(4) as $package)
                                <li><a href="{{ route('courses.index') }}"
                                        class="hover:text-secondary transition flex items-center"><i
                                            class="fas fa-angle-right mr-2 text-secondary"></i> {{ $package->title }}</a></li>
                            @endforeach
                        @endif
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
            <div
                class="border-t border-green-800 pt-8 text-center text-green-200 text-sm flex flex-col md:flex-row justify-between items-center">
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
        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $whatsapp) }}" target="_blank"
            class="fixed bottom-6 right-6 bg-green-500 text-white p-4 rounded-full shadow-lg hover:bg-green-600 transition z-50 flex items-center justify-center w-16 h-16 animate-bounce">
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