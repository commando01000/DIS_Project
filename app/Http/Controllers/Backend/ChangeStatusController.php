<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\settings;
use Illuminate\Http\Request;

class ChangeStatusController extends Controller
{
    /**
     * Updates the status of a specified form based on the request input.
     *
     * This function handles updating the status field within a JSON object stored
     * in the database for different form types, such as 'about', 'clients', and
     * 'projects'. The status is stored in the `settings` table and is updated
     * based on the request data. If the form type is invalid or the key is not 
     * found in the database, an appropriate error response is returned.
     *
     * @param Request $request The incoming HTTP request containing form and status data.
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     *         Redirects back with a success message on successful update,
     *         or returns a JSON error response if the key is not found or form type is invalid.
     */
    public function UpdateStatus(Request $request)
    {
        $form_name = $request->form;
        $key = $request->key;
        if ($request->form === $form_name) {
            $settings = settings::where('key', $key)->first();
            if ($settings) {
                // Decode the existing JSON data
                $currentData = json_decode($settings->value, true);
                // Ensure the JSON is valid and is an array
                if (!is_array($currentData)) {
                    $currentData = []; // Fallback to an empty array if decoding fails
                }
                // Update the status field
                if ($request->input('status', 'on') == 'Show') {
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
    }
}
