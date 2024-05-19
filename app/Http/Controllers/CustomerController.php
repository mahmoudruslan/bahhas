<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Notifications\AccountStatusNotification;
use Illuminate\Http\Request;
use App\Traits\HtmlTrait;
use DataTables;

class CustomerController extends Controller
{
    use HtmlTrait;

    public function index(Request $request)
    {
        try {
            if ($request->ajax()) {
                $customer = Customer::get();
                return DataTables::of($customer)
                    ->addIndexColumn()
                    ->addColumn('action', function ($row) {
                        $btn =  $this->href(route('customers.show', $row->id), __('Orders'));
                        if($row->status == 'not active'){
                        $btn =  $btn . ' ' . $this->update(route('customer.active', $row->id), __('Active'), 'info');
                        }else{
                            $btn =  $btn . ' ' . $this->update(route('customer.not.active', $row->id), __('Not active'), 'danger');

                        }
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }
            return view('customers.index');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function allUnverifiedAccounts(Request $request)
    {
        try {
            if ($request->ajax()) {
                $customer = Customer::where('status', 'not active')->get();
                return DataTables::of($customer)
                    ->addIndexColumn()
                    ->addColumn('action', function ($row) {
                        $btn = $this->update(route('customer.active', $row->id), __('Active'), 'info');
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }
            return view('customers.unverified_accounts');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }


    public function show(Request $request, $id)
    {
        try {
            // dd(Customer::findOrFail($id)->orders);
            $orders = Customer::findOrFail($id)->orders;
            return view('customers.show', compact('orders'));
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }


    public function active($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->update([
            'status' => 'active'
        ]);
        $customer->notify(new AccountStatusNotification());
        return redirect()->back();
    }

    public function notActive($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->update([
            'status' => 'not active'
        ]);
        return redirect()->back();
    }
}
