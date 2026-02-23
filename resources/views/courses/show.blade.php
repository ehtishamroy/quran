@extends('layouts.app')

@section('content')

    <!-- Header / Breadcrumb -->
    <div class="bg-primary text-white mt-0 py-20 relative overflow-hidden">
        <div class="absolute inset-0 opacity-10 pattern-overlay"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            @if($package->is_popular)
                <span
                    class="bg-secondary text-white text-sm font-bold px-4 py-1.5 rounded-full uppercase tracking-wide mb-6 inline-block shadow-md">
                    Most Popular
                </span>
            @endif
            <h1 class="text-4xl md:text-6xl font-serif font-bold mb-6 text-shadow">{{ $package->title }}</h1>
            <p class="text-green-100 text-xl md:text-2xl max-w-3xl mx-auto font-light leading-relaxed">
                {{ $package->description }}
            </p>
        </div>
    </div>

    <!-- Main Course Content -->
    <section class="py-20 bg-gray-50">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-gray-100">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-0">

                    <!-- Left Column: Details & Features -->
                    <div class="p-10 md:p-14 lg:p-16 border-b md:border-b-0 md:border-r border-gray-100">
                        <h2 class="text-3xl font-serif font-bold text-gray-800 mb-8 flex items-center">
                            <i class="fas fa-star text-secondary mr-4"></i> What You Will Learn
                        </h2>

                        @if($package->features && is_array($package->features))
                            <ul class="space-y-5">
                                @foreach($package->features as $feature)
                                    <li class="flex items-start text-lg text-gray-700">
                                        <div class="mt-1 bg-green-100 text-primary rounded-full p-1 mr-4 flex-shrink-0">
                                            <i class="fas fa-check text-sm w-4 h-4 flex items-center justify-center"></i>
                                        </div>
                                        <span class="font-medium">{{ $feature }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p class="text-gray-500 italic">Curriculum details coming soon.</p>
                        @endif
                    </div>

                    <!-- Right Column: Pricing & Scheduling -->
                    <div class="p-10 md:p-14 lg:p-16 bg-gray-50 flex flex-col justify-center">
                        <h2 class="text-3xl font-serif font-bold text-gray-800 mb-8 border-b border-gray-200 pb-4">
                            Course Details
                        </h2>

                        <ul class="space-y-6 mb-10">
                            <li
                                class="flex justify-between items-center text-lg text-gray-700 border-b border-gray-200 pb-3">
                                <span><i class="far fa-clock text-primary mr-2"></i> Class Duration</span>
                                <span class="font-bold text-gray-900">{{ $package->duration_minutes }} Minutes</span>
                            </li>
                            <li
                                class="flex justify-between items-center text-lg text-gray-700 border-b border-gray-200 pb-3">
                                <span><i class="far fa-calendar-alt text-primary mr-2"></i> Classes per Week</span>
                                <span class="font-bold text-gray-900">{{ $package->days_per_week }} Days</span>
                            </li>
                            <li class="flex justify-between items-center text-lg text-gray-700 pb-3">
                                <span><i class="fas fa-video text-primary mr-2"></i> Session Type</span>
                                <span class="font-bold text-gray-900">1-on-1 Live</span>
                            </li>
                        </ul>

                        <div
                            class="bg-white p-6 rounded-2xl shadow-md border border-gray-100 text-center mb-8 transform hover:scale-105 transition duration-300">
                            <p class="text-gray-500 text-sm font-bold uppercase tracking-widest mb-2">Monthly Fee</p>
                            <div class="text-5xl font-bold text-primary">
                                {{ $package->currency }}{{ $package->price }}
                            </div>
                        </div>

                        <a href="{{ route('home') }}#contact"
                            onclick="sessionStorage.setItem('selected_package', '{{ $package->id }}')"
                            class="block w-full text-center bg-secondary hover:bg-yellow-600 text-white text-xl py-4 rounded-xl font-bold transition shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                            <i class="fas fa-graduation-cap mr-2"></i> Book Free Trial
                        </a>
                    </div>
                </div>
            </div>

            <!-- Sticky Mobile/Floating Actions for this specific page if desired -->
            <!-- Note: Layout already includes a floating WhatsApp button. -->
            <!-- We will ensure it is prominent. -->
        </div>
    </section>

@endsection