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

     /**
     * Validator for user
     *
     * @return \Illuminate\Http\Response
     */
    protected function validator(array $data, $type) {
        // Determine if validation is required in response to the call
        return Validator::make($data, [
                // 'name' => 'required|string|max:100',
                'name' => 'required|string|max:100|unique:companies,name,' . $data['id'],
                'email' => 'required|email|max:225',
                'postcode' => 'required|integer|digits:7',
                'prefecture_id' => 'required',
                'city' => 'required|string|max:225',
                'local' => 'required|string|max:225',
                // 'image' => 'required|image|mimes:jpeg,png,jpg,gif|size:5000',
        ]);
    }
    
    public function index() {
        return view('backend.companies.index');
    }

    public function add() {
        $company = new Company();
        $company->form_action = $this->getRoute() . '.create';
        $company->page_title = 'Company Add Page';
        $company->page_type = 'create';
        return view('backend.companies.form', [
            'company' => $company
        ]);
    }

    public function create(Request $request) {
        $newCompany = $request->all();
        // // Validate input, indicate this is 'create' function
        $this->validator($newCompany, 'create')->validate();
        
        try {
            // $company = Company::create($newCompany);
            //拡張子を取得 
            
            $company = new Company();
            $company->id = $request->id;
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

            
            $extension = $request->file("image")->getClientOriginalExtension();
            $id = $request->get('id');
            // $posts = Company::all();
            // dd($posts);
            $file = $request->image;
            //保存のファイル名を構築
            $titlename = "image_".$id.".".$extension;
            // 保存先変更
            $target_path = public_path('/uploads/files/');
            $file->move($target_path,$titlename);

            if ($company) {
                // Create is successful, back to list
                return redirect()->route($this->getRoute())->with('success', Config::get('const.SUCCESS_CREATE_MESSAGE'));
            } else {
                // Create is failed
                return redirect()->route($this->getRoute())->with('error', Config::get('const.FAILED_CREATE_MESSAGE'));
            }
        } catch (Exception $e) {
            // Create is failed
            return redirect()->route($this->getRoute())->with('error', Config::get('const.FAILED_CREATE_MESSAGE'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $company = Company::find($id);
        $company->form_action = $this->getRoute() . '.update';
        $company->page_title = 'Company Edit Page';
        // Add page type here to indicate that the form.blade.php is in 'edit' mode
        $company->page_type = 'edit';
        return view('backend.companies.form', [
            'company' => $company
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request) {
        $newCompany = $request->all();
        try {
            $currentCompany = Company::find($request->get('id'));
            if ($currentCompany) {
                $this->validator($newCompany, 'update')->validate();
                // Update company
                $currentCompany->update($newCompany);
                // If update is successful
                return redirect()->route($this->getRoute())->with('success', Config::get('const.SUCCESS_UPDATE_MESSAGE'));
            } else {
                // If update is failed
                return redirect()->route($this->getRoute())->with('error', Config::get('const.FAILED_UPDATE_MESSAGE'));
            }
        } catch (Exception $e) {
            // If update is failed
            return redirect()->route($this->getRoute())->with('error', Config::get('const.FAILED_UPDATE_MESSAGE'));
        }
    }
    
    public function delete(Request $request) {
        try {
            // Get company by id
            $company = Company::find($request->get('id'));
            // If to-delete company is not the one currently logged in, proceed with delete attempt
            if (Auth::id() != $company->id) {

                // Delete company
                $company->delete();

                // If delete is successful
                return redirect()->route($this->getRoute())->with('success', Config::get('const.SUCCESS_DELETE_MESSAGE'));
            }
            // Send error if logged in user trying to delete himself
            return redirect()->route($this->getRoute())->with('error', Config::get('const.FAILED_DELETE_SELF_MESSAGE'));
        } catch (Exception $e) {
            // If delete is failed
            return redirect()->route($this->getRoute())->with('error', Config::get('const.FAILED_DELETE_MESSAGE'));
        }
    }

    // public function store(Request $request)
    // {
    //     //拡張子付きでファイル名を取得
    //     $filenameWithExt = $request->file("cover_image")->getClientOriginalName();

    //     //ファイル名のみを取得
    //     $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

    //     //拡張子を取得
    //     $extension = $request->file("cover_image")->getClientOriginalExtension();

    //     //保存のファイル名を構築
    //     $filenameToStore = $filename."_".time().".".$extension;

    //     $path = $request->file("cover_image")->storeAs("public/album_covers", $filenameToStore);

    //     $album = new Company;
    //     $album->name = $request->input("name");
    //     $album->description = $request->input("description");
    //     $album->cover_image = $filenameToStore;

    //     $album->save();

    //     return view('backend.companies.form', [
    //         'company' => $company
    //     ]);
    // }

}
