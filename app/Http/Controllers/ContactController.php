<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class ContactController extends Controller
{
    public function index()
    {
        $locale = Session::get('locale');
        App::setLocale($locale);
        Session::put('locale', $locale);

        return view('Frontend.Contact-us.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'full_name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
        ]);

        $name = $request->input('name');
        $email = $request->input('email');
        $message = $request->input('message');

        // You can also store the contact information in a database

        return redirect()->back()->with('success', 'Your message has been sent successfully.');
    }
}
