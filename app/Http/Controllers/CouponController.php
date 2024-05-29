<?php

namespace App\Http\Controllers;

use App\DataTables\CouponDataTable;
use App\Http\Requests\CouponRequest;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CouponDataTable $dataTable)
    {
        try {
            return $dataTable->render('admin.coupons.index');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    public function create(Request $request)
    {
        try {
            return view('admin.coupons.create');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    public function store(CouponRequest $request)
    {
        try {
            Coupon::create($request->validated());
            return redirect()->route('admin.coupons.index')->with([
                'message' => __('Item Created successfully.'),
                'alert-type' => 'success']);

            return redirect()->back()->with(['success' => 'Created Successfully']);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    public function edit(Coupon $coupon)
    {
        try {
            return view('admin.coupons.edit', compact('coupon'));
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    public function show(Coupon $coupon)
    {
        try {
            // $product = Coupon::findOrFail($id);
            return view('admin.coupons.show', compact('coupon'));
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    public function update(CouponRequest $request, $id)
    {
        try {
            
            $coupon = Coupon::findOrFail($id);
            $coupon->update($request->validated());
            return redirect()->route('admin.coupons.index')->with([
                'message' => __('Item updated successfully.'),
                'alert-type' => 'success']);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    public function destroy(Coupon $coupon)
    {
        try {
            $coupon->delete();
            return redirect()->route('admin.coupons.index')->with([
                'message' => __('Item deleted successfully.'),
                'alert-type' => 'success']);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
