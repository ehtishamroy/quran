<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog - Suffa Islamic Center</title>
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
    @endif
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-gray-50 font-sans antialiased text-gray-800">

    <!-- Header / Navbar -->
    <nav class="bg-white shadow-md fixed w-full z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20">
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="flex-shrink-0 flex items-center">
                        @if($logo = $getSetting('site_logo'))
                            <img class="h-12 w-auto" src="{{ asset('storage/' . $logo) }}" alt="Suffa Islamic Center">
                        @else
                            <h1 class="text-2xl font-bold text-[#084D3C]">Suffa Islamic Center</h1>
                        @endif
                    </a>
                </div>
                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('home') }}" class="text-gray-700 hover:text-[#084D3C] font-medium">Home</a>
                    <a href="{{ route('home') }}#about" class="text-gray-700 hover:text-[#084D3C] font-medium">About</a>
                    <a href="{{ route('home') }}#packages"
                        class="text-gray-700 hover:text-[#084D3C] font-medium">Courses</a>
                    <a href="{{ route('blog.index') }}"
                        class="text-[#084D3C] font-bold border-b-2 border-[#DB9E30]">Blog</a>
                    <a href="{{ route('home') }}#contact"
                        class="bg-[#DB9E30] text-white px-5 py-2 rounded-full font-bold hover:bg-[#b88628] transition">Contact
                        Us</a>
                </div>
                <!-- Mobile menu button -->
                <div class="md:hidden flex items-center">
                    <a href="{{ route('home') }}" class="text-gray-700 hover:text-[#084D3C]">
                        <i class="fas fa-arrow-left text-xl mr-2"></i> Back
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Header -->
    <header class="bg-[#084D3C] text-white pt-32 pb-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl font-bold mb-4">Our Blog</h1>
            <p class="text-xl text-green-100">Updates, Articles, and Islamic Knowledge</p>
        </div>
    </header>

    <!-- Main Content -->
    <main class="py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @forelse($posts as $post)
                    <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition">
                        <a href="{{ route('blog.show', $post->slug) }}" class="block h-56 bg-gray-200 overflow-hidden">
                            @if($post->image_path)
                                <img src="{{ asset('storage/' . $post->image_path) }}" alt="{{ $post->title }}"
                                    class="w-full h-full object-cover transform hover:scale-105 transition duration-500">
                            @else
                                <div class="flex items-center justify-center h-full bg-green-50 text-green-200">
                                    <i class="fas fa-image text-5xl"></i>
                                </div>
                            @endif
                        </a>
                        <div class="p-6">
                            <div class="flex items-center text-xs text-gray-500 mb-2">
                                <span
                                    class="text-[#DB9E30] font-bold uppercase tracking-wide mr-2">{{ $post->created_at->format('M d, Y') }}</span>
                                <span>&bull;</span>
                                <span class="ml-2">{{ $post->user->name ?? 'Admin' }}</span>
                            </div>
                            <h2 class="text-xl font-bold text-gray-900 mb-3 leading-tight">
                                <a href="{{ route('blog.show', $post->slug) }}"
                                    class="hover:text-[#084D3C]">{{ $post->title }}</a>
                            </h2>
                            <p class="text-gray-600 mb-4 line-clamp-3">
                                {{ Str::limit(strip_tags($post->content), 120) }}
                            </p>
                            <a href="{{ route('blog.show', $post->slug) }}"
                                class="inline-flex items-center text-[#084D3C] font-semibold hover:underline">
                                Read Article <i class="fas fa-arrow-right ml-2 text-xs"></i>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 text-center py-20">
                        <i class="fas fa-newspaper text-6xl text-gray-300 mb-4"></i>
                        <p class="text-xl text-gray-500">No blog posts available at the moment.</p>
                    </div>
                @endforelse
            </div>

            <div class="mt-12">
                {{ $posts->links() }}
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <p class="text-gray-500 text-sm">
                &copy; {{ date('Y') }} Suffa Islamic Center. All rights reserved.
            </p>
        </div>
    </footer>

</body>

</html>