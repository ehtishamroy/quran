<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MenuItem;
use App\Models\Category;

class FrontController extends Controller
{
    /**
     * Helper to build a getSetting closure from settings collection.
     */
    private function buildGetSetting($settings): \Closure
    {
        return function ($key) use ($settings) {
            foreach ($settings as $group) {
                $setting = $group->where('key', $key)->first();
                if ($setting) return $setting->value;
            }
            return null;
        };
    }

    public function index()
    {
        $settings    = \App\Models\Setting::all()->groupBy('group');
        $packages    = \App\Models\Package::all();
        $teamMembers = \App\Models\TeamMember::orderBy('display_order')->get();
        $recentPosts = \App\Models\Post::where('is_published', true)->latest()->take(3)->get();
        $menuItems   = MenuItem::with('children')->whereNull('parent_id')->where('is_active', true)->orderBy('order')->get();

        $getSetting = $this->buildGetSetting($settings);

        $familyPackage = \App\Models\Package::where('slug', 'family-group')->first();
        $bonusPackage  = \App\Models\Package::where('slug', 'grandparent-discount')
            ->orWhere('slug', 'sibling-discount')
            ->first();

        return view('welcome', compact(
            'settings', 'packages', 'teamMembers', 'recentPosts',
            'getSetting', 'familyPackage', 'bonusPackage', 'menuItems'
        ));
    }

    public function submitEnquiry(Request $request)
    {
        $data = $request->validate([
            'name'       => 'required|string|max:255',
            'email'      => 'required|email|max:255',
            'phone'      => 'required|string|max:20',
            'package_id' => 'nullable|exists:packages,id',
            'message'    => 'nullable|string',
        ]);

        \App\Models\Enquiry::create($data);

        return back()->with('success', 'Thank you! Your enquiry has been sent successfully. We will contact you soon.');
    }

    public function blogIndex(Request $request)
    {
        $settings   = \App\Models\Setting::all()->groupBy('group');
        $getSetting = $this->buildGetSetting($settings);
        $menuItems  = MenuItem::with('children')->whereNull('parent_id')->where('is_active', true)->orderBy('order')->get();

        $categories  = Category::with('children')->whereNull('parent_id')->orderBy('order')->get();
        $allCategories = Category::all();

        $query = \App\Models\Post::where('is_published', true)->with('category');

        if ($request->category) {
            $catId = $allCategories->where('slug', $request->category)->first()?->id;
            if ($catId) {
                // Include posts from child categories too
                $childIds = $allCategories->where('parent_id', $catId)->pluck('id')->toArray();
                $ids = array_merge([$catId], $childIds);
                $query->whereIn('category_id', $ids);
            }
        }

        $posts = $query->latest()->paginate(9);

        return view('blog.index', compact('posts', 'getSetting', 'categories', 'allCategories', 'menuItems'));
    }

    public function blogShow($slug)
    {
        $post        = \App\Models\Post::where('slug', $slug)->where('is_published', true)->with('category')->firstOrFail();
        $settings    = \App\Models\Setting::all()->groupBy('group');
        $getSetting  = $this->buildGetSetting($settings);
        $menuItems   = MenuItem::with('children')->whereNull('parent_id')->where('is_active', true)->orderBy('order')->get();
        $relatedPosts = \App\Models\Post::where('is_published', true)
            ->where('id', '!=', $post->id)
            ->when($post->category_id, fn($q) => $q->where('category_id', $post->category_id))
            ->latest()->take(3)->get();

        return view('blog.show', compact('post', 'getSetting', 'menuItems', 'relatedPosts'));
    }
}
