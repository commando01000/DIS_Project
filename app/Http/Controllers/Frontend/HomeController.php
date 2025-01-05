<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\AutomatedReply;
use App\Mail\CompanyContact;
use App\Models\Bank;
use App\Models\Contact;
use App\Models\Email;
use App\Models\Projects;
use App\Models\settings;
use App\Models\Testimonial;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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

            // increment the total visits with one when this page is loaded
            Settings::firstOrCreate(['key' => 'total_visits'], ['value' => 0]);
            // cache the data instead of continuously querying the database
            $clients = Bank::with('modules')->get();

            $settings = cache()->remember('settings', now()->addMinutes(10), function () {
                return Settings::all();
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
            $swipers = Settings::getSettingValue('swiper')['swiper-data'] ?? [];
            $footer = Settings::getSettingValue('footer') ?? [];
            $contacts_filters = Settings::getSettingValue('contacts_filters')['filter-data'] ?? [];

            if ($request->ajax()) {
                if ($request->section === 'projects') {
                    return view('Frontend.projects.project_cards', compact('projects'))->render();
                } elseif ($request->section === 'testimonials') {
                    return view('Frontend.team.team_cards', compact('testimonials'))->render();
                }
            }

            // if ($request->route()->getName() == 'home' && !$request->ajax()) {
            //     Settings::where('key', 'total_visits')->increment('value', 1);
            // }


            /* code block you provided is a conditional check to increment the total visits count
            when the home route is accessed and it is not an AJAX request. Here is a breakdown of what each part
            of the code is doing: */
            if ($request->route()->getName() == 'home' && !$request->ajax()) {
                logger('Route Name:', [$request->route()->getName()]);
                if (!$request->session()->has('visited_home')) {
                    logger('Route Name:', [$request->route()->getName()]);
            
                    // Fetch the record
                    $settings = Settings::where('key', 'total_visits')->first();
            
                    if ($settings) {
                        // Decode the JSON value, increment it, and re-encode it
                        $currentValue = json_decode($settings->value, true);
                        $newValue = $currentValue + 1;
            
                        // Update the value in the database
                        $settings->update(['value' => json_encode($newValue)]);
                    } else {
                        // Handle the case where the key 'total_visits' does not exist
                        Settings::create([
                            'key' => 'total_visits',
                            'value' => json_encode(1),
                        ]);
                    }
            
                    // Set session variable to prevent multiple increments
                    $request->session()->put('visited_home', true);
                }
            }
            


            // dd($testimonials);
            return view('Frontend.home.Index', compact('clients', 'projects', 'settings', 'testimonials', 'swipers', 'footer', 'contacts_filters'));
        } catch (\Exception $e) {
            // Handle the exception (e.g., log it, show an error message, etc.)
            return redirect()->back()->with('error', 'Error displaying home page: ' . $e->getMessage());
        }
    }

    public function Contact_store(Request $request)
    {

        // dd($request->all());

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'nationality' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'email-category' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:255',
        ]);
        
        // dd($validated); // This will show you the validated data.
        
        Contact::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'nationality' => $validated['nationality'],
            'category' => $validated['email-category'],
            'subject' => $validated['subject'],
            'message' => $validated['message'],
        ]);
        


        // Load the companies accounts from the file
        $companies = include base_path('companies_accounts.php');

        //send an email to those companies
        // Send emails to all companies
        // prepare email 
        $email = new Email();
        $email->subject = $validated['subject'];
        // static message that will be sent to the user 
        $email->body = $validated['message'];
        foreach ($companies as $company) {
            Mail::to($company['email'])->send(new CompanyContact($email));
        }

        $email = new Email();
        $email->subject = $validated['subject'];
        // static message that will be sent to the user 
        $email->body = $validated['message'];
        Mail::to($validated['email'])->send(new AutomatedReply($email));
        return redirect()->back()->with('success', 'We will get in touch with you soon !');
    }
}
