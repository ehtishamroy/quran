<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = \App\Models\Post::latest()->paginate(10);
        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        return view('admin.posts.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'is_published' => 'boolean',
        ]);

        $slug = \Illuminate\Support\Str::slug($data['title']);
        $originalSlug = $slug;
        $count = 1;
        while (\App\Models\Post::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count++;
        }
        $data['slug'] = $slug;

        $data['user_id'] = auth()->id();
        $data['is_published'] = $request->has('is_published');

        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('posts', 'public');
        }

        \App\Models\Post::create($data);

        return redirect()->route('admin.posts.index')->with('success', 'Post created successfully.');
    }

    public function edit(\App\Models\Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }

    public function update(Request $request, \App\Models\Post $post)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'is_published' => 'boolean',
        ]);

        if ($post->title !== $data['title']) {
            $slug = \Illuminate\Support\Str::slug($data['title']);
            $originalSlug = $slug;
            $count = 1;
            while (\App\Models\Post::where('slug', $slug)->where('id', '!=', $post->id)->exists()) {
                $slug = $originalSlug . '-' . $count++;
            }
            $data['slug'] = $slug;
        }

        $data['is_published'] = $request->has('is_published');

        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('posts', 'public');
        }

        $post->update($data);

        return redirect()->route('admin.posts.index')->with('success', 'Post updated successfully.');
    }

    public function destroy(\App\Models\Post $post)
    {
        $post->delete();
        return back()->with('success', 'Post deleted successfully.');
    }
}
