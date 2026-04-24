<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClassTiming;
use Illuminate\Http\Request;

class ClassTimingController extends Controller
{
    public function index()
    {
        $timings = ClassTiming::orderBy('order')->get();
        return view('admin.class_timings.index', compact('timings'));
    }

    public function create()
    {
        return view('admin.class_timings.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'      => 'required|string|max:255',
            'time_range' => 'required|string|max:255',
            'icon'       => 'required|string|max:255',
            'order'      => 'nullable|integer',
            'is_active'  => 'boolean',
        ]);

        $data['is_active'] = $request->has('is_active');
        $data['order'] = $data['order'] ?? 0;

        ClassTiming::create($data);

        return redirect()->route('admin.class_timings.index')->with('success', 'Class timing created successfully.');
    }

    public function edit(ClassTiming $classTiming)
    {
        return view('admin.class_timings.edit', compact('classTiming'));
    }

    public function update(Request $request, ClassTiming $classTiming)
    {
        $data = $request->validate([
            'title'      => 'required|string|max:255',
            'time_range' => 'required|string|max:255',
            'icon'       => 'required|string|max:255',
            'order'      => 'nullable|integer',
            'is_active'  => 'boolean',
        ]);

        $data['is_active'] = $request->has('is_active');
        $data['order'] = $data['order'] ?? 0;

        $classTiming->update($data);

        return redirect()->route('admin.class_timings.index')->with('success', 'Class timing updated successfully.');
    }

    public function destroy(ClassTiming $classTiming)
    {
        $classTiming->delete();
        return redirect()->route('admin.class_timings.index')->with('success', 'Class timing deleted successfully.');
    }

    public function reorder(Request $request)
    {
        $order = $request->input('order');
        if (is_array($order)) {
            foreach ($order as $index => $id) {
                ClassTiming::where('id', $id)->update(['order' => $index]);
            }
        }
        return response()->json(['status' => 'success']);
    }
}
