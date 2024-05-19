<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class GovernorateController extends Controller
{
    use GeneralTrait;
    public function index()
    {
        try {
            $governorate = config('governorates');
            return $this->returnData('governorate', $governorate, 'success');
        } catch (\Exception $e) {
            return $this->returnError($e->getCode(), $e->getMessage());
        }
    }
}
