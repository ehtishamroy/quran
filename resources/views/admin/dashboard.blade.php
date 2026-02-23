@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Dashboard</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Stat Card 1 -->
        <div class="bg-white rounded-lg shadow p-6 border-l-4 border-[#084D3C]">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-100 text-[#084D3C] mr-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                        </path>
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-500 font-medium">Total Leads</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $stats['leads_count'] ?? 0 }}</p>
                </div>
            </div>
        </div>

        <!-- Stat Card 2 -->
        <div class="bg-white rounded-lg shadow p-6 border-l-4 border-[#DB9E30]">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-yellow-100 text-[#DB9E30] mr-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                        </path>
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-500 font-medium">Active Packages</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $stats['packages_count'] ?? 0 }}</p>
                </div>
            </div>
        </div>

        <!-- Stat Card 3 -->
        <div class="bg-white rounded-lg shadow p-6 border-l-4 border-blue-600">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-100 text-blue-600 mr-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z">
                        </path>
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-500 font-medium">Blog Posts</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $stats['posts_count'] ?? 0 }}</p>
                </div>
            </div>
        </div>

        <!-- Stat Card 4 -->
        <div class="bg-white rounded-lg shadow p-6 border-l-4 border-purple-600">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-purple-100 text-purple-600 mr-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                        </path>
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-500 font-medium">Team Members</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $stats['team_count'] ?? 0 }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity / Leads -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-800">Recent Enquiries</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Course /
                            Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($recent_enquiries ?? [] as $enquiry)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $enquiry->name }}</div>
                                <div class="text-sm text-gray-500">{{ $enquiry->email }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $enquiry->package->title ?? 'General Inquiry' }}</div>
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    {{ ucfirst($enquiry->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $enquiry->created_at->format('M d, Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="{{ route('admin.enquiries.show', $enquiry->id) }}"
                                    class="text-[#084D3C] hover:text-[#063328]">View</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center text-sm text-gray-500">No recent enquiries found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
            <a href="{{ route('admin.enquiries.index') }}"
                class="text-sm font-medium text-[#084D3C] hover:text-[#063328]">View all enquiries &rarr;</a>
        </div>
    </div>
@endsection