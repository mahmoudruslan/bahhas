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
            $products = Product::select(
                'id',
                'name_'. $lang . ' AS name', 
                'details_'. $lang . ' AS details', 
                'image',
                'quantity',
                'price',
                'created_at')
            ->orderBy('id', 'desc')
            ->whereStatus(1)
            ->whereNotNull('sub_category_id')
            ->whereHas('category', function($query){
                $query->where('type', 'product');
            })->get();

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
                    'price','created_at')
                ->orderBy('id', 'desc')
                ->whereStatus(1)
                ->whereHas('category', function($query){
                    $query->where('type', 'product');
                })->get();

            return $this->returnData('products', $products, 'success');
        } catch (\Exception $e) {
            return $this->returnError($e->getCode(), $e->getMessage());
        }
    }

    public function show($id)
    {
        try {
            $product = Product::find($id);
            $product_types = $product->products()
            ->paginate(PAGINATION)
            ->makeHidden([
                'name_ar', 
                'details_ar', 
                'name_en',
                'details_en',
            ]);
            if (!$product) {
                return $this->returnError('404', 'product types not found');
            }
            return $this->returnData('product_types', $product_types, 'success');
        } catch (\Exception $e) {
            return $this->returnError($e->getCode(), $e->getMessage());
        }
    }
}
