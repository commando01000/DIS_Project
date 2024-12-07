<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Projects;
use App\Models\settings;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    public function index()
    {
        $settings = settings::where('key', 'projects')->first();
        if (!isset($settings)) {
            // If no settings are found, create a default
            $settings = new \stdClass();
            $settings->value = json_encode(['status' => 'on']);
            settings::create([
                'key' => 'projects',
                'value' => json_encode(['status' => 'on']),
            ]);
        }
        $status = "off";
        if (isset($settings) && isset($settings->value)) {
            $settings = json_decode($settings->value, true);
        }
        $projects = Projects::all();
        return view('Backend.Projects.index', compact('settings', 'projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(settings $setting)
    {
        return view('Backend.Projects.create', compact('setting')); // Adjust this to your create view path
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // $request->validate([
        //     'section_title_en' => 'required|string|max:255',
        //     'section_title_ar' => 'required|string|max:255',
        //     'title_en' => 'required|string|max:255',
        //     'title_ar' => 'required|string|max:255',
        //     'name_en' => 'required|string|max:255',
        //     'name_ar' => 'required|string|max:255',
        //     'description_en' => 'required|string',
        //     'description_ar' => 'required|string',
        //     'status' => 'required|string',
        //     'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        // ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            // Define the directory where the image will be stored
            $destinationPath = public_path('assets/images/projects');

            // Create the directory if it doesn't exist
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }

            // Generate a unique name for the image or use a specific name
            $imageName = uniqid() . '.' . $request->file('image')->getClientOriginalExtension();

            // Move the uploaded file to the desired location
            $request->file('image')->move($destinationPath, $imageName);

            // Save the image path relative to the public directory
            $imagePath = 'assets/images/projects/' . $imageName;
        }

        // Save to settings model
        $key = 'projects';
        $settingsData = [
            'en' => [
                'section_title_en' => $request->section_title_en,
                'title_en' => $request->title_en,
            ],
            'ar' => [
                'section_title_ar' => $request->section_title_ar,
                'title_ar' => $request->title_ar,
            ],
            'status' => $request->status,
        ];

        if (settings::where('key', $key)->exists()) {

            settings::where('key', $key)->update([
                'value' => json_encode($settingsData),
            ]);
        } else {

            settings::create([
                'key' => $key,
                'value' => json_encode($settingsData),
            ]);
        }

        // Save to projects model
        try {
            Projects::create([
                'name' => [
                'name' => [
                    'en' => $request->name_en,
                    'ar' => $request->name_ar,
                ],
                'description' => [
                    'en' => $request->description_en,
                    'ar' => $request->description_ar,
                ],
                'image' => $imagePath,
            ]);

            return redirect()->back()->with('success', 'Project and settings saved successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to save project and settings. Error: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $project = Projects::findOrFail($id);
        return view('Backend.Projects.show', compact('project')); // Adjust this to your show view path
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $project = Projects::findOrFail($id);
        return view('Backend.Projects.edit', compact('project')); // Adjust this to your edit view path
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id) {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $project = Projects::findOrFail($id);
        if ($project->logo && file_exists(public_path($project->logo))) {
            unlink(public_path($project->logo));
        }
        $project->delete();

        return redirect()->back()->with('success', 'Project deleted successfully!');
    }
}
