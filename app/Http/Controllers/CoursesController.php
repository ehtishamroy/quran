<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;

class CoursesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch all active packages, prioritizing 'popular' ones if needed
        $packages = Package::all();
        $settings = \App\Models\Setting::all()->groupBy('group');

        // Helper to get setting value
        $getSetting = function ($key) use ($settings) {
            foreach ($settings as $group) {
                $setting = $group->where('key', $key)->first();
                if ($setting)
                    return $setting->value;
            }
            return null;
        };

        return view('courses.index', compact('packages', 'getSetting'));
    }

    public function show($slug)
    {
        $package = Package::where('slug', $slug)->firstOrFail();
        $settings = \App\Models\Setting::all()->groupBy('group');

        // Helper to get setting value
        $getSetting = function ($key) use ($settings) {
            foreach ($settings as $group) {
                $setting = $group->where('key', $key)->first();
                if ($setting)
                    return $setting->value;
            }
            return null;
        };

        return view('courses.show', compact('package', 'getSetting'));
    }
}
