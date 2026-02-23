@extends('layouts.admin')

@section('title', 'Enquiry Details')

@section('content')
    <div class="max-w-4xl mx-auto bg-white rounded-lg shadow overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
            <h2 class="text-xl font-bold text-gray-800">Enquiry Details</h2>
            <form action="{{ route('admin.enquiries.destroy', $enquiry->id) }}" method="POST"
                onsubmit="return confirm('Are you sure?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-red-600 hover:text-red-900 font-medium">Delete Enquiry</button>
            </form>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div>
                    <h3 class="text-gray-500 text-sm uppercase font-bold mb-2">Contact Info</h3>
                    <p class="text-lg font-medium text-gray-900">{{ $enquiry->name }}</p>
                    <p class="text-gray-600 mb-1"><a href="mailto:{{ $enquiry->email }}"
                            class="text-[#084D3C] hover:underline">{{ $enquiry->email }}</a></p>
                    <p class="text-gray-600"><a href="tel:{{ $enquiry->phone }}"
                            class="text-[#084D3C] hover:underline">{{ $enquiry->phone }}</a></p>
                </div>
                <div>
                    <h3 class="text-gray-500 text-sm uppercase font-bold mb-2">Package Details</h3>
                    @if($enquiry->package)
                        <p class="text-lg font-medium text-gray-900">{{ $enquiry->package->title }}</p>
                        <p class="text-gray-600">{{ $enquiry->package->currency }} {{ $enquiry->package->price }} / Month</p>
                    @else
                        <p class="text-gray-600 italic">General Inquiry (No package selected)</p>
                    @endif
                </div>
            </div>

            <div class="mb-8">
                <h3 class="text-gray-500 text-sm uppercase font-bold mb-2">Message</h3>
                <div class="bg-gray-50 p-4 rounded-lg border border-gray-200 text-gray-800 whitespace-pre-wrap">
                    {{ $enquiry->message ?? 'No message provided.' }}</div>
            </div>

            <div class="border-t pt-6 text-sm text-gray-500">
                <p>Received: {{ $enquiry->created_at->format('F d, Y \a\t h:i A') }}</p>
            </div>

            <div class="mt-8 flex justify-end">
                <a href="{{ route('admin.enquiries.index') }}"
                    class="bg-gray-200 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-300 transition">Back to List</a>
            </div>
        </div>
    </div>
@endsection