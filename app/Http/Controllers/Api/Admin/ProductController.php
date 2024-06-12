<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use App\Traits\GeneralTrait;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    use GeneralTrait;
    
    public function allProducts()
    {
        try {
            $lang = app()->getLocale();
            $products = Product::with(['subCategory' => function($query) use ($lang){
                return $query->select('id','name_'. $lang . ' AS name','category_id')
                ->with('category:id,name_'. $lang . ' AS name')->get();
            }])->select(
                'id',
                'name_'. $lang . ' AS name', 
                'details_'. $lang . ' AS details', 
                'image',
                'quantity',
                'price',
                'sub_category_id',
                'created_at')
            ->orderBy('id', 'desc')
            ->whereStatus(1)
            ->whereNotNull('sub_category_id')
            ->whereHas('category', function($query){
                $query->where('type', 'product');
            })->paginate(PAGINATION);

            return $this->returnData('products', $products, 'success');
        } catch (\Exception $e) {
            return $this->returnError($e->getCode(), $e->getMessage());
        }
    }
    public function categoryProducts($sub_category_id)
    {
        try {
            $lang = app()->getLocale();
            $sub_category = SubCategory::findOrFail($sub_category_id);
            $products = $sub_category->products()
                ->select('id', 'name_'. $lang . ' AS name', 
                    'details_'. $lang . ' AS details', 
                    'image', 'quantity',
                    'price','type','category_id','created_at')
                ->orderBy('id', 'desc')
                ->whereStatus(1)
                ->whereHas('category', function($query){
                    $query->where('type', 'product');
                })->paginate(PAGINATION);

            return $this->returnData('products', $products, 'success');
        } catch (\Exception $e) {
            return $this->returnError($e->getCode(), $e->getMessage());
        }
    }

    public function show($id)
    {
        try {
            $lang = app()->getLocale();
            $product = Product::select('id',
                'name_'. $lang . ' AS name', 
                'details_'. $lang . ' AS details', 
                'image',
                'quantity',
                'price',
                'type',
                'sub_category_id',
                'category_id',
                'created_at')->with(['category' => function($query) use ($lang){
                    return $query->select('id', 'name_'. $lang . ' AS name');
                    }])->find($id);

            if (!$product) {
                return $this->returnError('404', 'product not found');
            }
            if ($product->sub_category_id != null) {
                return $this->returnData('product', $product, 'success');
            }
            return $this->returnData('product', $product, 'success');
        } catch (\Exception $e) {
            return $this->returnError($e->getCode(), $e->getMessage());
        }
    }
}
