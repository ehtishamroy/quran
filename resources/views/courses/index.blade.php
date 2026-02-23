@extends('layouts.app')

@section('content')

    <!-- Header / Breadcrumb -->
    <div class="bg-primary text-white py-16 relative overflow-hidden">
        <div class="absolute inset-0 opacity-10 pattern-overlay"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <h1 class="text-4xl md:text-5xl font-serif font-bold mb-4">Our Courses & Packages</h1>
            <p class="text-green-100 text-lg max-w-2xl mx-auto">
                Comprehensive Islamic education for all ages. Choose the plan that suits you best.
            </p>
        </div>
    </div>

    <!-- Main Courses Grid -->
    <section class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($packages as $package)
                    <div
                        class="bg-white rounded-2xl shadow-lg overflow-hidden group hover:shadow-2xl transition duration-300 border border-gray-100 flex flex-col relative">

                        <!-- Color Theme Bar -->
                        <div class="h-2 w-full bg-{{ $package->color_theme ?? 'primary' }}"></div>

                        <!-- Card Header -->
                        <div class="p-8 pb-0">
                            @if($package->is_popular)
                                <span
                                    class="bg-secondary text-white text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wide mb-4 inline-block">Most
                                    Popular</span>
                            @endif
                            <h3 class="text-2xl font-bold text-gray-800 mb-2 font-serif">{{ $package->title }}</h3>
                            <p class="text-gray-500 text-sm mb-6">{{ $package->description }}</p>

                            <!-- Price -->
                            <div class="flex items-baseline mb-6">
                                <span class="text-4xl font-bold text-primary">{{ $package->currency }}
                                    {{ $package->price }}</span>
                                <span class="text-gray-400 ml-2">/ Month</span>
                            </div>
                        </div>

                        <!-- Features List -->
                        <div class="px-8 py-6 bg-gray-50 flex-grow border-t border-gray-100">
                            @if($package->features && is_array($package->features))
                                <ul class="space-y-3">
                                    @foreach($package->features as $feature)
                                        <li class="flex items-start text-sm text-gray-600">
                                            <i class="fas fa-check-circle text-secondary mt-1 mr-3"></i>
                                            <span>{{ $feature }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <ul class="space-y-3">
                                    <li class="flex items-start text-sm text-gray-600">
                                        <i class="fas fa-check-circle text-secondary mt-1 mr-3"></i>
                                        <span>{{ $package->days_per_week }} Days per week</span>
                                    </li>
                                    <li class="flex items-start text-sm text-gray-600">
                                        <i class="fas fa-check-circle text-secondary mt-1 mr-3"></i>
                                        <span>{{ $package->duration_minutes }} Mins per class</span>
                                    </li>
                                    <li class="flex items-start text-sm text-gray-600">
                                        <i class="fas fa-check-circle text-secondary mt-1 mr-3"></i>
                                        <span>One-on-One Live Sessions</span>
                                    </li>
                                </ul>
                            @endif
                        </div>

                        <!-- Action -->
                        <div class="p-8 pt-0 bg-gray-50">
                            <a href="{{ route('home') }}#contact"
                                onclick="sessionStorage.setItem('selected_package', '{{ $package->id }}')"
                                class="block w-full bg-primary text-white text-center py-3 rounded-xl font-bold hover:bg-green-900 transition shadow-lg group-hover:shadow-green-900/30">
                                Enroll Now
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Class Timings Section -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-serif font-bold text-primary mb-4">Class Timings</h2>
                <div class="w-24 h-1 bg-secondary mx-auto rounded mb-6"></div>
                <p class="text-gray-600">We offer flexible timings to suit students from all around the world.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-4xl mx-auto">
                <!-- PK Time -->
                <div class="text-center p-8 border border-gray-100 rounded-2xl shadow-sm hover:shadow-md transition">
                    <div
                        class="w-16 h-16 bg-green-50 rounded-full flex items-center justify-center mx-auto mb-4 text-primary text-2xl">
                        <i class="far fa-clock"></i>
                    </div>
                    <h3 class="font-bold text-xl text-gray-800 mb-2">Pakistan Time</h3>
                    <p class="text-secondary font-bold text-lg">3 PM – 10 PM</p>
                </div>

                <!-- UK Time -->
                <div class="text-center p-8 border border-gray-100 rounded-2xl shadow-sm hover:shadow-md transition">
                    <div
                        class="w-16 h-16 bg-green-50 rounded-full flex items-center justify-center mx-auto mb-4 text-primary text-2xl">
                        <i class="far fa-clock"></i>
                    </div>
                    <h3 class="font-bold text-xl text-gray-800 mb-2">UK Time</h3>
                    <p class="text-secondary font-bold text-lg">2 PM – 8 PM</p>
                </div>

                <!-- USA Time -->
                <div class="text-center p-8 border border-gray-100 rounded-2xl shadow-sm hover:shadow-md transition">
                    <div
                        class="w-16 h-16 bg-green-50 rounded-full flex items-center justify-center mx-auto mb-4 text-primary text-2xl">
                        <i class="far fa-clock"></i>
                    </div>
                    <h3 class="font-bold text-xl text-gray-800 mb-2">USA Time</h3>
                    <p class="text-secondary font-bold text-lg">9 AM – 3 PM</p>
                </div>
            </div>
            <div class="text-center mt-10">
                <p class="text-sm text-gray-500 italic">* Custom timings are also available upon request.</p>
            </div>
        </div>
    </section>

@endsection