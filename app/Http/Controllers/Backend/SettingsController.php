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
        // $settings['address'] = settings::firstOrCreate(
        //     ['key' => 'address'], // Search criteria
        //     ['value' => null]    // Values to set if record does not exist
        // );

        // $settings['social-media'] = settings::firstOrCreate(
        //     ['key' => 'social-media'], // Search criteria
        //     ['value' => null]         // Values to set if record does not exist
        // );

        // $settings['contact'] = settings::firstOrCreate(
        //     ['key' => 'phone'], // Search criteria
        //     ['value' => null]  // Values to set if record does not exist
        // );

        // $settings['email'] = settings::firstOrCreate(
        //     ['key' => 'email'], // Search criteria
        //     ['value' => null]  // Values to set if record does not exist
        // );

        return view('Backend.Settings.index', compact('settings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function slider(Request $request)
    {
        $request->validate([
            'title_en' => 'required|string|max:255',
            'title_ar' => 'required|string|max:255',
            'description_en' => 'required|string|max:255',
            'description_ar' => 'required|string|max:255',
        ]);
        $key = "top-slider"; // Define the settings key
        
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
    public function create()
    {
        //
        // return view('Backend.Settings.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
