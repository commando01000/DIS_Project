<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;

class LanguageController extends Controller
{
    public function switchLocale($locale)
    {
        if (in_array($locale, ['en', 'ar'])) {
            app()->setLocale($locale);
            session()->put('locale', $locale);
        }

        return redirect()->back();
    }
}
