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
        // Get the projects settings or create default if not exists
        $settings = Settings::firstOrCreate(
            ['key' => 'projects'],
            ['value' => json_encode(['status' => 'on'])]
        );

        // Decode the settings value
        $settings->value = json_decode($settings->value, true);

        // Get all projects
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
        // $request->validate([
        //     'section_title_en' => 'required|string|max:255',
        //     'section_title_ar' => 'required|string|max:255',
        //     'title_en' => 'required|string|max:255',
        //     'title_ar' => 'required|string|max:255',
        //     'name_en' => 'required|string|max:255',
        //     'name_ar' => 'required|string|max:255',
        //     'description_en' => 'required|string',
        //     'description_ar' => 'required|string',
        //     'status' => 'nullable|string',
        //     'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        // ]);

        // Handle image upload

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

        Settings::updateOrCreate(
            ['key' => 'projects'],
            ['value' => json_encode($settingsData)]
        );

        // Save project to the database
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
            'name_en' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
            'description_en' => 'required|string',
            'description_ar' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
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
}
