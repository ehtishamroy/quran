<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        $settings = \App\Models\Setting::all()->groupBy('group');

        // Ensure default groups exist to prevent view errors
        $groups = ['general', 'contact', 'social', 'home_hero', 'about_us', 'homepage_images'];
        foreach ($groups as $group) {
            if (!isset($settings[$group])) {
                $settings[$group] = collect();
            }
        }

        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $data = $request->except('_token', '_method');

        foreach ($data as $group => $settings) {
            if (is_array($settings)) {
                // If the input is an array (like home_hero[hero_title])
                foreach ($settings as $key => $value) {
                    $settingKey = "{$group}[{$key}]";

                    if (is_null($value) && !$request->hasFile("{$group}.{$key}")) {
                        // Skip null values unless it's a file upload (which we handle below)
                        continue;
                    }

                    if ($request->hasFile("{$group}.{$key}")) {
                        $file = $request->file("{$group}.{$key}");
                        $path = $file->store('settings', 'public');
                        $value = $path;
                    }

                    \App\Models\Setting::updateOrCreate(
                        ['key' => $settingKey],
                        ['value' => $value, 'group' => $group]
                    );
                }
            } else {
                // For flat keys (not expected in the current form, but just in case)
                if (is_null($settings) && !$request->hasFile($group)) {
                    continue;
                }
                if ($request->hasFile($group)) {
                    $file = $request->file($group);
                    $path = $file->store('settings', 'public');
                    $settings = $path;
                }
                \App\Models\Setting::updateOrCreate(
                    ['key' => $group],
                    ['value' => $settings, 'group' => 'general']
                );
            }
        }

        return back()->with('success', 'Settings updated successfully.');
    }
}
