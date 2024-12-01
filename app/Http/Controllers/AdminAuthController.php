<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
/**
 * Handles admin authentication.
 */
class AdminAuthController extends Controller
{
    /**
     * Redirect the user after a successful login.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return \Illuminate\Http\Response
     */
    protected function authenticated(Request $request, $user)
    {
        return redirect()->route('admin.settings');
    }

    /**
     * Show the admin login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        $locale = Session::get('locale');
        App::setLocale($locale);
        Session::put('locale', $locale);
        return view('Backend/Authentication/login'); // Ensure you have a 'login' view in the 'admin' folder
    }

    /**
     * Handle admin login.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        // Validate the request
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // get the user 
        $user = User::where('email', $request->email)->first();

        // Attempt to log in using the 'admin' guard

        // Attempt login using the default 'web' guard
        if (Auth::attempt($request->only('email', 'password'))) {
            // Check if the authenticated user is an admin
            if (Auth::user()->is_admin) {
                $request->session()->regenerate();

                // Redirect to the admin dashboard
                return redirect()->route('admin.dashboard');
            }

            // If not an admin, log out and return an error
            Auth::logout();
            return back()->withErrors([
                'email' => 'You are not authorized to access the admin area.',
            ]);
        }

        // Return back with an error message
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
            'password' => 'The provided credentials do not match our records.',
        ]);
    }

    /**
     * Logout the admin.
     *
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        Auth::logout();
        $locale = Session::get('locale');
        App::setLocale($locale);
        Session::put('locale', $locale);
        return redirect()->route('admin.login'); // Redirect to the login page
    }
}
