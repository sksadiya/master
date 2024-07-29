<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Country;
use App\Models\Setting;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Validator;
use App\Rules\GstNumber;

class SettingsController extends Controller
{
    public function index() {
        $countries = Country::all();
        $settings = Setting::all()->pluck('value', 'key')->toArray();
        return view('settings.index',compact('countries','settings'));
    }

    public function fetchStates($id)
    {
        $states = State::where('country_id', $id)->get();

        return response()->json([
            'status' => true,
            'states' =>$states
        ]);
    }
    public function fetchCities($id) {
        $cities = City::where('state_id',$id)->get();

        return response()->json([
            'status' => true,
            'cities' =>$cities
        ]);
    }

    public function updateSettings(Request $request) {
        $rules = [
        'app-name' => 'string|required',
        'company-name' => 'string|required',
        'app-logo' => 'nullable|mimes:jpg,jpeg,png,webp',
        'app-fevicon' => 'nullable|mimes:jpg,jpeg,png,webp',
        'country-code' => 'required',
        'company-phone' => 'required',
        'company-email' => 'required|email|max:255|string',
        'Address' => 'required',
        'invoice-prefix' => 'required|string',
        'GST-NO' =>  ['nullable', new GstNumber],
        'city' => 'nullable',
        'state-code' => 'nullable',
        'country-name' => 'nullable',
        ];

        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $input = $request->except('_token', 'search_terms');
        $files = $request->allFiles();
        $success = true;
        
        foreach ($input as $key => $value) {
            // Check for file inputs
            if ($request->hasFile($key)) {
                $file = $files[$key];
                $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                // $filename = time() . '.' . $file->getClientOriginalExtension();

                // Retrieve the current setting for this key
                $setting = Setting::where('key', $key)->first();

                // Delete the old file if it exists
                if ($setting && $setting->value) {
                    $oldFilePath = public_path('images/uploads/' . $setting->value);
                    if (File::exists($oldFilePath)) {
                        File::delete($oldFilePath);
                    }
                }

                $file->move(public_path('images/uploads'), $filename);
                $value = $filename;
            }
        
            // Update or create the setting
            $updateResult = Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
    
            if (!$updateResult) {
                $success = false;
            }
        }
    
        if ($success) {
            Session::flash('success', 'Company Details Updated successfully!');
        } else {
            Session::flash('error', 'Failed to update company settings.');
        }
    
        return redirect()->back();
    }
    
}
