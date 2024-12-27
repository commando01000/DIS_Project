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

class HomeController extends Controller
{
    //
    public function index(Request $request)
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
            $clients = Bank::with('modules')->get();

            $settings = cache()->remember('settings', now()->addMinutes(10), function () {
                return Settings::paginate(9);
            });

            $projects = Projects::paginate(3);

            $testimonials = Testimonial::paginate(3);

            $testimonials->getCollection()->transform(function ($testimonial) {
                $testimonial->name = json_decode($testimonial->name, true);
                $testimonial->role = json_decode($testimonial->role, true);
                $testimonial->description = json_decode($testimonial->description, true);
                $testimonial->social_media = json_decode($testimonial->social_media, true);
                return $testimonial;
            });
            $swipers = Settings::getSettingValue('swiper')['swiper-data'];

            $footer = Settings::getSettingValue('footer');
            if ($request->ajax()) {
                if ($request->section === 'projects') {
                    return view('Frontend.projects.project_cards', compact('projects'))->render();
                } elseif ($request->section === 'testimonials') {
                    return view('Frontend.team.team_cards', compact('testimonials'))->render();
                }
            }
            // dd($testimonials);
            return view('Frontend.home.Index', compact('clients', 'projects', 'settings', 'testimonials', 'swipers', 'footer'));
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
