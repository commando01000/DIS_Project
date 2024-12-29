<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    // Display a listing of the users
    public function index()
    {
        
        $users = User::all();
        return view('Backend.users.index', compact('users'));
    }

    // Show the form for creating a new user
    public function create()
    {
        return view('Backend.users.create');
    }


    // Store a newly created user in storage.
    public function store(Request $request)
    {
        // dd(request()->all());
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'is_admin' => 'nullable|boolean',
        ]);

        $photoPath = null;
        if ($request->hasFile('photo')) {
            $destinationPath = public_path('assets/images/users'); // Define the folder path

            // Check if the folder exists, if not, create it
            if (!is_dir($destinationPath)) {
                mkdir($destinationPath, 0777, true); // Create the folder with appropriate permissions
            }

            $imageName = uniqid() . '.' . $request->file('photo')->getClientOriginalExtension();
            $request->file('photo')->move($destinationPath, $imageName); // Move the file to the destination
            $photoPath = 'assets/images/users/' . $imageName; // Save the path relative to the public directory
        }

        // Add default value for is_admin if not set
        $isAdmin = $request->input('is_admin', 0); // Get 'is_admin' or default to 0    
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'photo' => $photoPath,
            'is_admin' => $isAdmin,
        ]);

        return redirect()->route('admin.users')->with('success', 'User created successfully!');
    }

    // Display the specified user
    public function show(User $user)
    {
        return view('Backend.users.show', compact('user'));
    }

    // Show the form for editing the specified user
    public function edit($id)
    {   
        $user = User::find($id);
        $users = User::all();
        
        return view('Backend.users.index', compact('users', 'user' ));
    }

    // Update the specified user in storage
    public function update(Request $request)
    {
        // $request->validate([
        //     'name' => 'required|string|max:255',
        //     'email' => 'required|string|email|max:255|unique:users',
        //     'password' => 'required|string|min:8',
        //     'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        //     'is_admin' => 'nullable|boolean',
        // ]);

        dd(request()->all());

        $photoPath = $user->photo;
        if ($request->hasFile('photo')) {
            $destinationPath = public_path('assets/images/profiles/users'); // Define the folder path

            // Check if the folder exists, if not, create it
            if (!is_dir($destinationPath)) {
                mkdir($destinationPath, 0777, true); // Create the folder with appropriate permissions
            }

            $imageName = uniqid() . '.' . $request->file('photo')->getClientOriginalExtension();
            $request->file('photo')->move($destinationPath, $imageName); // Move the file to the destination

            // Delete old photo if exists
            if ($user->photo && file_exists(public_path($user->photo))) {
                unlink(public_path($user->photo));
            }

            $photoPath = 'assets/images/users/' . $imageName; // Save the path relative to the public directory
        }

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
            'photo' => $photoPath,
            'is_admin' => $request->has('is_admin'),
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully!');
    }

    // Remove the specified user from storage
    public function destroy(User $user, $id)
    {
        if ($user->photo && file_exists(public_path($user->photo))) {
            unlink(public_path($user->photo));
        }
        $user = User::find($id);

        $user->delete();

        return redirect()->route('admin.users')->with('success', 'User deleted successfully!');
    }
}
