<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Backend\SettingsController;
use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\Contact;
use App\Models\Projects;
use App\Models\settings;
use App\Models\Testimonial;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use PHPUnit\Event\Code\Test;

class HomeController extends Controller
{
    //
    function index()
    {
        try {

            // Check if the locale is set in the session; if not, default to 'en'
            if (!Session::has('locale')) {
                Session::put('locale', 'en');  // Set the default locale
            }

            // Get the locale from the session
            $locale = Session::get('locale');
            App::setLocale($locale);

            // cache the data instead of continuously querying the database
            $clients = cache()->remember('clients', now()->addMinutes(30), function () {
                return Bank::with('modules')->get();
            });

            $projects = cache()->remember('projects', now()->addMinutes(30), function () {
                return Projects::paginate(9);
            });

            $settings = cache()->remember('settings', now()->addMinutes(30), function () {
                return Settings::paginate(9);
            });

            $testimonials = cache()->remember('testimonials', now()->addMinutes(30), function () {
                return Testimonial::paginate(9)->map(function ($testimonial) {
                    $testimonial->name = json_decode($testimonial->name, true);
                    $testimonial->role = json_decode($testimonial->role, true);
                    $testimonial->description = json_decode($testimonial->description, true);
                    $testimonial->social_media = json_decode($testimonial->social_media, true);
                    return $testimonial;
                });
            });
            // dd($testimonials);
            return view('Frontend.home.Index', compact('clients', 'projects', 'settings', 'testimonials'));
        } catch (\Exception $e) {
            // Handle the exception (e.g., log it, show an error message, etc.)
            return redirect()->back()->with('error', 'Error displaying home page: ' . $e->getMessage());
        }
    }
    // public function profile($id)
    // {
    //     $locale = Session::get('locale', 'en'); // Default to 'en' if no locale is set
    //     App::setLocale($locale);

    //     // Find the testimonial by name (case insensitive)
    //     // $testimonial = Testimonial::pluck('name')->search($name);
    //     $testimonial = Testimonial::findOrFail($id);

    //     // decode the testimonial
    //     $testimonial->name = json_decode($testimonial->name, true);
    //     $testimonial->role = json_decode($testimonial->role, true);
    //     $testimonial->description = json_decode($testimonial->description, true);
    //     $testimonial->social_media = json_decode($testimonial->social_media, true);

    //     if (!$testimonial) {
    //         abort(404, 'Profile not found'); // Return a 404 error if the profile doesn't exist
    //     }

    //     // Decode JSON fields
    //     // Decode JSON fields and extract the localized data
    //     $profile = [
    //         'name' => $testimonial->name[$locale] ?? 'N/A',
    //         'role' => $testimonial->role[$locale] ?? 'N/A',
    //         'description' => $testimonial->description[$locale] ?? 'N/A',
    //         'image' => $testimonial->image ?? 'default-image.png',
    //         'social_media' => $testimonial->social_media ? $testimonial->social_media : [],
    //     ];
    //     return view('Frontend.profile.index', compact('profile'));
    // }
    // public function team($name)
    // {
    //     $locale = Session::get('locale', 'en'); // Default to 'en' if no locale is set
    //     App::setLocale($locale);

    //     // Find the testimonial by name (case insensitive)
    //     // $testimonial = Testimonial::pluck('name')->search($name);
    //     $testimonial = Testimonial::where('name->en', $name)->first();
    //     // dd($testimonial);
    //     if (!$testimonial) {
    //         abort(404, 'Profile not found'); // Return a 404 error if the profile doesn't exist
    //     }

    //     // Decode JSON fields
    //     // Decode JSON fields and extract the localized data
    //     $profile = [
    //         'name' => $testimonial->name[$locale] ?? 'N/A',
    //         'role' => $testimonial->role[$locale] ?? 'N/A',
    //         'description' => $testimonial->description[$locale] ?? 'N/A',
    //         'address' => $testimonial->address[$locale] ?? 'N/A',
    //         'image' => $testimonial->image ?? 'default-image.png',
    //         'social_media' => $testimonial->social_media ? json_decode($testimonial->social_media, true) : [],
    //     ];
    //     // dd($profile);
    //     return view('Frontend.team.index', compact('team'));
    // }

    public function Contact_store(Request $request)
    {

        // Validation rules
        $validations = [
            'name' => 'required|string|max:255',
            'mail' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:255',
        ];

        // dd($request->all());

        $validated = $request->validate($validations);
        Contact::create([
            'name' => $validated['name'],
            'mail' => $validated['mail'],
            'subject' => $validated['subject'],
            'message' => $validated['message'],

        ]);

        return redirect('/')->with('success', 'Bank created successfully.');
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
}
