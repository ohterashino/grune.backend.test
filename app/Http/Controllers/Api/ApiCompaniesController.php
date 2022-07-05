<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Prefecture;
use App\Models\Postcode;
use Illuminate\Support\Facades\DB; 

class ApiCompaniesController extends Controller {

    /**
     * Return the contents of User table in tabular form
     *
     */
    public function getCompaniesTabular() {
        $companies = DB::table('companies')
        ->orderBy('companies.id', 'desc')
        ->select('companies.id','companies.name','companies.email','companies.postcode','companies.prefecture_id','companies.street_address','companies.updated_at','prefectures.id as prefectures_id','prefectures.display_name')
        ->leftJoin('prefectures', 'companies.prefecture_id', '=', 'prefectures.id')
        ->get();
        return response()->json($companies);
    }

    public function postcode($postcode)
    {
        $address = Postcode::where('postcode',$postcode)->first();
        return response()->json($address);
    }

    public function Prefectures($prefecture_name)
    {
        $prefectures = Prefecture::where('display_name',$prefecture_name)->first();
        return response()->json($prefectures);
    }
    
}
