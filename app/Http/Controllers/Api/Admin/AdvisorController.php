<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

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

    public function categoryAdvisors($advisor_category_id)
    {
        try {
            $lang = app()->getLocale();
            $advisor_category = Category::findOrFail($advisor_category_id);
            $advisors = $advisor_category->products()
                ->select('id', 'name_'. $lang . ' AS name', 
                    'details_'. $lang . ' AS details', 
                    'image', 'quantity',
                    'price','type','category_id','created_at')
                ->orderBy('id', 'desc')
                ->whereStatus(1)
                ->whereNull('sub_category_id')
                ->whereHas('category', function($query){
                    $query->where('type', 'advisor');
                })->paginate(PAGINATION);

            return $this->returnData('advisors', $advisors, 'success');
        } catch (\Exception $e) {
            return $this->returnError($e->getCode(), $e->getMessage());
        }
    }
}
