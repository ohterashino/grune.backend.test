<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Prefecture;

class ApiCompaniesController extends Controller {

    /**
     * Return the contents of User table in tabular form
     *
     */
    public function getCompaniesTabular() {
        $companies = \DB::table('companies')
        ->orderBy('companies.id', 'desc')
        ->select('companies.id','companies.name','companies.email','companies.postcode','companies.prefecture_id','companies.street_address','companies.updated_at','prefectures.id as prefectures_id','prefectures.display_name')
        ->leftJoin('prefectures', 'companies.prefecture_id', '=', 'prefectures.id')
        ->get();
        return response()->json($companies);
    }

}
