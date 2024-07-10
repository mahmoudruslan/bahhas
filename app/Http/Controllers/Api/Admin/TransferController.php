<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transfer;
use App\Traits\Files;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TransferController extends Controller
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
                $path = 'images/transfers/';
                $image_name = $this->saveImag($path, [$request->receipt]);

                $data['receipt'] = $path . $image_name;
                $data['customer_id'] = Auth::guard('sanctum')->id();
                $transfer = Transfer::create($data);
            return $this->returnData('transfer', $transfer, __('Data saved successfully'));
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
            'sender' => 'required|string|max:255',
            'receipt' => 'required|mimes:jpeg,png,jpg|max:1024',
            ];
        
    }
}
