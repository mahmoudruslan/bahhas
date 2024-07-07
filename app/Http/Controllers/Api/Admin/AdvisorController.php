<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdvisorController extends Controller
{
    use GeneralTrait;
    public function allAdvisors()
    {
        try {
            $lang = app()->getLocale();
            $products = Product::select(
                'id',
                'name_'. $lang . ' AS name', 
                'details_'. $lang . ' AS details', 
                'image',
                'quantity',
                'price',
                'category_id',
                'created_at','type')
            ->with('category')
            ->orderBy('id', 'desc')
            ->whereStatus(1)
            ->whereNull('sub_category_id')
            ->whereHas('category', function($query){
                $query->where('type', 'advisor');
            })->paginate(PAGINATION);

            return $this->returnData('advisors', $products, 'success');
        } catch (\Exception $e) {
            return $this->returnError($e->getCode(), $e->getMessage());
        }
    }

    public function categoryAdvisors($advisor_category_id, Request $request)
    {
        try {
            $lang = app()->getLocale();
            $advisor_category = Category::findOrFail($advisor_category_id);
            $price = $request->price;
            
            if($request->best_seller == true)
            {
                    $advisors = DB::table('order_products')
                        ->leftJoin('products', 'products.id', '=', 'order_products.id')
                        ->join('categories', function ($q) {
                            $q->on('categories.id', '=', 'products.category_id');
                        })->where('categories.type', '=', 'advisor')
                        ->whereNull('products.sub_category_id')
                        ->where('products.category_id', $advisor_category->id)
                        ->select(
                            'products.id',
                            'products.price',
                            'products.image',
                            'products.name_' . $lang . ' AS name',
                            'products.details_' . $lang . ' AS details',
                            'order_products.product_id',
                            DB::raw('SUM(order_products.quantity) as total'))
                        ->groupBy(
                            'products.id',
                            'products.price',
                            'products.image',
                            'products.name_ar',
                            'products.name_en',
                            'products.details_ar',
                            'products.details_en',
                            'order_products.product_id'
                        )
                        ->orderBy('total', 'desc')
                        ->whereStatus(1)
                        ->paginate(PAGINATION);
            }else{
                $advisors = $advisor_category->products()
                ->select('id', 'name_'. $lang . ' AS name', 
                    'details_'. $lang . ' AS details', 
                    'image', 'quantity',
                    'price','type','category_id','created_at')
                    ->orderBy($price ? 'price' : 'id', $price ? $price : 'desc')
                ->whereStatus(1)
                ->whereNull('sub_category_id')
                ->whereHas('category', function($query){
                    $query->where('type', 'advisor');
                })->paginate(PAGINATION);
            }
            

            return $this->returnData('advisors', $advisors, 'success');
        } catch (\Exception $e) {
            return $this->returnError($e->getCode(), $e->getMessage());
        }
    }
}
