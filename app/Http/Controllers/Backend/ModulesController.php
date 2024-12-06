<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Module;
use App\Models\settings;
use Illuminate\Http\Request;

class ModulesController extends Controller
{
    public function index()
    {
        // $settings = settings::where('key', 'modules')->first();
        // if (!isset($settings)) {
        //     // If no settings are found, create a default
        //     $settings = new \stdClass();
        //     $settings->value = json_encode(['status' => 'on']);
        // }
        // $status = "off";
        $modules = Module::all();

        return view('Backend.Modules.index', compact('modules'));
    }




    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Backend.Modules.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validations = [
            'name' => 'required|string|max:255',
        ];

        // Validate request data
        $this->validate($request, $validations);

        // Create a new module
        $module = Module::create($request->all());

        return redirect()->route('admin.modules')->with('success', 'Module created successfully.');
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $module = Module::findOrFail($id);
        // check if module has any bank assigned
        if ($module->banks()->count() > 0) {
            $module->banks()->detach();
            $module->delete();
            return redirect()->route('admin.modules')->with('success', 'Module deleted successfully.');
        }
        $module->delete();
        return redirect()->route('admin.modules')->with('success', 'Module deleted successfully.');
    }
}
