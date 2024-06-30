<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\BankAccount;
use App\Traits\GeneralTrait;

class BankAccountController extends Controller
{
    use GeneralTrait;
    public function index()
    {
        try {
            $bank_accounts = BankAccount::get();
            return $this->returnData('bank_accounts', $bank_accounts, 'success');
        } catch (\Exception $e) {
            return $this->returnError($e->getCode(), $e->getMessage());
        }
    }
}
