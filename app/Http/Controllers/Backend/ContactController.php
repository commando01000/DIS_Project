<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\settings;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $settings = settings::where('key', 'contacts')->first();
        $contacts = Contact::all();
        return view('backend.contact.index', compact('contacts', 'settings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.contact.create');
    }

    /*** Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();
        return redirect()->route('admin.contacts')->with('success', 'Contact deleted successfully.');
    }


    // public function update_translation(Request $request)
    // {
    //     // Define validation rules
    //     $validations = [
    //         'section_title_en' => 'required|string|min:3|max:255',
    //         'section_title_ar' => 'required|string|min:3|max:255',
    //         'title_en' => 'required|string|min:3|max:255',
    //         'title_ar' => 'required|string|min:3|max:255',
    //         'phone' => 'nullable|string|min:11|max:12|regex:/^[0-9]+$/', // Optional, numeric format only
    //         'mail' => 'nullable|string|email|max:255', // Optional email validation
    //         'address' => 'nullable|string|min:3|max:255',
    //         'status' => 'nullable|in:on,off', // Optional, restrict status to specific values
    //     ];

    //     // Validate the incoming request
    //     $validatedData = $request->validate($validations);

    //     // Define the key for settings
    //     $key = 'contacts';

    //     // Prepare the settings data
    //     $settingsData = [
    //         'en' => [
    //             'section_title_en' => $validatedData['section_title_en'],
    //             'title_en' => $validatedData['title_en'],
    //         ],
    //         'ar' => [
    //             'section_title_ar' => $validatedData['section_title_ar'],
    //             'title_ar' => $validatedData['title_ar'],
    //         ],
    //         'contact-info' => [
    //             'phone' => $validatedData['phone'] ?? null,
    //             'mail' => $validatedData['mail'] ?? null,
    //             'address' => $validatedData['address'] ?? null,
    //         ],
    //         'status' => $validatedData['status'] ?? 'off', // Default status to 'off' if not provided
    //     ];
    //     if (settings::where('key', $key)->exists() && isset($request->section_title_en) && isset($request->section_title_ar) && isset($request->title_en) && isset($request->title_ar) && isset($request->status)) {
    //         // Check if the setting already exists
    //         if (settings::where('key', $key)->exists()) {
    //             // Update the existing setting
    //             settings::where('key', $key)->update([
    //                 'value' => json_encode($settingsData),
    //             ]);
    //         }
    //     } else {
    //         // Create a new setting
    //         settings::create([
    //             'key' => $key,
    //             'value' => json_encode($settingsData),
    //         ]);
    //     }


    //     // Redirect with a success message
    //     return redirect()->route('admin.contacts')->with('success', 'Contacts Translation saved successfully.');
    // }




}
