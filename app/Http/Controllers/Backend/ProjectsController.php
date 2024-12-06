<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\settings;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    public function index()
    {
        $settings = settings::where('key', 'modules')->first();
        if (!isset($settings)) {
            // If no settings are found, create a default
            $settings = new \stdClass();
            $settings->value = json_encode(['status' => 'on']);
        }
        $status = "off";

        return view('Backend.Projects.index', compact('settings'));
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
        $key = "projects";
        // Validate input
        // $request->validate([
        //     'section_en' => 'required|string',
        //     'title_en' => 'required|string',
        //     'name_en' => 'required|string',
        //     'description_en' => 'required|string',
        //     'section_ar' => 'required|string',
        //     'title_ar' => 'required|string',
        //     'name_ar' => 'required|string',
        //     'description_ar' => 'required|string',
        //     'status' => 'required|string',
        //     'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        // ]);

        // Handle logo file upload
        $logoPath = null;
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $logoPath = 'asset/images/' . time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('asset/images'), $logoPath);
        }
        // check if the key already exists or not 
        if (settings::where('key', $key)->exists()) {
            settings::where('key', $key)->update([
                'value' => json_encode([
                    'en' => [
                        'section_en' => $request->section_en,
                        'title_en' => $request->title_en,
                        'name_en' => $request->name_en,
                        'description_en' => $request->description_en,
                    ],
                    'ar' => [
                        'section_ar' => $request->section_ar,
                        'title_ar' => $request->title_ar,
                        'name_ar' => $request->name_ar,
                        'description_ar' => $request->description_ar,
                    ],
                    'status' => $request->status,
                    'logo' => $request->logo,
                ])
            ]);
            return redirect()->back()->with('success', 'About us updated successfully');
        } else {
            settings::create([
                'key' => $key,
                'value' => json_encode([
                    'en' => [
                        'section_en' => $request->section_en,
                        'title_en' => $request->title_en,
                        'name_en' => $request->name_en,
                        'description_en' => $request->description_en,
                    ],
                    'ar' => [
                        'section_ar' => $request->section_ar,
                        'title_ar' => $request->title_ar,
                        'name_ar' => $request->name_ar,
                        'description_ar' => $request->description_ar,
                    ],
                    'status' => $request->status,
                    'logo' => $request->logo,
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

