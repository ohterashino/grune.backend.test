<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Config;

class CompanyController extends Controller
{
    /**
     * Get named route
     *
     */
    // private function getRoute() {
    //     return 'company';
    // }

    public function index() {
        return view('backend.companies.index');
    }

    public function add() {
        // $company = new Compnay();
        // $company->form_action = $this->getRoute() . '.create';
        // $company->page_title = 'Company Add Page';
        // $company->page_type = 'create';
        return view('backend.companies.form');
        // return view('backend.companies.form', [
        //     'company' => $company
        // ]);
    }
}
