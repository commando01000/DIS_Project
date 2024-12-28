<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Mail\CustomEmail;
use App\Models\Email;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailsController extends Controller
{
    /**
     * Display a listing of the emails.
     */
    public function index()
    {
        $emails = Email::with('recipients')->get(); // Eager load recipients
        return view('Backend.emails.index', compact('emails'));
    }

    /**
     * Show the form for creating a new email.
     */
    public function create()
    {
        $users = User::all(); // Fetch all users to display in the "To" field
        return view('Backend.emails.create', compact('users'));
    }

    /**
     * Store a newly created email in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming data
        $request->validate([
            'subject' => 'required|string|max:255',
            'editor1' => 'required|string',
            'recipients' => 'required|array', // Ensure recipients is an array
            'recipients.*' => 'exists:users,id', // Ensure each recipient exists
        ]);

        // Create the email record
        $email = Email::create([
            'subject' => $request->subject,
            'body' => $request->editor1,
            'user_id' => auth()->id(),
            'status' => 'draft', // Default status
            'date' => now(),
        ]);

        // Attach recipients
        $email->recipients()->attach($request->recipients);

        // Retrieve email addresses of the recipients
        $emails = User::whereIn('id', $request->recipients)->pluck('email')->toArray();

        // Send the email
        Mail::to($emails)->send(new CustomEmail($email));



        return redirect()->route('admin.manage-emails')->with('success', 'Email created successfully!');
    }

    /**
     * Display the specified email.
     */
    public function show(Email $email)
    {
        $email->load('recipients'); // Load recipients for the email
        return view('Backend.emails.show', compact('email'));
    }

    /**
     * Remove the specified email from storage.
     */
    public function destroy($id)
    {
        $email = Email::findOrFail($id);

        // Delete the email and its relationships
        $email->recipients()->detach(); // Detach recipients
        $email->delete(); // Delete the email

        return redirect()->route('admin.manage-emails')->with('success', 'Email deleted successfully!');
    }
}
