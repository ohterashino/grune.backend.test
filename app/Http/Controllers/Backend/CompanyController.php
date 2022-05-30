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
    public function index() {
        return view('backend.companies.index');
    }

    public function add() {
        return view('backend.companies.form');
    }
}
