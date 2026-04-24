<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @php
        $siteName       = $getSetting('site_name') ?? 'Suffa Islamic Center';
        $primaryColor   = $getSetting('theme[primary_color]') ?? '#084D3C';
        $secondaryColor = $getSetting('theme[secondary_color]') ?? '#DB9E30';
        $metaTitle      = $post->meta_title ?: ($post->title . ' - ' . $siteName);
        $metaDesc       = $post->meta_description ?: Str::limit(strip_tags($post->content), 160);
        $metaKeywords   = $post->meta_keywords ?: $getSetting('seo[meta_keywords]') ?? '';
        $ogImage        = $post->image_path ? asset('storage/'.$post->image_path) : ($getSetting('seo[og_image]') ? asset('storage/'.$getSetting('seo[og_image]')) : '');
    @endphp
    <title>{{ $metaTitle }}</title>
    <meta name="description" content="{{ $metaDesc }}">
    @if($metaKeywords)<meta name="keywords" content="{{ $metaKeywords }}">@endif
    <meta name="robots" content="index, follow">
    <meta property="og:title" content="{{ $metaTitle }}">
    <meta property="og:description" content="{{ $metaDesc }}">
    @if($ogImage)<meta property="og:image" content="{{ $ogImage }}">@endif
    <meta property="og:type" content="article">
    <meta name="twitter:card" content="summary_large_image">
    <link rel="canonical" href="{{ url()->current() }}">
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
    <style>
        .prose h1,.prose h2,.prose h3{font-weight:bold;margin-top:1.5em;margin-bottom:0.5em;color:{{ $primaryColor }};}
        .prose p{margin-bottom:1em;line-height:1.8;color:#4a5568;}
        .prose ul,.prose ol{margin-bottom:1em;padding-left:1.5em;}
        .prose li{margin-bottom:0.5em;}
    </style>
</head>

<body class="bg-gray-50 font-sans antialiased text-gray-800">

    @include('partials.navbar')

    <!-- Post Article -->
    <main class="pt-16 pb-20">
        <article class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 mt-10">
            <!-- Breadcrumb -->
            <nav class="text-sm mb-8 text-gray-500 flex items-center gap-2 flex-wrap">
                <a href="{{ route('home') }}" class="hover:text-primary">Home</a>
                <span>/</span>
                <a href="{{ route('blog.index') }}" class="hover:text-primary">Blog</a>
                @if($post->category)
                    <span>/</span>
                    <a href="{{ route('blog.index', ['category' => $post->category->slug]) }}" class="hover:text-primary">{{ $post->category->name }}</a>
                @endif
                <span>/</span>
                <span class="text-gray-800 font-medium truncate max-w-[200px]">{{ $post->title }}</span>
            </nav>

            <div class="mb-8 text-center">
                @if($post->category)
                    <a href="{{ route('blog.index', ['category' => $post->category->slug]) }}"
                       class="inline-block mb-4 text-white text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wide"
                       style="background:{{ $secondaryColor }}">{{ $post->category->name }}</a>
                @endif
                <h1 class="text-4xl md:text-5xl font-bold mb-4 leading-tight" style="color:{{ $primaryColor }}">{{ $post->title }}</h1>
                <div class="flex items-center justify-center text-gray-500 text-sm gap-4">
                    <span><i class="far fa-calendar-alt mr-2"></i>{{ $post->created_at->format('F d, Y') }}</span>
                    <span><i class="far fa-user mr-2"></i>{{ $post->user->name ?? 'Admin' }}</span>
                </div>
            </div>

            @if($post->image_path)
                <div class="mb-10 rounded-2xl overflow-hidden shadow-lg">
                    <img src="{{ asset('storage/' . $post->image_path) }}" alt="{{ $post->title }}" class="w-full h-auto object-cover">
                </div>
            @endif

            <div class="prose prose-lg max-w-none bg-white p-8 md:p-12 rounded-2xl shadow-sm">
                {!! nl2br(e($post->content)) !!}
            </div>

            <!-- Share -->
            <div class="mt-10 border-t pt-8 flex justify-between items-center flex-wrap gap-4">
                <a href="{{ route('blog.index') }}" class="text-gray-600 hover:text-primary font-medium">← More Posts</a>
                <div class="flex space-x-4">
                    <span class="text-gray-500 font-medium">Share:</span>
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank" class="text-gray-400 hover:text-blue-600"><i class="fab fa-facebook-f text-lg"></i></a>
                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($post->title) }}" target="_blank" class="text-gray-400 hover:text-blue-400"><i class="fab fa-twitter text-lg"></i></a>
                    <a href="https://wa.me/?text={{ urlencode($post->title . ' ' . url()->current()) }}" target="_blank" class="text-gray-400 hover:text-green-500"><i class="fab fa-whatsapp text-lg"></i></a>
                </div>
            </div>

            <!-- Related Posts -->
            @if($relatedPosts->count() > 0)
            <div class="mt-16">
                <h2 class="text-2xl font-bold mb-6" style="color:{{ $primaryColor }}">Related Articles</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach($relatedPosts as $related)
                    <a href="{{ route('blog.show', $related->slug) }}" class="group block bg-white rounded-xl shadow hover:shadow-md transition overflow-hidden">
                        @if($related->image_path)
                            <img src="{{ asset('storage/'.$related->image_path) }}" alt="{{ $related->title }}" class="w-full h-36 object-cover group-hover:scale-105 transition duration-500">
                        @else
                            <div class="h-36 flex items-center justify-center bg-gray-50 text-gray-200"><i class="fas fa-image text-3xl"></i></div>
                        @endif
                        <div class="p-4">
                            <p class="text-xs text-gray-400 mb-1">{{ $related->created_at->format('M d, Y') }}</p>
                            <h3 class="font-bold text-gray-800 group-hover:text-primary leading-tight text-sm">{{ $related->title }}</h3>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
            @endif
        </article>
    </main>

    <!-- Footer -->
    <footer class="text-white py-12" style="background:{{ $primaryColor }}">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <p class="opacity-60 text-sm">&copy; {{ date('Y') }} {{ $siteName }}. All rights reserved.</p>
        </div>
    </footer>

</body>
</html>