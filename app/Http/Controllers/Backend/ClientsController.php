<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\clients;
use App\Models\settings;
use Illuminate\Http\Request;

class ClientsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients = settings::where('key', 'clients')->first();

        if (isset($clients) && $clients->value) {
            $translations = json_decode($clients->value, true);
        }

        if (isset($clients->value) && isset($translations)) {
            return view('Backend.Clients.index', compact('translations'));
        } else {
            return view('Backend.Clients.index');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function Store(Request $request) {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function translate(Request $request)
    {
        $key = "clients";

        if (settings::where('key', $key)->exists()) {
            settings::where('key', $key)->update([
                'value' => json_encode([
                    'en' => [
                        'bank_name_en' => $request->bank_name_en,
                    ],
                    'ar' => [
                        'bank_name_ar' => $request->bank_name_ar,
                    ],
                ]),
            ]);
            return redirect()->back()->with('success', 'Client updated successfully');
        } else {
            settings::create([
                'key' => 'clients',
                'value' => json_encode([
                    'en' => [
                        'bank_name_en' => $request->bank_name_en,
                    ],
                    'ar' => [
                        'bank_name_ar' => $request->bank_name_ar,
                    ],
                ]),
            ]);

            return redirect()->back()->with('success', 'Client created successfully');
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(Clients $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Clients $client)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Clients $client)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Clients $client)
    {
        //
    }
}
