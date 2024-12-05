<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\clients;
use Illuminate\Http\Request;
class ClientsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients = clients::where('key', 'clients')->first();

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

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());


        $key = "clients";



        $selected_module = json_encode($request->selected_module); // Convert array to JSON

        // Generate a unique name for the image
        $logoName = time() . '_' . $request->file('logo')->getClientOriginalName();
        
        // Move the uploaded file to the public/assets/images directory
        $request->file('logo')->move(public_path('assets/images'), $logoName);
        
        // Save the relative path in the database
        $logoPath = 'assets/images/' . $logoName;
        // $logoPath = asset('assets/images/no-image.jpg');
        // dd($logoPath);
        if (Clients::where('key', $key)->exists()) {
            Clients::where('key', $key)->update([
                'value' => json_encode([
                    'en' => [
                        'bank_name_en' => $request->bank_name_en,
                    ],
                    'ar' => [
                        'bank_name_ar' => $request->bank_name_ar,
                    ],
                ]),
                'contract_date' => $request->contract_date,

                'logo' => $request->logo,
            ]);
            return redirect()->back()->with('success', 'Client updated successfully');
        } else {
            Clients::create([
                'key' => 'clients',
                'value' => json_encode([
                    'en' => [
                        'bank_name_en' => $request->bank_name_en,
                    ],
                    'ar' => [
                        'bank_name_ar' => $request->bank_name_ar,
                    ]
                ]),
                'contract_date' => $request->contract_date,
                'selected_module' => $selected_module, // Store as JSON

                'logo' => $logoPath,
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
