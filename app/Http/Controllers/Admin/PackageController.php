<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function index()
    {
        $packages = \App\Models\Package::all();
        return view('admin.packages.index', compact('packages'));
    }

    public function create()
    {
        return view('admin.packages.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'features' => 'nullable|string', // Comma separated or JSON handling
            'price' => 'required|numeric',
            'currency' => 'required|string|max:3',
            'duration_minutes' => 'nullable|integer',
            'days_per_week' => 'nullable|integer',
            'is_popular' => 'boolean',
            'color_theme' => 'required|string',
        ]);

        $data['slug'] = \Illuminate\Support\Str::slug($data['title']);
        $data['features'] = array_map('trim', explode("\n", $request->features)); // Split by new line
        $data['is_popular'] = $request->has('is_popular');

        \App\Models\Package::create($data);

        return redirect()->route('admin.packages.index')->with('success', 'Package created successfully.');
    }

    public function edit(\App\Models\Package $package)
    {
        return view('admin.packages.edit', compact('package'));
    }

    public function update(Request $request, \App\Models\Package $package)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'features' => 'nullable|string',
            'price' => 'required|numeric',
            'currency' => 'required|string|max:3',
            'duration_minutes' => 'nullable|integer',
            'days_per_week' => 'nullable|integer',
            'is_popular' => 'boolean',
            'color_theme' => 'required|string',
        ]);

        $data['slug'] = \Illuminate\Support\Str::slug($data['title']);
        $data['features'] = array_map('trim', explode("\n", $request->features));
        $data['is_popular'] = $request->has('is_popular');

        $package->update($data);

        return redirect()->route('admin.packages.index')->with('success', 'Package updated successfully.');
    }

    public function destroy(\App\Models\Package $package)
    {
        $package->delete();
        return back()->with('success', 'Package deleted successfully.');
    }
}
