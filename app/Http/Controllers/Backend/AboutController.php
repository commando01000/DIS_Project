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

        if (isset($settings) && $settings->value) {
            $translations = json_decode($settings->value, true);
        }

        if (isset($settings->value) && isset($translations)) {
            return view('Backend.About.index', compact('translations'));
        } else {
            return view('Backend.About.index');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

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
                    ]
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
                    ]
                ])
            ]);
            return redirect()->back()->with('success', 'About us created successfully');
        }
        return redirect()->back()->with('error', 'Something went wrong');
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
