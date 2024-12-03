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

        $settings = settings::where('key', 'about-us')->first();
        $translations = json_decode($settings->value, true);

        return view('Frontend.Home.Index', compact('translations'));
    }
}
