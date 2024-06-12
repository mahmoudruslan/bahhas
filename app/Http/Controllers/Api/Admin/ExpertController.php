<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Expert;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Traits\Files;
use App\Traits\GeneralTrait;
use Illuminate\Support\Facades\Validator;

class ExpertController extends Controller
{
    use GeneralTrait, Files;

    public function store(Request $request)
    {
        try {
            $validator = Validator::make(request()->all(), $this->rules());
            
            if ($validator->fails()) {
                return $this->returnValidationError($validator);
            }
            $data = $validator->validated();
                $path = 'images/experts/';
                $image_name = $this->saveImag($path, [$request->image]);
                $IBAN_cert_name = $this->saveImag($path, [$request->IBAN_certificate]);
                $biography_name = $this->saveImag($path, [$request->the_biography]);
                $data['image'] = $path . $image_name;
                $data['IBAN_certificate'] = $path . $IBAN_cert_name;
                $data['the_biography'] = $path . $biography_name;
                $expert = Expert::create($data);
            return $this->returnData('expert', $expert, 'Created successfully');
        } catch (\Exception $e) {
            return $this->returnError($e->getCode(), $e->getMessage());
        }
    }

    // public function getCountries()
    // {
    //     try {
    //         $lang = app()->getLocale();
    //         $countries = Country::select('id', 'name_'. $lang . ' AS name')
    //         ->orderBy('id', 'desc')->get();
    //         return $this->returnData('countries', $countries);
    //     } catch (\Exception $e) {
    //         return $this->returnError($e->getCode(), $e->getMessage());
    //     }
    // }

    // public function countryCities($country_id)
    // {
    //     try {
    //         $lang = app()->getLocale();
    //         $country = Country::find($country_id);
    //         $cities = $country->cities()->select('id', 'name_'. $lang . ' AS name')
    //         ->orderBy('id', 'desc')->get();
    //         return $this->returnData('cities', $cities);
    //     } catch (\Exception $e) {
    //         return $this->returnError($e->getCode(), $e->getMessage());
    //     }
    // }
    private function rules()
    {
        return [
            'full_name' => 'required|string|max:255',
            'specialization' => 'required|string|max:255',
            'degree' => 'required|string|max:255',
            'university' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'text_introduction' => 'required|string|max:5000',
            'phone' => 'required|numeric',
            'email' => 'required|email|unique:experts,email',
            'international_bank_number' => 'required|numeric',
            'IBAN_certificate' => 'required|mimes:pdf|max:1024',
            'the_biography' => 'required|mimes:pdf|max:1024',
            'show_information' => 'required|numeric|max:1',
            'publish_achievements' => 'required|numeric|max:1',
            'gender' => 'required|numeric|max:1',
            'image' => 'nullable|mimes:jpeg,png,jpg,gif|max:1024',
            'status' => 'nullable|numeric|max:1',
            ];
        
    }
}
