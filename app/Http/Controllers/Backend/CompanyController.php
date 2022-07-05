<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Postcode;
use App\Models\User;
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
                'postcode' => 'required|digits:7',
                'prefecture_id' => 'required',
                'city' => 'required|string|max:225',
                'local' => 'required|string|max:225',
                'phone' => 'max:15',
                'fax' => 'max:15',
                'url' => 'max:225',
                'license_number' => 'max:225',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
                'street_address' => 'max:225',
                'business_hour' => 'max:45',
                'regular_holiday' => 'max:45',
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
            // Get file extension
            $extension = $request->file("image")->getClientOriginalExtension();
            // Get id
            $id = Company::max('id');
            $img_id = ++$id;
            //Change file name
            $titlename = "image_".$img_id.".".$extension;
            // Save image file
            Storage::putFileAs('', $request->image, $titlename);
            // Create image file URL
            $image_url = Storage::disk('public')->url($titlename);
            
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
            $company->image = $image_url;
            $company->fax = $request->fax;
            $company->url = $request->url;
            $company->license_number = $request->license_number;
            $company->save();

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
        $extension = substr($company->image,0,3);
        if ($extension == 'htt')
        {
            $company->extension = 1;
        } else {
            $company->extension = 0;
        }
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
                // Delete stored images
                $len = strlen(env('APP_URL').'/uploads/files/');
                $contents = substr($currentCompany->image,$len);
                // $extension = substr($currentCompany->image,0,3);
                if (File::exists(public_path('uploads/files/'.$contents)))
                {
                    Storage::delete($contents);
                }

                // Get file extension
                $extension = $request->file("image")->getClientOriginalExtension();
                // Get id
                $id = $request->id;
                //Change file name
                $titlename = "image_".$id.".".$extension;
                // Save image file
                Storage::putFileAs('', $request->image, $titlename);
                // Create image file URL
                $image_url = Storage::disk('public')->url($titlename);
                
                // Update company
                $currentCompany->name = $request->name;
                $currentCompany->email = $request->email;
                $currentCompany->prefecture_id = $request->prefecture_id;
                $currentCompany->phone = $request->phone;
                $currentCompany->postcode = $request->postcode;
                $currentCompany->city = $request->city;
                $currentCompany->local = $request->local;
                $currentCompany->street_address = $request->street_address;
                $currentCompany->business_hour = $request->business_hour;
                $currentCompany->regular_holiday = $request->regular_holiday;
                $currentCompany->image = $image_url;
                $currentCompany->fax = $request->fax;
                $currentCompany->url = $request->url;
                $currentCompany->license_number = $request->license_number;
                $currentCompany->save();
                
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
            // Get user by id
            $user = User::find($request->get('id'));
            // If to-delete company is not the one currently logged in, proceed with delete attempt
            if (User::find($company->id)) {
                // Delete stored images
                $len = strlen(env('APP_URL').'/uploads/files/');
                $contents = substr($company->image,$len);
                // $extension = substr($currentCompany->image,0,3);
                if (File::exists(public_path('uploads/files/'.$contents)))
                {
                    Storage::delete($contents);
                }
                // Delete company
                $company->delete();
                // Delete user
                $user->delete();

                // If delete is successful
                return redirect()->route($this->getRoute())->with('success', Config::get('const.SUCCESS_DELETE_MESSAGE'));
            }
            // If delete is failed
            return redirect()->route($this->getRoute())->with('error', Config::get('const.FAILED_DELETE_COMPANY_DATA_MESSAGE'));
            
        } catch (Exception $e) {
            // If delete is failed
            return redirect()->route($this->getRoute())->with('error', Config::get('const.FAILED_DELETE_MESSAGE'));
        }
    }

}