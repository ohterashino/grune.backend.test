<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\Company;
use Config;

class CompanyController extends Controller
{
    /**
     * Get named route
     *
     */
    private function getRoute() {
        return 'company';
    }

    public function index() {
        return view('backend.companies.index');
    }

    public function add() {
        $company =  'Company Add Page';
        // $company = new Compnay();
        // $company->form_action = $this->getRoute() . '.create';
        // $company->page_title = 'Company Add Page';
        // $company->page_type = 'create';
        // return view('backend.companies.form');
        return view('backend.companies.form', [
            'company' => $company
        ]);
    }

    public function create(Request $request) {
        $company = new Company();
        $company->name = $request->name;
        $company->email = $request->email;
        $company->prefecture_id = $request->prefecture_id;
        $company->phone = $request->phone;
        $company->postcode = $request->postcode;
        $company->city = $request->city;
        $company->local = $request->local;
        $company->street_address = $request->street_address;
        $company->business_hour = $request->business_hour;
        $company->regular_holiday = $request->regular_holiday;
        $company->image = $request->image;
        $company->fax = $request->fax;
        $company->url = $request->url;
        $company->license_number = $request->license_number;
        $company->save();

        return redirect()
            ->route('company');
        // $newCompany = $request->all();

        // // Validate input, indicate this is 'create' function
        // $this->validator($newCompany, 'create')->validate();

        // try {
        //     $newCompany['password'] = bcrypt($newCompany['password']);
        //     $company = User::create($newCompany);
        //     if ($company) {
        //         // Create is successful, back to list
        //         return redirect()->route($this->getRoute())->with('success', Config::get('const.SUCCESS_CREATE_MESSAGE'));
        //     } else {
        //         // Create is failed
        //         return redirect()->route($this->getRoute())->with('error', Config::get('const.FAILED_CREATE_MESSAGE'));
        //     }
        // } catch (Exception $e) {
        //     // Create is failed
        //     return redirect()->route($this->getRoute())->with('error', Config::get('const.FAILED_CREATE_MESSAGE'));
        // }
    }
    
}
