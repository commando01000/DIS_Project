<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use App\Http\Controllers\Controller;
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

    public function update_profile(Request $request)
    {
        // dd($request->all());
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users,email,' . auth()->user()->id,
                'password' => 'nullable|string|min:8|confirmed',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            ]);

            $user = User::find(auth()->user()->id);
            // check if the request has photo
            $imagePath = $request->image; // Keep the existing image path if no new image is uploaded
            if ($request->hasFile('image')) {
                // Define the directory where the image will be stored
                $destinationPath = public_path('assets/images/profiles/users');

                // Create the directory if it doesn't exist
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0777, true);
                }

                // Generate a unique name for the image or use a specific name
                $imageName = uniqid() . '.' . $request->file('image')->getClientOriginalExtension();

                // Move the uploaded file to the desired location
                $request->file('image')->move($destinationPath, $imageName);

                // Save the image path relative to the public directory
                $imagePath = 'assets/images/profiles/users/' . $imageName;
            }

            // update user data
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'photo' => $imagePath
            ]);

            // Update password only if a new password is provided
            if ($request->filled('password')) {
                $user->update([
                    'password' => bcrypt($request->password),
                ]);
            }

            return redirect()->back()->with('success', 'Profile updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
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
