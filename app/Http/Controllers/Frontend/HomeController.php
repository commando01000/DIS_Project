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

}
