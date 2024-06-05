<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMe;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class ContactMeController extends Controller
{
    use GeneralTrait;
    public function index()
    {
        try {
            $lang = app()->getLocale();
            $contact_me = ContactMe::first();
            return $this->returnData('contact_me', $contact_me);
        } catch (\Exception $e) {
            return $this->returnError($e->getCode(), $e->getMessage());
        }
    }
}
