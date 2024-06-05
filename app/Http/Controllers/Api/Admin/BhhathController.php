<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bhhath;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class BhhathController extends Controller
{
    use GeneralTrait;
    public function index()
    {
        try {
            $lang = app()->getLocale();
            $bhhath = Bhhath::select('id', 
            'brief_'. $lang . ' AS brief', 
            'facebook_link',
            'youtube_link',
            'X_link',
            'instagram_link')->first();
            return $this->returnData('bhhath', $bhhath);
        } catch (\Exception $e) {
            return $this->returnError($e->getCode(), $e->getMessage());
        }
    }
}
