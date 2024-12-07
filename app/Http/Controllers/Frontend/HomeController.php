<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\Projects;
use App\Models\settings;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

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

            $clients = Bank::with('modules')->get();
            // get paginated projects data
            $projects = Projects::paginate(9);
            return view('Frontend.home.Index', compact('clients', 'projects'));
        } catch (\Exception $e) {
            // Handle the exception (e.g., log it, show an error message, etc.)
            return redirect()->back()->with('error', 'Error displaying home page: ' . $e->getMessage());
        }
    }
}
