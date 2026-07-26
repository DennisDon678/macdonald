<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class SettingController extends Controller
{
    /**
     * Display the settings form.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get all settings from database or use default values
        $settings = Setting::pluck('value', 'key')->toArray();
        
        // Default settings if not found in database
        $defaultSettings = [
            'site_name' => config('app.name', 'MacDonald'),
            'contact_email' => '',
            'contact_phone' => '',
            'contact_address' => '',
            'tawk_to_embed_url' => '',
            'facebook_url' => '',
            'twitter_url' => '',
            'instagram_url' => '',
            'migration_notice_active' => 'no',
            'migration_notice_text' => 'We have migrated from our old domain to this new domain. Kindly make a new account with us and message support for assistance.',
        ];
        
        // Merge defaults with database values
        $settings = array_merge($defaultSettings, $settings);
        
        return view('admin.settings.index', compact('settings'));
    }
    
    /**
     * Update the specified settings.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'site_name' => 'required|string|max:255',
            'contact_email' => 'nullable|email|max:255',
            'contact_phone' => 'nullable|string|max:20',
            'contact_address' => 'nullable|string',
            'tawk_to_embed_url' => 'nullable|string|max:255',
            'facebook_url' => 'nullable|url|max:255',
            'twitter_url' => 'nullable|url|max:255',
            'instagram_url' => 'nullable|url|max:255',
            'migration_notice_active' => 'nullable|string|in:yes,no',
            'migration_notice_text' => 'nullable|string',
        ]);
        
        foreach ($validated as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }
        
        // Clear settings cache
        Cache::forget('settings');
        
        return redirect()
            ->route('admin.settings.index')
            ->with('success', 'Settings updated successfully.');
    }
}
