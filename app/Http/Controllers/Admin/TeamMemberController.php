<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TeamMemberController extends Controller
{
    public function index()
    {
        $teamMembers = \App\Models\TeamMember::orderBy('display_order')->get();
        return view('admin.team_members.index', compact('teamMembers'));
    }

    public function create()
    {
        return view('admin.team_members.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'display_order' => 'integer',
            'social_links' => 'nullable|array',
        ]);

        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('team', 'public');
        }

        \App\Models\TeamMember::create($data);

        return redirect()->route('admin.team-members.index')->with('success', 'Team member added successfully.');
    }

    public function edit(\App\Models\TeamMember $teamMember)
    {
        return view('admin.team_members.edit', compact('teamMember'));
    }

    public function update(Request $request, \App\Models\TeamMember $teamMember)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'display_order' => 'integer',
            'social_links' => 'nullable|array',
        ]);

        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('team', 'public');
        }

        $teamMember->update($data);

        return redirect()->route('admin.team-members.index')->with('success', 'Team member updated successfully.');
    }

    public function destroy(\App\Models\TeamMember $teamMember)
    {
        $teamMember->delete();
        return back()->with('success', 'Team member deleted successfully.');
    }
}
