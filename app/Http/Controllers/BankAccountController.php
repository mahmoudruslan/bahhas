<?php

namespace App\Http\Controllers;

use App\DataTables\BankAccountDataTable;
use App\Http\Requests\BankAccountRequest;
use App\Models\BankAccount;
use App\Traits\Files;
use Illuminate\Http\Request;

class BankAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    use Files;

    public function index(BankAccountDataTable $dataTable)
    {
        try {
            return $dataTable->render('admin.bank_accounts.index');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    public function create()
    {
        return view('admin.bank_accounts.create');
    }

    public function store(BankAccountRequest $request)
    {
        try {
            $data = $request->validated();
                
            BankAccount::create($data);
            return redirect()->route('admin.bank-accounts.index')->with([
                'message' => __('Item Created successfully.'),
                'alert-type' => 'success']);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function destroy($id)
    {
        try {
            $account = BankAccount::findOrFail($id);
            $account->delete();
            return redirect()->route('admin.bank-accounts.index')->with([
                'message' => __('Item deleted successfully.'),
                'alert-type' => 'success']);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
