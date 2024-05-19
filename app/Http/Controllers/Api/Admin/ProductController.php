<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Traits\GeneralTrait;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    use GeneralTrait;
    
    public function index()
    {
        try {
            $products = Product::paginate(PAGINATION)
            ->makeHidden([
                'name_ar', 
                'details_ar', 
                'name_en',
                'details_en',
            ]);
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
