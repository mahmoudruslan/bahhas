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
            $lang = app()->getLocale();
            $ads = Ad::select('id', 'title_'. $lang . ' AS title', 
            'cover', 'url', 'created_at')
        ->orderBy('id', 'desc')
        ->whereStatus(1)
        ->paginate(PAGINATION);
            return $this->returnData('ads', $ads, 'success');
        } catch (\Exception $e) {
            return $this->returnError($e->getCode(), $e->getMessage());
        }
    }
}
