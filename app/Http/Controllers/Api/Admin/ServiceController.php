<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ServiceController extends Controller
{
    use GeneralTrait;
    public function allServices()
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
            
            ->with('category:id,name_'. $lang . ' AS name')
            ->orderBy('id', 'desc')
            ->whereStatus(1)
            ->whereNull('sub_category_id')
            ->whereHas('category', function($query){
                $query->where('type', 'service');
            })->paginate(PAGINATION);

            return $this->returnData('services', $products, 'success');
        } catch (\Exception $e) {
            return $this->returnError($e->getCode(), $e->getMessage());
        }
    }

    public function categoryServices($service_category_id, Request $request)
    {
        try {
            $lang = app()->getLocale();
            $service_category = Category::findOrFail($service_category_id);

            $price = $request->price;
            if($request->best_seller == true)
            {
                    $services = DB::table('order_products')
                        ->leftJoin('products', 'products.id', '=', 'order_products.id')
                        ->join('categories', function ($q) {
                            $q->on('categories.id', '=', 'products.category_id');
                        })->where('categories.type', '=', 'service')
                        ->whereNull('products.sub_category_id')
                        ->where('products.category_id', $service_category->id)
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
                $services = $service_category->products()
                ->select('id', 'name_'. $lang . ' AS name', 
                    'details_'. $lang . ' AS details', 
                    'image', 'quantity',
                    'price','category_id','created_at','type')
                ->orderBy($price ? 'price' : 'id', $price ? $price : 'desc')
                ->whereStatus(1)
                ->whereNull('sub_category_id')
                ->whereHas('category', function($query){
                    $query->where('type', 'service');
                })->paginate(PAGINATION);
            }


          

            return $this->returnData('services', $services, 'success');
        } catch (\Exception $e) {
            return $this->returnError($e->getCode(), $e->getMessage());
        }
    }
}
