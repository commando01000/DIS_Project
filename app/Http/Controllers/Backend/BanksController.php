<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\Module;
use App\Models\settings;
use Illuminate\Http\Request;

class BanksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $settings = settings::where('key', 'clients')->first();
        if (!isset($settings)) {
            // If no settings are found, create a default
            $settings = new \stdClass();
            $settings->value = json_encode(['status' => 'on']);
            settings::create([
                'key' => 'clients',
                'value' => json_encode(['status' => 'on']),
            ]);
        }
        $status = "on";
        if (isset($settings) && isset($settings->value)) {
            $settings = json_decode($settings->value, true);
        }
        // get banks with modules
        $banks = Bank::with('modules')->paginate(10);
        return view('backend.bank.index', compact('banks', 'settings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $modules = Module::all();
        return view('backend.bank.create', compact('modules'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validation rules
        $validations = [
            'name_en' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
            'contract_date' => 'date|nullable',
            'modules' => 'nullable|array',
            'modules.*' => 'exists:modules,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image
        ];

        // dd($request->all());
        // Validate request data
        $validated = $request->validate($validations);
        // dd($validated);
        // Handle image upload
        $imagePath = null;
        if ($request->hasFile('image')) {
            // Define the directory where the image will be stored
            $destinationPath = public_path('assets/images/banks');

            // Create the directory if it doesn't exist
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }

            // Generate a unique name for the image or use a specific name
            $imageName = uniqid() . '.' . $request->file('image')->getClientOriginalExtension();

            // Move the uploaded file to the desired location
            $request->file('image')->move($destinationPath, $imageName);

            // Save the image path relative to the public directory
            $imagePath = 'assets/images/bank/' . $imageName;
        }
        // Attach selected modules to the bank
        // Create the bank
        $bank = Bank::create([
            'name' => [
                'en' => $validated['name_en'],
                'ar' => $validated['name_ar'],
            ],
            'image' => $imagePath,
            'contract_date' => $validated['contract_date'],
        ]);
        if (!empty($validated['modules'])) {
            $bank->modules()->attach($validated['modules']);
        }

        return redirect()->route('admin.client')->with('success', 'Bank created successfully.');
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
        $bank = Bank::findOrFail($id);
        $modules = Module::all();
        return view('backend.bank.edit', compact('bank', 'modules'));
    }

    /**
     * Update the specified resource in storage. 
     
     ***/
    public function update(Request $request, $id)
    {
        $bank = Bank::findOrFail($id);  // Find the bank by ID

        // Validation rules
        $validations = [
            'name_en' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
            'contract_date' => 'date|nullable',
            'modules' => 'nullable|array',
            'modules.*' => 'exists:modules,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image
        ];

        // Validate request data
        $validated = $request->validate($validations);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($bank->image) {
                $oldImagePath = public_path($bank->image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);  // Delete the old image from the public folder
                }
            }

            // Define the directory where the image will be stored
            $destinationPath = public_path('assets/images/bank');

            // Create the directory if it doesn't exist
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }

            // Generate a unique name for the image or use a specific name
            $imageName = uniqid() . '.' . $request->file('image')->getClientOriginalExtension();

            // Move the uploaded file to the desired location
            $request->file('image')->move($destinationPath, $imageName);

            // Save the image path relative to the public directory
            $imagePath = 'assets/images/bank/' . $imageName;
        } else {
            // If no new image is uploaded, retain the existing one
            $imagePath = $bank->image;
        }

        // Update the bank
        $bank->update([
            'name' => [
                'en' => $validated['name_en'],
                'ar' => $validated['name_ar'],
            ],
            'image' => $imagePath,
            'contract_date' => $validated['contract_date'],
        ]);

        // Attach selected modules to the bank
        if (!empty($validated['modules'])) {
            $bank->modules()->sync($validated['modules']);
        }

        return redirect()->route('admin.client')->with('success', 'Bank updated successfully.');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $bank = Bank::find($id);
        // check for existed modules 
        if ($bank->modules()->count() > 0) {
            $bank->modules()->detach();
        }
        $bank->delete();

        return redirect()->route('admin.client')->with('success', 'Bank deleted successfully.');
    }
}
