@extends('layouts.admin')

@section('title', 'Leads / Enquiries')

@section('content')
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Leads / Enquiries</h1>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Interested Package</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($enquiries as $enquiry)
                    <tr class="{{ $enquiry->status === 'new' ? 'bg-green-50' : '' }}">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $enquiry->created_at->format('M d, Y H:i') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">{{ $enquiry->name }}</div>
                            <div class="text-sm text-gray-500">{{ $enquiry->email }}</div>
                        </td>
                         <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $enquiry->package->title ?? 'General Inquiry' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($enquiry->status === 'new')
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">New</span>
                            @elseif($enquiry->status === 'read')
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">Read</span>
                            @else
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">{{ ucfirst($enquiry->status) }}</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <a href="{{ route('admin.enquiries.show', $enquiry->id) }}" class="text-[#084D3C] hover:text-[#063328] mr-3">View Details</a>
                            <form action="{{ route('admin.enquiries.destroy', $enquiry->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-gray-500">No enquiries found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="px-6 py-4 border-t border-gray-200">
            {{ $enquiries->links() }}
        </div>
    </div>
@endsection
