<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::orderBy('order')->get();
        $parents = Menu::whereNull('parent_id')->get();
        return view('menus.index', compact('menus', 'parents'));
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required']);
        Menu::create($request->only(['name', 'route', 'icon', 'order', 'parent_id']));
        return redirect()->route('menus.index')->with('success', 'Menu created.');
    }

    public function update(Request $request, Menu $menu)
    {
        $request->validate(['name' => 'required']);
        $menu->update($request->only(['name', 'route', 'icon', 'order', 'parent_id']));
        return redirect()->route('menus.index')->with('success', 'Menu updated.');
    }

    public function destroy(Menu $menu)
    {
        $menu->delete();
        return redirect()->route('menus.index')->with('success', 'Menu deleted.');
    }
}
