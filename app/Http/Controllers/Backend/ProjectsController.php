<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Projects;
use App\Models\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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
    public function create()
    {
        return view('Backend.Projects.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $key = 'projects';
        // Handle image upload
        $imagePath = $request->image; // Keep the existing image path if no new image is uploaded
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

        // Update or create settings
        // check for existing settings
        $settingsData = [];

        if (settings::where('key', $key)->exists() && !isset($request->section_title_en) && !isset($request->section_title_ar) && !isset($request->title_en) && !isset($request->title_ar) && !isset($request->status)) {

            $settingsData = json_encode(settings::where('key', $key)->first()->value, true);
        } else if (settings::where('key', $key)->exists() && isset($request->section_title_en) && isset($request->section_title_ar) && isset($request->title_en) && isset($request->title_ar) && isset($request->status)) {
            $request->validate([
                'section_title_en' => 'required|string|min:3|max:255',
                'section_title_ar' => 'required|string|min:3|max:255',
                'title_en' => 'required|string|min:3|max:255',
                'title_ar' => 'required|string|min:3|max:255',
                'status' => 'nullable|string',
                'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    
            ]);
            
            $settingsData = [
                'en' => [
                    'section_title_en' => $request->section_title_en,
                    'title_en' => $request->title_en,
                ],
                'ar' => [
                    'section_title_ar' => $request->section_title_ar,
                    'title_ar' => $request->title_ar,
                ],
                'status' => $request->status
            ];

            settings::where('key', $key)->update([
                'value' => json_encode($settingsData),
            ]);
        } else {

            $settingsData = [
                'en' => [
                    'section_title_en' => $request->section_title_en,
                    'title_en' => $request->title_en,
                ],
                'ar' => [
                    'section_title_ar' => $request->section_title_ar,
                    'title_ar' => $request->title_ar,
                ],
                'status' => $request->status
            ];
            settings::create([
                'key' => $key,
                'value' => json_encode($settingsData),
            ]);
        }

        if ($request->translation != "Save Translation") {

            Projects::create([
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
        }

        return redirect()->route('admin.projects')->with('success', 'Project and settings saved successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Projects $project)
    {
        return view('Backend.Projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Projects $project)
    {
        return view('Backend.Projects.edit', compact('project'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Projects $project)
    {
        // Validate the incoming request
        $request->validate([
            'name_en' => 'required|string|min:3|max:255',
            'name_ar' => 'required|string|min:3|max:255',
            'description_en' => 'required|min:3|string',
            'description_ar' => 'required|min:3|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Handle image upload
        $imagePath = $project->image; // Keep the existing image path if no new image is uploaded

        if ($request->hasFile('image')) {
            $imageName = uniqid() . '.' . $request->file('image')->getClientOriginalExtension();

            // Delete the old image if it exists
            if ($imagePath && file_exists(public_path($imagePath))) {
                unlink(public_path($imagePath));
            }

            // Define the directory where the image will be stored
            $destinationPath = public_path('assets/images/projects');

            // Create the directory if it doesn't exist
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }

            // Move the uploaded file to the desired location
            $request->file('image')->move($destinationPath, $imageName);

            // Save the new image path relative to the public directory
            $imagePath = 'assets/images/projects/' . $imageName;
        }

        // Update project
        $project->update([
            'name' => [
                'en' => $request->name_en,
                'ar' => $request->name_ar,
            ],
            'description' => [
                'en' => $request->description_en,
                'ar' => $request->description_ar,
            ],
            'image' => $imagePath, // Use the correct image path
        ]);

        return redirect()->route('admin.projects')->with('success', 'Project updated successfully.');
    }




    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Projects $project)
    {
        // Delete project image if exists
        if ($project->image && Storage::disk('public')->exists($project->image)) {
            Storage::disk('public')->delete($project->image);
        }

        $project->delete();

        return redirect()->route('admin.projects')->with('success', 'Project deleted successfully.');
    }

    public function getProjectData(Projects $project, $id)
    {
        $project = $project::find($id);

        if ($project) {
            return response()->json([
                'success' => true,
                'data' => $project,
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Project not found.',
        ]);
    }
}
