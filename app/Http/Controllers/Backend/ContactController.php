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
    public function index()
    {
        //
        $settings = settings::where('key', 'contacts')->first();
        if (!isset($settings)) {
            // If no settings are found, create a default
            $settings = new \stdClass();
            $settings->value = json_encode(['status' => 'on']);
            settings::create([
                'key' => 'contacts',
                'value' => json_encode(['status' => 'on']),
            ]);
        }
        $status = "on";
        if (isset($settings) && isset($settings->value)) {
            $settings = json_decode($settings->value, true);
        }
        // get banks with modules
        $contacts = Contact::all();
        return view('backend.contact.index', compact('contacts', 'settings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('backend.contact.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }


    public function update_translation(Request $request)
    {
        $key = 'contacts';

        $settingsData = [
            'en' => [
                'section_title_en' => $request->section_title_en,
                'title_en' => $request->title_en,
            ],
            'ar' => [
                'section_title_ar' => $request->section_title_ar,
                'title_ar' => $request->title_ar,
            ],
            'status' => $request->status
        ];


        if (settings::where('key', $key)->exists() && isset($request->section_title_en) && isset($request->section_title_ar) && isset($request->title_en) && isset($request->title_ar) && isset($request->status)) {
            $request->validate([
                'section_title_en' => 'required|string|min:3|max:255',
                'section_title_ar' => 'required|string|min:3|max:255',
                'title_en' => 'required|string|min:3|max:255',
                'title_ar' => 'required|string|min:3|max:255',
                'status' => 'nullable|string',

            ]);

            settings::where('key', $key)->update([
                'value' => json_encode($settingsData),
            ]);
        } else {
            settings::create([
                'key' => $key,
                'value' => json_encode($settingsData),
            ]);
        }
        return redirect()->route('admin.contacts')->with('success', 'Clients Translation saved successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
