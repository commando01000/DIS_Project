<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\settings;
use Illuminate\Http\Request;

class ChangeStatusController extends Controller
{
    public function UpdateStatus(Request $request)
    {

        if ($request->form === 'about') {
            $key = 'about-us'; // Example key for 'about us' section
            $settings = settings::where('key', $key)->first();

            if ($settings) {
                // Decode the existing JSON data
                $currentData = json_decode($settings->value, true);

                // Ensure the JSON is valid and is an array
                if (!is_array($currentData)) {
                    $currentData = []; // Fallback to an empty array if decoding fails
                }

                // Update the status field
                if ($request->input('status', 'on') == 'show') {
                    $currentData['status'] = 'on';
                } else {
                    $currentData['status'] = 'off';
                }

                // Save the updated JSON back to the database
                $settings->update([
                    'value' => json_encode($currentData)
                ]);

                return redirect()->back()->with('success', 'Form status updated successfully');
            }

            return response()->json(['success' => false, 'message' => 'Key not found'], 404);
        }

        return response()->json(['success' => false, 'message' => 'Invalid form type'], 400);
    }
}
