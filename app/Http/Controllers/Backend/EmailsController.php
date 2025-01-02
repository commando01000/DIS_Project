<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Mail\CustomEmail;
use App\Models\Email;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
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

    public function config()
    {
        // Fetch current .env mail settings
        $mailConfig = [
            'MAIL_MAILER' => env('MAIL_MAILER', 'smtp'),
            'MAIL_HOST' => env('MAIL_HOST', ''),
            'MAIL_PORT' => env('MAIL_PORT', ''),
            'MAIL_USERNAME' => env('MAIL_USERNAME', ''),
            'MAIL_PASSWORD' => env('MAIL_PASSWORD', ''),
            'MAIL_ENCRYPTION' => env('MAIL_ENCRYPTION', ''),
            'MAIL_FROM_ADDRESS' => env('MAIL_FROM_ADDRESS', ''),
            'MAIL_FROM_NAME' => env('MAIL_FROM_NAME', ''),
        ];
        
        return view('Backend.emails.config', compact('mailConfig'));
    }
    public function UpdateConfig(Request $request)
    {
        // Validate incoming data
        
        $request->validate([
            'MAIL_MAILER' => 'required|string',
            'MAIL_HOST' => 'required|string',
            'MAIL_PORT' => 'required|numeric',
            'MAIL_USERNAME' => 'required|string',
            'MAIL_PASSWORD' => 'required|string',
            'MAIL_ENCRYPTION' => 'required|string',
            'MAIL_FROM_ADDRESS' => 'required|email',
            'MAIL_FROM_NAME' => 'required|string',
        ]);
        

        // Update .env file
        $envUpdates = [
            'MAIL_MAILER' => $request->MAIL_MAILER,
            'MAIL_HOST' => $request->MAIL_HOST,
            'MAIL_PORT' => $request->MAIL_PORT,
            'MAIL_USERNAME' => $request->MAIL_USERNAME,
            'MAIL_PASSWORD' => $request->MAIL_PASSWORD,
            'MAIL_ENCRYPTION' => $request->MAIL_ENCRYPTION,
            'MAIL_FROM_ADDRESS' => $request->MAIL_FROM_ADDRESS,
            'MAIL_FROM_NAME' => $request->MAIL_FROM_NAME,
        ];

        

        foreach ($envUpdates as $key => $value) {
            $this->updateEnvVariable($key, $value);
        }
        

        // Clear config cache to apply changes
        // dd('text');
        // Artisan::call('config:clear');

        return redirect()->route('mail.config')->with('success', 'Email configuration updated successfully!');
    }
    private function updateEnvVariable($key, $value)
    {
        $path = base_path('.env');

        if (file_exists($path)) {
            // Read .env file
            $env = file_get_contents($path);

            // Update the value or add if not exists
            if (strpos($env, "$key=") !== false) {
                $env = preg_replace("/^$key=.*$/m", "$key=\"$value\"", $env);
            } else {
                $env .= "\n$key=\"$value\"";
            }

            // Write updated content back to .env
            file_put_contents($path, $env);
        }
    }
    /**
     * Show the form for creating a new email.
     */
    public function create()
    {
        $users = User::paginate(10); // Fetch all users to display in the "To" field
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



        return redirect()->route('admin.manage-emails')->with('success', 'Email Created Successfully!');
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
