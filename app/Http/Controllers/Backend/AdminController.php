<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    // Show the settings form
    // Handle the settings form submission
    public function index()
    {
        // Check if the locale is set in the session; if not, default to 'en'
        if (!Session::has('locale')) {
            Session::put('locale', 'en');  // Set the default locale
        }
        // Get the locale from the session
        $locale = Session::get('locale');
        App::setLocale($locale);
        return view('Backend.dashboard.index'); // Corrected path
    }


    public function showPasswordForm()
    {
        $admin = auth()->user()->is_admin; // Replace 1 with an existing ID.

        // dd($admin);
        if (!$admin) {
            return redirect()->route('admin.login')->with('error', 'You must be logged in to access this page.');
        }
        $locale = Session::get('locale');
        App::setLocale($locale);
        Session::put('locale', $locale);

        return view('Backend.Authentication.changepassword', compact('admin'));
    }

    public function updatePassword(Request $request)
    {
        // Get the logged-in admin using the correct guard
        $admin = auth()->user();


        // Validate the form input
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users,email,' . $admin->id, // Correct the table reference
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        // If validation fails, return with errors
        if ($validator->fails()) {
            $locale = Session::get('locale');
            App::setLocale($locale);
            Session::put('locale', $locale);

            return redirect()->route('admin.dashboard')
                ->withErrors($validator)
                ->withInput();
        }

        // Check if the current password is correct
        if (!Hash::check($request->current_password, $admin->password)) {
            return redirect()->route('admin.settings')
                ->with('error', 'Current password is incorrect');
        }

        // Update the email and password
        $admin->email = $request->email;
        $admin->password = Hash::make($request->new_password);
        $admin->save();

        // Return with success message
        return redirect()->route('admin.password')
            ->with('success', 'Settings updated successfully');
    }
}
