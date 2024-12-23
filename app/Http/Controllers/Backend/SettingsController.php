<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\settings;
use Hamcrest\Core\Set;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Settings $settings)
    {
        // // Use firstOrCreate properly
        $settings['address'] = settings::firstOrCreate(
            ['key' => 'address'], // Search criteria
            ['value' => json_encode('N/A')]    // Values to set if record does not exist
        );

        $settings['social-media'] = settings::firstOrCreate(
            ['key' => 'social-media'], // Search criteria
            ['value' => json_encode('N/A')]         // Values to set if record does not exist
        );

        $settings['contact'] = settings::firstOrCreate(
            ['key' => 'phone'], // Search criteria
            ['value' => json_encode('N/A')]  // Values to set if record does not exist
        );

        $settings['email'] = settings::firstOrCreate(
            ['key' => 'email'], // Search criteria
            ['value' => json_encode('N/A')]  // Values to set if record does not exist
        );

        $settings['top-slider'] = settings::firstOrCreate(
            ['key' => 'top-slider'], // Search criteria
            ['value' => json_encode('N/A')]  // Values to set if record does not exist
        );

        $settings['footer'] = settings::firstOrCreate(
            ['key' => 'footer'], // Search criteria
            ['value' => json_encode('N/A')]  // Values to set if record does not exist
        );

        $settings['policy'] = settings::firstOrCreate(
            ['key' => 'policy'], // Search criteria
            ['value' => json_encode('N/A')]  // Values to set if record does not exist
        );
        $settings['url'] = settings::firstOrCreate(
            ['key' => 'side-button'], // Search criteria
            ['value' => json_encode(['url' => 'N/A'])] // Values to set if record does not exist
        );

        // decode $settings 
        foreach ($settings as $key => $value) {
            $settings[$key] = json_decode($value, true);
        }

        return view('Backend.Settings.index', compact('settings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function slider(Request $request)
    {
        // dd("Slider Store");
        $request->validate([
            'title_en' => 'required|string|max:255',
            'title_ar' => 'required|string|max:255',
            'description_en' => 'required|string|max:255',
            'description_ar' => 'required|string|max:255',
        ]);
        $key = "top-slider"; // Define the settings key
        $settings = settings::where('key', $key)->first();
        if (!isset($settings)) {
            // If no settings are found, create a default
            $settings = new \stdClass();
            $settings->value = json_encode(['status' => 'on']);
            settings::create([
                'key' => $key,
                'value' => json_encode(['status' => 'on']),
            ]);
        }
        // Dynamically generate localized data
        $localizedData = [];
        foreach (['en', 'ar'] as $locale) {
            $localizedData[$locale] = [
                "title" => $request->input("title_{$locale}"),
                "description" => $request->input("description_{$locale}")
            ];
        }

        // Create the final value payload dynamically
        $value = json_encode(array_merge($localizedData, [
            'status' => $request->status
        ]));

        // Check if the setting already exists
        if (settings::where('key', $key)->exists()) {
            settings::where('key', $key)->update(['value' => $value]);
            return redirect()->back()->with('success', 'Top-slider updated successfully');
        } else {
            settings::create(['key' => $key, 'value' => $value]);
            return redirect()->back()->with('success', 'Top-slider created successfully');
        }

        return view('Backend.Settings.index');
    }


    public function footer_store(Request $request)
    {
        $request->validate([
            'name_en' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
            'description_en' => 'required|string|max:255',
            'description_ar' => 'required|string|max:255',
            'social_media' => 'nullable|array', // Social media must be an array, but it’s optional
            'social_media.*.key' => 'nullable|string|max:255', // Validate each key as a string
            'social_media.*.value' => 'nullable', // Validate each value as a URL
        ]);
        $key = "footer"; // Define the settings key
        $data = $request->except(['social_media']); // Exclude specific fields
        $settings = settings::where('key', $key)->first();
        if (!isset($settings)) {
            // If no settings are found, create a default
            $settings = new \stdClass();
            $settings->value = json_encode(['status' => 'on']);
            settings::create([
                'key' => $key,
                'value' => json_encode(['status' => 'on']),
            ]);
        }
        // Handle social media links as an array of dictionaries
        $socialMedia = [];
        if ($request->has('social_media')) {
            foreach ($request->input('social_media') as $link) {
                if (!empty($link['key']) && !empty($link['value'])) {
                    $socialMedia[] = [$link['key'] => $link['value']];
                }
            }
        }
        $data['social_media'] = json_encode($socialMedia); // Encode social media links

        // Dynamically generate localized data
        $localizedData = [];
        foreach (['en', 'ar'] as $locale) {
            $localizedData[$locale] = [
                "name_{$locale}" => $request->input("name_{$locale}"),
                "description_{$locale}" => $request->input("description_{$locale}")
            ];
        }

        // Create the final value payload dynamically
        $value = json_encode(array_merge($localizedData, [
            'links' => $socialMedia,
            'status' => $request->status
        ]));

        // Check if the setting already exists
        if (settings::where('key', $key)->exists()) {
            settings::where('key', $key)->update(['value' => $value]);
            return redirect()->back()->with('success', 'Footer updated successfully');
        } else {
            settings::create(['key' => $key, 'value' => $value]);
            return redirect()->back()->with('success', 'Footer created successfully');
        }
    }

    public function police_store(Request $request)
    {
        // dd("Policy Store");
        $request->validate([
            'title_en' => 'required|string|max:255',
            'title_ar' => 'required|string|max:255',
            'section_title_ar' => 'required|string|max:255',
            'section_title_en' => 'required|string|max:255',

        ]);
        $key = "policy"; // Define the settings key
        $settings = settings::where('key', $key)->first();
        if (!isset($settings)) {
            // If no settings are found, create a default
            $settings = new \stdClass();
            $settings->value = json_encode(['status' => 'on']);
            settings::create([
                'key' => $key,
                'value' => json_encode(['status' => 'on']),
            ]);
        }

        $localizedData = [];
        foreach (['en', 'ar'] as $locale) {
            $localizedData[$locale] = [
                "name_{$locale}" => $request->input("title_{$locale}"),
                "section_title_{$locale}" => $request->input("section_title_{$locale}") //TODO : add section title Edit ya yousseffffffffffffff !!!
            ];
        }

        // Check if the setting already exists
        if (settings::where('key', $key)->exists()) {
            settings::where('key', $key)->update(['value' => json_encode($localizedData)]);
            return redirect()->back()->with('success', 'Police updated successfully');
        } else {
            settings::create(['key' => $key, 'value' => json_encode($localizedData)]);
            return redirect()->back()->with('success', 'Policy created successfully');
        }
    }
    public function side_button_store(Request $request)
    {
        $request->validate([
            'url' => 'required|url|min:3|max:255',
        ]);
        $key = "side-button"; // Define the settings key
        $settings = settings::where('key', $key)->first();
        if (!isset($settings)) {
            // If no settings are found, create a default
            $settings = new \stdClass();
            $settings->value = json_encode(['status' => 'on']);
            settings::create([
                'key' => $key,
                'value' => json_encode(['status' => 'on']),
            ]);
        }
        $value = [
            'url' => $request->url
        ];
        // Check if the setting already exists
        if (settings::where('key', $key)->exists()) {
            settings::where('key', $key)->update(['value' => json_encode($value)]);
            return redirect()->back()->with('success', 'Side Button updated successfully');
        } else {
            settings::create(['key' => $key, 'value' => json_encode($value)]);
            return redirect()->back()->with('success', 'Side Button created successfully');
        }
    }
}
