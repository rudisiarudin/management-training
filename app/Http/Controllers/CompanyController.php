<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index() {
        $companies = Company::get();

        return view('admin-dashboard.company.index', ['companies' => $companies]);
    }

    public function create() {
        return view('admin-dashboard.company.create');
    }

    public function save(Request $request) {
        $company = $request->validate([
            'name' => 'required|max:45',
            'agent_name' => 'required|max:45',
            'email' => 'required|email',
            'phone' => 'required|numeric',
            'address' => 'required'
        ]);

        Company::create($company);

        return redirect()->route('company-index')->with([
            'status' => 'success',
            'message' => 'Successfully create new company data.'
        ]);
    }

    public function edit($id) {
        $company = Company::find($id);

        return view('admin-dashboard.company.edit', ['company' => $company]);
    }

    public function update(Request $request, $id) {
        $company = $request->validate([
            'name' => 'required|max:45',
            'agent_name' => 'required|max:45',
            'email' => 'required|email',
            'phone' => 'required|numeric',
            'address' => 'required'
        ]);

        Company::find($id)->update($company);

        return redirect()->route('company-index')->with([
            'status' => 'success',
            'message' => 'Successfully update company data.'
        ]);
    }

    public function destroy($id) {
        $company = Company::find($id)->delete();

        return redirect()->route('company-index')->with([
            'status' => 'success',
            'message' => 'Successfully delete company data.'
        ]);
    }
}
