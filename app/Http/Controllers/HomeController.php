<?php

namespace App\Http\Controllers;

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
        return view('Frontend.Home.Index');
    }
}
