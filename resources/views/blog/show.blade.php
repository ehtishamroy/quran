<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $post->title }} - Suffa Blog</title>
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
    @endif
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .prose h1,
        .prose h2,
        .prose h3 {
            color: #084D3C;
            font-weight: bold;
            margin-top: 1.5em;
            margin-bottom: 0.5em;
        }

        .prose p {
            margin-bottom: 1em;
            line-height: 1.8;
            color: #4a5568;
        }

        .prose ul,
        .prose ol {
            margin-bottom: 1em;
            padding-left: 1.5em;
        }

        .prose li {
            margin-bottom: 0.5em;
        }
    </style>
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
                    <a href="{{ route('blog.index') }}" class="text-[#084D3C] font-bold">Blog</a>
                    <a href="{{ route('home') }}#contact"
                        class="bg-[#DB9E30] text-white px-5 py-2 rounded-full font-bold hover:bg-[#b88628] transition">Contact
                        Us</a>
                </div>
                <!-- Mobile menu button -->
                <div class="md:hidden flex items-center">
                    <a href="{{ route('blog.index') }}" class="text-gray-700 hover:text-[#084D3C]">
                        <i class="fas fa-arrow-left text-xl mr-2"></i> Back to Blog
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Post Article -->
    <main class="pt-32 pb-20">
        <article class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-8 text-center">
                <a href="{{ route('blog.index') }}"
                    class="inline-block mb-4 text-[#DB9E30] font-semibold text-sm hover:underline">&larr; Back to
                    Blog</a>
                <h1 class="text-4xl md:text-5xl font-bold text-[#084D3C] mb-4 leading-tight">{{ $post->title }}</h1>
                <div class="flex items-center justify-center text-gray-500 text-sm">
                    <span class="mr-4"><i class="far fa-calendar-alt mr-2"></i>
                        {{ $post->created_at->format('F d, Y') }}</span>
                    <span><i class="far fa-user mr-2"></i> {{ $post->user->name ?? 'Admin' }}</span>
                </div>
            </div>

            @if($post->image_path)
                <div class="mb-10 rounded-2xl overflow-hidden shadow-lg">
                    <img src="{{ asset('storage/' . $post->image_path) }}" alt="{{ $post->title }}"
                        class="w-full h-auto object-cover">
                </div>
            @endif

            <div class="prose prose-lg max-w-none bg-white p-8 md:p-12 rounded-2xl shadow-sm">
                {!! nl2br(e($post->content)) !!}
            </div>

            <!-- Share / Navigation Actions -->
            <div class="mt-10 border-t pt-8 flex justify-between items-center">
                <a href="{{ route('blog.index') }}" class="text-gray-600 hover:text-[#084D3C] font-medium">Read More
                    Posts</a>
                <div class="flex space-x-4">
                    <span class="text-gray-500 font-medium">Share:</span>
                    <a href="#" class="text-gray-400 hover:text-blue-600"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="text-gray-400 hover:text-blue-400"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="text-gray-400 hover:text-green-500"><i class="fab fa-whatsapp"></i></a>
                </div>
            </div>
        </article>
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