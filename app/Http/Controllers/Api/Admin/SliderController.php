<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Traits\GeneralTrait;


use App\Models\Ad;
use App\Models\Slider;

class SliderController extends Controller
{
    use GeneralTrait;


    public function index()
    {
        try {
            $lang = app()->getLocale();
            $ads = Slider::select('id', 'title_'. $lang . ' AS title', 'details_'. $lang . ' AS details',
            'cover', 'url', 'created_at')
        ->orderBy('id', 'desc')
        ->whereStatus(1)
        ->get();
            return $this->returnData('sliders', $ads, 'success');
        } catch (\Exception $e) {
            return $this->returnError($e->getCode(), $e->getMessage());
        }
    }
}
