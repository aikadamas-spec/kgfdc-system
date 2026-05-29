<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class Setting extends Controller
{
    // index page setting
    public function index()
    {
        // Load saved settings from a JSON file in storage
        $settings = $this->loadSettings();
        return view('setting.settings', compact('settings'));
    }

    // update settings
    public function update(Request $request)
    {
        $request->validate([
            'website_name' => ['nullable', 'string', 'max:255'],
            'logo'         => ['nullable', 'image', 'mimes:jpg,jpeg,png,gif,svg', 'max:2048'],
            'favicon'      => ['nullable', 'image', 'mimes:jpg,jpeg,png,gif,svg,ico', 'max:512'],
        ]);

        $settings = $this->loadSettings();

        // Save website name
        if ($request->filled('website_name')) {
            $settings['website_name'] = $request->website_name;
        }

        // Handle logo upload
        if ($request->hasFile('logo') && $request->file('logo')->isValid()) {
            // Delete old logo if it was previously uploaded
            if (!empty($settings['logo']) && Storage::disk('public')->exists($settings['logo'])) {
                Storage::disk('public')->delete($settings['logo']);
            }
            $path = $request->file('logo')->store('settings', 'public');
            $settings['logo'] = $path;
        }

        // Handle favicon upload — always use a unique timestamped name so browsers
        // treat it as a brand-new file and never serve a stale cached version.
        if ($request->hasFile('favicon') && $request->file('favicon')->isValid()) {
            if (!empty($settings['favicon']) && Storage::disk('public')->exists($settings['favicon'])) {
                Storage::disk('public')->delete($settings['favicon']);
            }
            $ext  = $request->file('favicon')->getClientOriginalExtension();
            $name = 'favicon_' . time() . '.' . $ext;
            $request->file('favicon')->storeAs('settings', $name, 'public');
            $settings['favicon'] = 'settings/' . $name;
        }

        $this->saveSettings($settings);

        return redirect()->route('setting/page')->with('success', 'Settings updated successfully!');
    }

    // ── helpers ──────────────────────────────────────────────────────────────

    private function settingsPath(): string
    {
        return storage_path('app/settings.json');
    }

    private function loadSettings(): array
    {
        $path = $this->settingsPath();
        if (file_exists($path)) {
            return json_decode(file_get_contents($path), true) ?? [];
        }
        return [
            'website_name' => 'Kigamboni FDC',
            'logo'         => null,
            'favicon'      => null,
        ];
    }

    private function saveSettings(array $settings): void
    {
        file_put_contents($this->settingsPath(), json_encode($settings, JSON_PRETTY_PRINT));
    }
}
