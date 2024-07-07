<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\SubCategory;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    use GeneralTrait;

    public function allProducts()
    {
        try {
            $lang = app()->getLocale();
            $products = Product::with(['subCategory' => function ($query) use ($lang) {
                return $query->select('id', 'name_' . $lang . ' AS name', 'category_id')
                    ->with('category:id,name_' . $lang . ' AS name')->get();
            }])->select(
                'id',
                'name_' . $lang . ' AS name',
                'details_' . $lang . ' AS details',
                'image',
                'quantity',
                'price',
                'sub_category_id',
                'created_at'
            )
                ->orderBy('id', 'desc')
                ->whereStatus(1)
                ->whereNotNull('sub_category_id')
                ->whereHas('category', function ($query) {
                    $query->where('type', 'product');
                })->paginate(PAGINATION);

            return $this->returnData('products', $products, 'success');
        } catch (\Exception $e) {
            return $this->returnError($e->getCode(), $e->getMessage());
        }
    }

    public function allProductsServicesAdvisors()
    {
        try {
            $lang = app()->getLocale();
            $products = Product::
            select(
                'id',
                'name_' . $lang . ' AS name',
                'details_' . $lang . ' AS details',
                'image',
                'quantity',
                'price',
                'sub_category_id',
                'category_id',
                'created_at'
            )
                ->orderBy('id', 'desc')
                ->whereStatus(1)
                ->get();

            return $this->returnData('all-products', $products, 'success');
        } catch (\Exception $e) {
            return $this->returnError($e->getCode(), $e->getMessage());
        }
    }
    public function categoryProducts($sub_category_id, Request $request)
    {
        try {
            $lang = app()->getLocale();
            $sub_category = SubCategory::findOrFail($sub_category_id);
            $price = $request->price;
            // $products = $sub_category->products()
            // ->select(
            //     'id',
            //     'name_' . $lang . ' AS name',
            //     'details_' . $lang . ' AS details',
            //     'image',
            //     'quantity',
            //     'price',
            //     'type',
            //     'category_id',
            //     'created_at')
            //     ->whereStatus(1)
            //     ->whereHas('category', function ($query) {
            //         $query->where('type', 'product');
                
            //         })
            //         ->orderBy('price', $price)
            //         ->paginate(PAGINATION);
            if ($request->best_seller == true) {
                $products = DB::table('order_products')
                    ->leftJoin('products', 'products.id', '=', 'order_products.id')
                    ->join('categories', function ($q) {
                        $q->on('categories.id', '=', 'products.category_id');
                    })
                    ->where('products.sub_category_id', '=', $sub_category->id)
                    ->where('categories.type', '=', 'product')
                    ->whereNotNull('products.sub_category_id')
                    ->select(
                        'products.id',
                        'products.price',
                        'products.image',
                        'products.name_' . $lang . ' AS name',
                        'products.details_' . $lang . ' AS details',
                        'order_products.product_id',
                        'products.sub_category_id',
                        DB::raw('SUM(order_products.quantity) as total'))
                    ->groupBy(
                        'products.id',
                        'products.price',
                        'products.image',
                        'products.name_ar',
                        'products.name_en',
                        'products.details_ar',
                        'products.details_en',
                        'order_products.product_id',
                        'products.sub_category_id'
                    )
                    ->orderBy('total', 'desc')
                    ->whereStatus(1)
                    ->paginate(PAGINATION);
            } else {
                $products = $sub_category->products()
                    ->select(
                        'id',
                        'name_' . $lang . ' AS name',
                        'details_' . $lang . ' AS details',
                        'image',
                        'quantity',
                        'price',
                        'type',
                        'category_id',
                        'created_at')
                        
                    ->orderBy($price ? 'price' : 'id', $price ? $price : 'desc')
                    ->whereStatus(1)
                    ->whereHas('category', function ($query) {
                        $query->where('type', 'product');
                    })->paginate(PAGINATION);
            }
            return $this->returnData('products', $products, 'success');
        } catch (\Exception $e) {
            return $this->returnError($e->getCode(), $e->getMessage());
        }
    }

    public function show($id)
    {
        try {
            $lang = app()->getLocale();
            $product = Product::select(
                'id',
                'name_' . $lang . ' AS name',
                'details_' . $lang . ' AS details',
                'image',
                'quantity',
                'price',
                'type',
                'sub_category_id',
                'category_id',
                'created_at'
            )->with(['category' => function ($query) use ($lang) {
                return $query->select('id', 'name_' . $lang . ' AS name');
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
