<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
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
        $user = auth()->user();
        return view('Backend.dashboard.index', compact('user')); // Corrected path
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

    public function update_profile(Request $request, User $user)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users,email,' . auth()->user()->id,
                'password' => 'nullable|string|min:8|confirmed|regex:/^(?=.*[A-Z])(?=.*\d).*$/',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ], [
                'password.regex' => 'The password must contain at least one uppercase letter and one number.',
                'image.max' => 'The image size must not exceed 2MB.',
            ]);

            $user = User::find(auth()->user()->id);
            $imagePath = $request->image;

            if ($request->hasFile('image')) {
                $destinationPath = public_path('assets/images/profiles/users');
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0777, true);
                }

                $imageName = uniqid() . '.' . $request->file('image')->getClientOriginalExtension();
                $request->file('image')->move($destinationPath, $imageName);
                $imagePath = 'assets/images/profiles/users/' . $imageName;
            }

            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'photo' => $imagePath
            ]);

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
}
