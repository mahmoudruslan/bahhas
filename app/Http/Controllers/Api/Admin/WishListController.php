<?php

namespace App\Http\Controllers\Api\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\WishList;
use App\Traits\GeneralTrait;
use Illuminate\Support\Facades\Auth;

class WishListController extends Controller
{
    use GeneralTrait;
    public function index()
    {
        $customer_id = Auth::guard('sanctum')->id();
        $customer = Customer::with(['wishList'
        // => function($query){
        //     return $query->select('id')->get();
        // }
        ])->find($customer_id);
        return $this->returnData('customer', $customer);
    }
    public function store(Request $request)
    {
        try {
                $wishlist = WishList::UpdateOrCreate([
                    
                    'product_id' => $request->product_id,
                ],[                    
                    'customer_id' => Auth::id(),
                    'product_id' => $request->product_id,
            ]);
            return $this->returnData('wishlist', $wishlist, __('Data saved successfully'));
        } catch (\Exception $e) {
            return $this->returnError($e->getCode(), $e->getMessage());
        }
    }

    public function destroy(Request $request)
    {
        try {
            WishList::where('customer_id', Auth::guard('sanctum')->user()->id)
            ->where('product_id', $request->product_id)->delete();
       
            return $this->returnSuccess(200 , __('Data deleted successfully'));
        } catch (\Exception $e) {
            return $this->returnError($e->getCode(), $e->getMessage());
        }
    }

}
