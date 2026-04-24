@extends('layouts.admin')

@section('header')
    Class Timings
@endsection

@section('content')
<div class="mb-6 flex justify-between items-center">
    <div>
        <h2 class="text-xl font-semibold text-gray-800">Manage Class Timings</h2>
        <p class="text-sm text-gray-500">Configure the time zones and hours displayed on the courses page.</p>
    </div>
    <a href="{{ route('admin.class_timings.create') }}" class="bg-[#084D3C] text-white px-4 py-2 rounded-lg hover:opacity-90 transition">
        <i class="fas fa-plus mr-2"></i> Add Timing
    </a>
</div>

<div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden">
    @if($timings->count() > 0)
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 text-gray-500 text-sm border-b">
                    <th class="px-6 py-4 font-medium w-16">Icon</th>
                    <th class="px-6 py-4 font-medium">Title</th>
                    <th class="px-6 py-4 font-medium">Time Range</th>
                    <th class="px-6 py-4 font-medium">Status</th>
                    <th class="px-6 py-4 font-medium text-right">Actions</th>
                </tr>
            </thead>
            <tbody id="sortable-timings">
                @foreach($timings as $timing)
                    <tr class="border-b hover:bg-gray-50 transition cursor-move" data-id="{{ $timing->id }}">
                        <td class="px-6 py-4">
                            <div class="w-10 h-10 bg-green-50 rounded-full flex items-center justify-center text-[#084D3C]">
                                <i class="{{ $timing->icon }}"></i>
                            </div>
                        </td>
                        <td class="px-6 py-4 font-medium text-gray-800">{{ $timing->title }}</td>
                        <td class="px-6 py-4 text-gray-600">{{ $timing->time_range }}</td>
                        <td class="px-6 py-4">
                            @if($timing->is_active)
                                <span class="bg-green-100 text-green-800 text-xs font-semibold px-2.5 py-0.5 rounded">Active</span>
                            @else
                                <span class="bg-red-100 text-red-800 text-xs font-semibold px-2.5 py-0.5 rounded">Inactive</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right">
                            <a href="{{ route('admin.class_timings.edit', $timing->id) }}" class="text-blue-500 hover:text-blue-700 mr-3">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.class_timings.destroy', $timing->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this timing?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="p-8 text-center text-gray-500">
            No class timings found. Click "Add Timing" to create one.
        </div>
    @endif
</div>

<p class="text-xs text-gray-400 mt-4"><i class="fas fa-info-circle mr-1"></i> Drag and drop rows to reorder them on the frontend.</p>

<script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var el = document.getElementById('sortable-timings');
        if(el) {
            Sortable.create(el, {
                animation: 150,
                onEnd: function () {
                    let order = [];
                    document.querySelectorAll('#sortable-timings tr').forEach(row => {
                        order.push(row.dataset.id);
                    });

                    fetch('{{ route('admin.class_timings.reorder') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ order: order })
                    });
                }
            });
        }
    });
</script>
@endsection
