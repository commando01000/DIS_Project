<?php

namespace App\Http\Controllers;

use App\Models\settings;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    function index()
    {
        // Check if the locale is set in the session; if not, default to 'en'
        if (!Session::has('locale')) {
            Session::put('locale', 'en');  // Set the default locale
        }

        // Get the locale from the session
        $locale = Session::get('locale');
        App::setLocale($locale);

        try {

            return view('Frontend.Home.Index');
        } catch (\Exception $e) {
            // Handle the exception (e.g., log it, show an error message, etc.)
            return redirect()->back()->with('error', 'Error displaying home page: ' . $e->getMessage());
        }
    }
}
