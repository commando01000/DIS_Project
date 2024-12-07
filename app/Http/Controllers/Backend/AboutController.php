<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\settings;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $settings = settings::where('key', 'about-us')->first();
        if (!isset($settings)) {
            // If no settings are found, create a default
            $settings = new \stdClass();
            $settings->value = json_encode(['status' => 'on']);
        }
        $status = "off";

        if (isset($settings) && isset($settings->value)) {
            $settings = json_decode($settings->value, true);
            return view('Backend.About.index', compact('settings'));
        } else {
            return view('Backend.About.index', compact('settings'));
        }
    }




    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $key = "about-us";

        // check if the key already exists or not
        if (settings::where('key', $key)->exists()) {
            settings::where('key', $key)->update([
                'value' => json_encode([
                    'en' => [
                        'section_title' => $request->section_title_en,
                        'title' => $request->title_en,
                        'description' => $request->description_en,
                    ],
                    'ar' => [
                        'section_title' => $request->section_title_ar,
                        'title' => $request->title_ar,
                        'description' => $request->description_ar,
                    ],
                    'status' => $request->status
                ])
            ]);
            return redirect()->back()->with('success', 'About us updated successfully');
        } else {
            settings::create([
                'key' => $key,
                'value' => json_encode([
                    'en' => [
                        'section_title' => $request->section_title_en,
                        'title' => $request->title_en,
                        'description' => $request->description_en,
                    ],
                    'ar' => [
                        'section_title' => $request->section_title_ar,
                        'title' => $request->title_ar,
                        'description' => $request->description_ar,
                    ],
                    'status' => $request->status
                ])
            ]);
            return redirect()->back()->with('success', 'About us created successfully');
        }
        
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
