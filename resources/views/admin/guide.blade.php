@extends('layouts.admin')

@section('title', 'Platform User Guide')

@section('content')
    <div class="max-w-4xl mx-auto">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">How to Use the Platform</h1>
        <p class="text-gray-600 mb-8">A simple, non-technical guide to managing your beautiful Islamic Center website.</p>

        <div class="space-y-6">

            <!-- Section 1: Introduction -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="bg-[#084D3C] text-white px-6 py-4 flex items-center">
                    <i class="fas fa-magic text-2xl text-yellow-500 mr-4"></i>
                    <h2 class="text-xl font-bold">1. How The Website Works (The Magic)</h2>
                </div>
                <div class="p-6 text-gray-700 leading-relaxed">
                    <p class="mb-4">Your website is built to be "Dynamic". This means you never need to touch any code or
                        hire a developer to update your courses or text!</p>
                    <p>Everything you see on the public website (the homepage text, the course pricing, the features) is
                        controlled right here from this Admin Panel. When you update something here, it instantly updates on
                        the frontend for your visitors.</p>
                </div>
            </div>

            <!-- Section 2: Editing Homepage Text -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="bg-[#084D3C] text-white px-6 py-4 flex items-center">
                    <i class="fas fa-home text-2xl text-yellow-500 mr-4"></i>
                    <h2 class="text-xl font-bold">2. How to Change Homepage & About Us Text</h2>
                </div>
                <div class="p-6 text-gray-700 leading-relaxed">
                    <p class="mb-4">Want to run a special promotion or update your mission statement? It's easy!</p>
                    <ul class="list-disc pl-6 space-y-3">
                        <li>Look at the dark green menu on the left side of your screen.</li>
                        <li>Click on the <strong>Settings</strong> button (near the bottom).</li>
                        <li>Scroll down past the contact information to find the <strong>Homepage Hero Text</strong> and
                            <strong>About Us Section</strong>.</li>
                        <li>Simply type your new text into the boxes.</li>
                        <li>Click the golden <span
                                class="bg-yellow-500 text-white px-2 py-1 rounded text-sm mx-1 font-bold">Save
                                Settings</span> button at the bottom.</li>
                    </ul>
                    <div class="mt-4 bg-yellow-50 border-l-4 border-yellow-500 p-4">
                        <p class="text-sm font-bold text-yellow-800"><i class="fas fa-info-circle mr-2"></i> Tip:</p>
                        <p class="text-sm text-yellow-700">The "Hero Title" is the thin text, and the "Hero Highlighted
                            Text" is the big golden text that grabs attention!</p>
                    </div>
                </div>
            </div>

            <!-- Section 3: Editing Courses -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="bg-[#084D3C] text-white px-6 py-4 flex items-center">
                    <i class="fas fa-book-open text-2xl text-yellow-500 mr-4"></i>
                    <h2 class="text-xl font-bold">3. How to Update Your Courses (Packages)</h2>
                </div>
                <div class="p-6 text-gray-700 leading-relaxed">
                    <p class="mb-4">If you change your pricing, add a new feature, or want to create a brand new course
                        offering, you do this through the "Packages" system.</p>
                    <ul class="list-decimal pl-6 space-y-3 mb-6">
                        <li>Click on <strong>Packages</strong> in the left sidebar menu.</li>
                        <li>Here you will see all your active courses (Basic Quran Reading, Hifz, etc.).</li>
                        <li>To change an existing course, click the <strong>Edit</strong> button next to it.</li>
                        <li>To add a new course, click <strong>Create New Package</strong> at the top right.</li>
                    </ul>

                    <h3 class="font-bold text-gray-900 mb-2 mt-4 text-lg border-b pb-2">Important Fields Explained:</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <span class="font-bold text-[#084D3C] block mb-1">Description</span>
                            <span class="text-sm">This is the short summary paragraph that appears on the course card and at
                                the top of the course page.</span>
                        </div>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <span class="font-bold text-[#084D3C] block mb-1">Features (Very Important!)</span>
                            <span class="text-sm">These are the bullet points (e.g., "Master Noorani Qaida"). <strong>Press
                                    Enter after every sentence.</strong> Each new line automatically becomes a checkmark
                                point on the frontend!</span>
                        </div>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <span class="font-bold text-[#084D3C] block mb-1">Price & Currency</span>
                            <span class="text-sm">Type '£' in currency and '40' in price. Do not put symbols in the price
                                box.</span>
                        </div>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <span class="font-bold text-[#084D3C] block mb-1">Popular Checkbox</span>
                            <span class="text-sm">Check this box to put a shiny "Most Popular" ribbon on the course card to
                                attract more clicks!</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section 4: Testing & Support -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="bg-[#084D3C] text-white px-6 py-4 flex items-center">
                    <i class="fas fa-life-ring text-2xl text-yellow-500 mr-4"></i>
                    <h2 class="text-xl font-bold">4. Managing Students & Teachers</h2>
                </div>
                <div class="p-6 text-gray-700 leading-relaxed">
                    <p class="mb-4"><strong>Leads / Enquiries:</strong> When someone uses the "Book Free Trial" form on your
                        website, it automatically gets saved here. Check this tab daily to call or WhatsApp your new
                        potential students!</p>
                    <p class="mb-4"><strong>Team Management:</strong> This is where you add profiles for your expert
                        scholars. Add their photo, their title (e.g. "Tajweed Expert"), and their bio. They will
                        automatically appear in the beautiful slider on your homepage.</p>
                </div>
            </div>

            <div class="text-center py-8">
                <a href="{{ route('admin.dashboard') }}"
                    class="inline-flex items-center text-[#084D3C] font-bold hover:text-green-800">
                    <i class="fas fa-arrow-left mr-2"></i> Go back to Dashboard
                </a>
            </div>

        </div>
    </div>
@endsection