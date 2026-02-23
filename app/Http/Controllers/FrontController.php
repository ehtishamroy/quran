<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index()
    {
        $settings = \App\Models\Setting::all()->groupBy('group');
        $packages = \App\Models\Package::all();
        $teamMembers = \App\Models\TeamMember::orderBy('display_order')->get();
        $recentPosts = \App\Models\Post::where('is_published', true)->latest()->take(3)->get();

        // Helper to get setting value
        $getSetting = function ($key) use ($settings) {
            foreach ($settings as $group) {
                $setting = $group->where('key', $key)->first();
                if ($setting)
                    return $setting->value;
            }
            return null;
        };

        $familyPackage = \App\Models\Package::where('slug', 'family-group')->first();
        $bonusPackage = \App\Models\Package::where('slug', 'grandparent-discount')
            ->orWhere('slug', 'sibling-discount')
            ->first();

        return view('welcome', compact('settings', 'packages', 'teamMembers', 'recentPosts', 'getSetting', 'familyPackage', 'bonusPackage'));
    }

    public function submitEnquiry(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'package_id' => 'nullable|exists:packages,id',
            'message' => 'nullable|string',
        ]);

        \App\Models\Enquiry::create($data);

        return back()->with('success', 'Thank you! Your enquiry has been sent successfully. We will contact you soon.');
    }

    public function blogIndex()
    {
        $posts = \App\Models\Post::where('is_published', true)->latest()->paginate(9);
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
        return view('blog.index', compact('posts', 'getSetting'));
    }

    public function blogShow($slug)
    {
        $post = \App\Models\Post::where('slug', $slug)->where('is_published', true)->firstOrFail();
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
        return view('blog.show', compact('post', 'getSetting'));
    }
}
