<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @php
        $siteName = $getSetting('site_name') ?? 'Suffa Islamic Center';
        $primaryColor   = $getSetting('theme[primary_color]') ?? '#084D3C';
        $secondaryColor = $getSetting('theme[secondary_color]') ?? '#DB9E30';
        $currentCat = request('category');
    @endphp
    <title>Blog - {{ $siteName }}</title>
    <meta name="description" content="Islamic articles, Quran tips, and updates from {{ $siteName }}.">
    <meta name="robots" content="index, follow">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>:root{--color-primary:{{ $primaryColor }};--color-secondary:{{ $secondaryColor }};}</style>
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        colors: {
                            primary: '{{ $primaryColor }}',
                            secondary: '{{ $secondaryColor }}'
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
</head>

<body class="bg-gray-50 font-sans antialiased text-gray-800">

    @include('partials.navbar')

    <!-- Header -->
    <header class="text-white pt-24 pb-16" style="background:{{ $primaryColor }}">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl font-bold mb-4">Our Blog</h1>
            <p class="text-xl opacity-80">Updates, Articles, and Islamic Knowledge</p>
        </div>
    </header>

    <!-- Category Filter Bar -->
    @if($categories->count() > 0)
    <div class="bg-white border-b shadow-sm sticky top-20 z-40">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center gap-2 py-3 overflow-x-auto">
                <a href="{{ route('blog.index') }}"
                   class="flex-shrink-0 px-4 py-1.5 rounded-full text-sm font-semibold transition {{ !$currentCat ? 'text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}"
                   style="{{ !$currentCat ? 'background:'.$primaryColor : '' }}">All Posts</a>
                @foreach($categories as $cat)
                    <a href="{{ route('blog.index', ['category' => $cat->slug]) }}"
                       class="flex-shrink-0 px-4 py-1.5 rounded-full text-sm font-semibold transition {{ $currentCat === $cat->slug ? 'text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}"
                       style="{{ $currentCat === $cat->slug ? 'background:'.$primaryColor : '' }}">{{ $cat->name }}</a>
                    @foreach($cat->children as $child)
                        <a href="{{ route('blog.index', ['category' => $child->slug]) }}"
                           class="flex-shrink-0 px-4 py-1.5 rounded-full text-sm font-medium transition {{ $currentCat === $child->slug ? 'text-white' : 'bg-gray-50 text-gray-500 hover:bg-gray-100 border' }}"
                           style="{{ $currentCat === $child->slug ? 'background:'.$primaryColor : '' }}">↳ {{ $child->name }}</a>
                    @endforeach
                @endforeach
            </div>
        </div>
    </div>
    @endif

    <!-- Main Content -->
    <main class="py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @forelse($posts as $post)
                    <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition group">
                        <a href="{{ route('blog.show', $post->slug) }}" class="block h-56 bg-gray-200 overflow-hidden">
                            @if($post->image_path)
                                <img src="{{ asset('storage/' . $post->image_path) }}" alt="{{ $post->title }}"
                                    class="w-full h-full object-cover transform group-hover:scale-105 transition duration-500">
                            @else
                                <div class="flex items-center justify-center h-full bg-green-50 text-green-200">
                                    <i class="fas fa-image text-5xl"></i>
                                </div>
                            @endif
                        </a>
                        <div class="p-6">
                            <div class="flex items-center gap-2 text-xs text-gray-500 mb-2 flex-wrap">
                                @if($post->category)
                                    <a href="{{ route('blog.index', ['category' => $post->category->slug]) }}"
                                       class="font-bold uppercase tracking-wide px-2 py-0.5 rounded-full text-white text-xs"
                                       style="background:{{ $secondaryColor }}">{{ $post->category->name }}</a>
                                @endif
                                <span class="font-medium" style="color:{{ $secondaryColor }}">{{ $post->created_at->format('M d, Y') }}</span>
                                <span>&bull;</span>
                                <span>{{ $post->user->name ?? 'Admin' }}</span>
                            </div>
                            <h2 class="text-xl font-bold text-gray-900 mb-3 leading-tight">
                                <a href="{{ route('blog.show', $post->slug) }}" class="hover:text-primary">{{ $post->title }}</a>
                            </h2>
                            <p class="text-gray-600 mb-4 line-clamp-3">{{ Str::limit(strip_tags($post->content), 120) }}</p>
                            <a href="{{ route('blog.show', $post->slug) }}" class="inline-flex items-center font-semibold hover:underline text-sm uppercase tracking-wide" style="color:{{ $primaryColor }}">
                                Read Article <i class="fas fa-arrow-right ml-2 text-xs"></i>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 text-center py-20">
                        <i class="fas fa-newspaper text-6xl text-gray-300 mb-4"></i>
                        <p class="text-xl text-gray-500">No blog posts {{ $currentCat ? 'in this category' : 'available' }} at the moment.</p>
                        @if($currentCat)
                            <a href="{{ route('blog.index') }}" class="mt-4 inline-block font-bold" style="color:{{ $primaryColor }}">View all posts →</a>
                        @endif
                    </div>
                @endforelse
            </div>

            <div class="mt-12">
                {{ $posts->links() }}
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="text-white py-12" style="background:{{ $primaryColor }}">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <p class="opacity-60 text-sm">&copy; {{ date('Y') }} {{ $siteName }}. All rights reserved.</p>
        </div>
    </footer>

</body>
</html>