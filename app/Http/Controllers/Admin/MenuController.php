<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MenuItem;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        $items = MenuItem::with('children')->whereNull('parent_id')->orderBy('order')->get();
        return view('admin.menus.index', compact('items'));
    }

    public function create()
    {
        $parents = MenuItem::whereNull('parent_id')->orderBy('order')->get();
        return view('admin.menus.create', compact('parents'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'     => 'required|string|max:255',
            'url'       => 'required|string|max:500',
            'parent_id' => 'nullable|exists:menu_items,id',
            'order'     => 'nullable|integer',
            'target'    => 'in:_self,_blank',
            'is_button' => 'boolean',
            'is_active' => 'boolean',
        ]);

        $data['is_button'] = $request->has('is_button');
        $data['is_active'] = $request->has('is_active');

        MenuItem::create($data);

        return redirect()->route('admin.menus.index')->with('success', 'Menu item created.');
    }

    public function edit(MenuItem $menu)
    {
        $parents = MenuItem::whereNull('parent_id')->where('id', '!=', $menu->id)->orderBy('order')->get();
        return view('admin.menus.edit', compact('menu', 'parents'));
    }

    public function update(Request $request, MenuItem $menu)
    {
        $data = $request->validate([
            'title'     => 'required|string|max:255',
            'url'       => 'required|string|max:500',
            'parent_id' => 'nullable|exists:menu_items,id',
            'order'     => 'nullable|integer',
            'target'    => 'in:_self,_blank',
            'is_button' => 'boolean',
            'is_active' => 'boolean',
        ]);

        $data['is_button'] = $request->has('is_button');
        $data['is_active'] = $request->has('is_active');

        $menu->update($data);

        return redirect()->route('admin.menus.index')->with('success', 'Menu item updated.');
    }

    public function destroy(MenuItem $menu)
    {
        MenuItem::where('parent_id', $menu->id)->update(['parent_id' => null]);
        $menu->delete();
        return back()->with('success', 'Menu item deleted.');
    }

    public function reorder(Request $request)
    {
        $items = $request->validate(['items' => 'required|array'])['items'];
        foreach ($items as $item) {
            MenuItem::where('id', $item['id'])->update(['order' => $item['order']]);
        }
        return response()->json(['success' => true]);
    }
}
