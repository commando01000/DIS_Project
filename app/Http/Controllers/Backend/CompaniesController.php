<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CompaniesController extends Controller
{
    private $companies;

    public function __construct()
    {
        // Load the companies from the companies_accounts.php file
        $this->companies = include base_path('companies_accounts.php');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Pass the companies data to the view
        return view('Backend.companies.index', ['companies' => $this->companies]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Return a view to create a new company
        return view('Backend.companies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'company_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
        ]);

        // Append the new company to the companies array
        $newCompany = [
            'company_name' => $request->input('company_name'),
            'email' => $request->input('email'),
        ];

        $this->companies[] = $newCompany;

        // Save the updated array back to the file
        file_put_contents(base_path('companies_accounts.php'), "<?php\nreturn " . var_export($this->companies, true) . ";\n");

        return redirect()->route('admin.companies')->with('success', 'Company added successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $companyName)
    {
        // Search for the company by name
        $key = array_search($companyName, array_column($this->companies, 'company_name'));

        if ($key === false) {
            abort(404, 'Company not found.');
        }

        return view('Backend.companies.edit', ['company' => $this->companies[$key], 'key' => $key]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $companyName)
    {
        // Search for the company by name
        $key = array_search($companyName, array_column($this->companies, 'company_name'));

        if ($key === false) {
            abort(404, 'Company not found.');
        }

        $request->validate([
            'company_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
        ]);

        // Update the company data
        $this->companies[$key] = [
            'company_name' => $request->input('company_name'),
            'email' => $request->input('email'),
        ];

        // Save the updated array back to the file
        file_put_contents(base_path('companies_accounts.php'), "<?php\nreturn " . var_export($this->companies, true) . ";\n");

        return redirect()->route('admin.companies')->with('success', 'Company updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $companyName)
    {
        // Search for the company by name
        $key = array_search($companyName, array_column($this->companies, 'company_name'));

        if ($key === false) {
            abort(404, 'Company not found.');
        }

        // Remove the company from the array
        unset($this->companies[$key]);

        // Re-index the array and save it back to the file
        $this->companies = array_values($this->companies);
        file_put_contents(base_path('companies_accounts.php'), "<?php\nreturn " . var_export($this->companies, true) . ";\n");

        return redirect()->route('admin.companies')->with('success', 'Company deleted successfully!');
    }
}
