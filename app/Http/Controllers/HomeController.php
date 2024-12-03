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
        $locale = Session::get('locale');
        App::setLocale($locale);
        Session::put('locale', $locale);

        $settings = settings::where('key', 'about-us')->first();
        $translations = json_decode($settings->value, true);

        return view('Frontend.Home.Index', compact('translations'));
    }
}
