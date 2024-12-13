<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Bank;
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

            return view('Frontend.home.Index', compact('clients', 'projects'));
        } catch (\Exception $e) {
            // Handle the exception (e.g., log it, show an error message, etc.)
            return redirect()->back()->with('error', 'Error displaying home page: ' . $e->getMessage());
        }
    }

    public function profile($name)
    {
        $locale = Session::get('locale', 'en'); // Default to 'en' if no locale is set
        App::setLocale($locale);

        // Find the testimonial by name (case insensitive)
        $testimonial = Testimonial::whereRaw('LOWER(JSON_EXTRACT(name, "$.' . $locale . '")) = ?', [strtolower($name)])->first();
        dd($testimonial);
        if (!$testimonial) {
            abort(404, 'Profile not found'); // Return a 404 error if the profile doesn't exist
        }

        // Decode JSON fields
        $profile = [
            'name' => json_decode($testimonial->name, true)[$locale] ?? 'N/A',
            'role' => json_decode($testimonial->role, true)[$locale] ?? 'N/A',
            'description' => json_decode($testimonial->description, true)[$locale] ?? 'N/A',
            'address' => json_decode($testimonial->address, true)[$locale] ?? 'N/A',
            'image' => $testimonial->image ?? 'default-image.png',
            'social_media' => json_decode($testimonial->social_media, true) ?? [],
        ];

        return view('Frontend.profile.profile', compact('profile'));
    }
}
