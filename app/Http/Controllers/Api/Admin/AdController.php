<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Traits\GeneralTrait;


use App\Models\Ad;

class AdController extends Controller
{
    use GeneralTrait;


    public function index()
    {
        try {
            $ads = Ad::get();
            return $this->returnData('ads', $ads, 'success');
        } catch (\Exception $e) {
            return $this->returnError($e->getCode(), $e->getMessage());
        }
    }
}
