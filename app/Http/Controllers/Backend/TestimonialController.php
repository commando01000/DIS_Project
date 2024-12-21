<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\settings;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use PHPUnit\Event\Code\Test;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $settings = settings::where('key', 'testimonials')->first();
        if (!isset($settings)) {
            // If no settings are found, create a default
            $settings = new \stdClass();
            $settings->value = json_encode(['status' => 'on']);
            settings::create([
                'key' => 'testimonials',
                'value' => json_encode(['status' => 'on']),
            ]);
        }
        if (isset($settings) && isset($settings->value)) {
            $settings = json_decode($settings->value, true);
        }
        $testimonials = Testimonial::all()->map(function ($testimonial) {
            $testimonial->name = json_decode($testimonial->name, true);
            $testimonial->role = json_decode($testimonial->role, true);
            $testimonial->description = json_decode($testimonial->description, true);
            $testimonial->social_media = json_decode($testimonial->social_media, true);
            return $testimonial;
        });
        return view('Backend.Testimonials.index', compact('settings', 'testimonials'));
    }
    public function create(Testimonial $testimonials)
    
    {
        $testimonials = Testimonial::paginate(9);
        return view('Backend.Testimonials.create', compact('testimonials'));
    }

    public function update_translation(Request $request)
    {
        $key = 'testimonials';

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


        if (settings::where('key', $key)->exists() && isset($request->section_title_en) && isset($request->section_title_ar) && isset($request->title_en) && isset($request->title_ar) && isset($request->status)) {
            $request->validate([
                'section_title_en' => 'required|string|min:3|max:255',
                'section_title_ar' => 'required|string|min:3|max:255',
                'title_en' => 'required|string|min:3|max:255',
                'title_ar' => 'required|string|min:3|max:255',
                'status' => 'nullable|string',

            ]);

            settings::where('key', $key)->update([
                'value' => json_encode($settingsData),
            ]);
        } else {
            settings::create([
                'key' => $key,
                'value' => json_encode($settingsData),
            ]);
        }
        return redirect()->route('admin.testimonials')->with('success', 'Testimonials Translation saved successfully.');
    }

    /**
     * Show the form for creating a new resource.
     */


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validation rules
        $request->validate([
            'name.en' => 'required|string|max:255',
            'name.ar' => 'required|string|max:255',
            'role.en' => 'required|string|max:255',
            'role.ar' => 'required|string|max:255',
            'description.en' => 'required|string',
            'description.ar' => 'required|string',

            'social_media' => 'nullable|array', // Social media must be an array, but it’s optional
            'social_media.*.key' => 'nullable|string|max:255', // Validate each key as a string
            'social_media.*.value' => 'nullable', // Validate each value as a URL
        ]);

        // Prepare the data for saving
        $data = $request->except('image', 'social_media');

        // Handle image upload
        if ($request->hasFile('image')) {
            $destinationPath = public_path('assets/images/testimonials'); // Define the folder path

            // Check if the folder exists, if not, create it
            if (!is_dir($destinationPath)) {
                mkdir($destinationPath, 0777, true); // Create the folder with appropriate permissions
            }

            $imageName = uniqid() . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move($destinationPath, $imageName); // Move the file to the destination
            $data['image'] = 'assets/images/testimonials/' . $imageName; // Save the path relative to the public directory
        }

        // Handle the social media
        if ($request->has('social_media')) {
            $socialMedia = [];
            foreach ($request->input('social_media') as $link) {
                // Ensure both key and value are provided
                if (!empty($link['key']) && !empty($link['value'])) {
                    $socialMedia[$link['key']] = $link['value'];
                }
            }

            // Save the social media as JSON in your data array
            $data['social_media'] = json_encode($socialMedia);
        }

        // Handle the name
        if ($request->has('name') && isset($request->name['en'], $request->name['ar'])) {
            $data['name'] = json_encode([
                'en' => $request->name['en'],
                'ar' => $request->name['ar'],
            ]);
        }

        // Handle the role
        if ($request->has('role') && isset($request->role['en'], $request->role['ar'])) {
            $data['role'] = json_encode([
                'en' => $request->role['en'],
                'ar' => $request->role['ar'],
            ]);
        }

        // Handle the description
        if ($request->has('description') && isset($request->description['en'], $request->description['ar'])) {
            $data['description'] = json_encode([
                'en' => $request->description['en'],
                'ar' => $request->description['ar'],
            ]);
        }

        // Create the testimonial
        Testimonial::create($data);

        return redirect()->route('admin.testimonials')->with('success', 'Testimonial created successfully');
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
        $testimonial = Testimonial::findOrFail($id);
        // map the testimonial
        // Decode JSON fields if needed
        $testimonial->name = json_decode($testimonial->name, true);
        $testimonial->role = json_decode($testimonial->role, true);
        $testimonial->description = json_decode($testimonial->description, true);
        $testimonial->social_media = json_decode($testimonial->social_media, true);
        return view('Backend.Testimonials.edit', compact('testimonial'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Find the testimonial by ID
        $testimonial = Testimonial::findOrFail($id);

        // Validation rules
        // Validation rules
        $request->validate([
            'name.en' => 'required|string|max:255',
            'name.ar' => 'required|string|max:255',
            'role.en' => 'required|string|max:255',
            'role.ar' => 'required|string|max:255',
            'description.en' => 'required|string',
            'description.ar' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'social_media' => 'nullable|array', // Social media must be an array, but it’s optional
            'social_media.*.key' => 'nullable|string|max:255', // Validate each key as a string
            'social_media.*.value' => 'nullable', // Validate each value as a URL
        ]);
        // Prepare the data for updating
        $data = $request->except('image', 'social_media');

        // Handle image upload
        if ($request->hasFile('image')) {
            $destinationPath = public_path('assets/images/testimonials'); // Define the folder path

            // Check if the folder exists, if not, create it
            if (!is_dir($destinationPath)) {
                mkdir($destinationPath, 0777, true); // Create the folder with appropriate permissions
            }

            // Delete the old image if it exists
            if ($testimonial->image && file_exists(public_path($testimonial->image))) {
                unlink(public_path($testimonial->image));
            }

            $imageName = uniqid() . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move($destinationPath, $imageName); // Move the file to the destination
            $data['image'] = 'assets/images/testimonials/' . $imageName; // Save the path relative to the public directory
        }

        // Handle the social media
        if ($request->has('social_media')) {
            $socialMedia = [];
            foreach ($request->input('social_media') as $link) {
                // Check if both key and value are provided
                if (!empty($link['key']) && !empty($link['value'])) {
                    $socialMedia[$link['key']] = $link['value'];
                }
            }

            // Save the social media as JSON in your data array
            $data['social_media'] = json_encode($socialMedia);
        }


        // Update multilingual fields
        $data['name'] = json_encode([
            'en' => $request->name['en'],
            'ar' => $request->name['ar'],
        ]);

        $data['role'] = json_encode([
            'en' => $request->role['en'],
            'ar' => $request->role['ar'],
        ]);

        $data['description'] = json_encode([
            'en' => $request->description['en'],
            'ar' => $request->description['ar'],
        ]);


        // Update the testimonial
        $testimonial->update($data);

        return redirect()->route('admin.testimonials')->with('success', 'Testimonial updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
/**
 * Remove the specified resource from storage.
 */
public function destroy(Testimonial $testimonial, Log $log)
{
    try {
        // Check if the testimonial has an associated image and delete it
        if ($testimonial->image && file_exists(public_path($testimonial->image))) {
            unlink(public_path($testimonial->image)); // Delete the image file
        }

        // Delete the testimonial from the database
        $testimonial->delete();

        // Redirect back to the testimonials list with a success message
        return redirect()->route('admin.testimonials')->with('success', 'Testimonial deleted successfully.');
    } catch (\Exception $e) {
        // If an error occurs, log it and return an error message to the user
        $log::error('Error deleting testimonial: ' . $e->getMessage());

        // Redirect back with an error message
        return redirect()->route('admin.testimonials')->with('error', 'Failed to delete testimonial. Please try again.');
    }
}

}
