<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

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

    public function categoryServices($service_category_id)
    {
        try {
            $lang = app()->getLocale();
            $service_category = Category::findOrFail($service_category_id);
            $services = $service_category->products()
                ->select('id', 'name_'. $lang . ' AS name', 
                    'details_'. $lang . ' AS details', 
                    'image', 'quantity',
                    'price','category_id','created_at','type')
                ->orderBy('id', 'desc')
                ->whereStatus(1)
                ->whereNull('sub_category_id')
                ->whereHas('category', function($query){
                    $query->where('type', 'service');
                })->get();

            return $this->returnData('services', $services, 'success');
        } catch (\Exception $e) {
            return $this->returnError($e->getCode(), $e->getMessage());
        }
    }
}
