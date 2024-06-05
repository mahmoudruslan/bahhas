<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\SubCategory;
use App\Traits\GeneralTrait;

class SubCategoryController extends Controller
{
    use GeneralTrait;

    public function subCategories($category_id)
    {
        try {
            $sub_categories = SubCategory::select('name_'.app()->getLocale() . ' AS name', 'cover', 'category_id')
            ->where('category_id', $category_id)->get();
            return $this->returnData('sub-categories', $sub_categories, 'success');
        } catch (\Exception $e) {
            return $this->returnError($e->getCode(), $e->getMessage());
        }
    }

    // public function show($id)
    // {
    //     try {
    //         $category = ParentCategory::findOrFail($id);
    //         $inner_categories = $category->innerCategories->makeHidden([
    //             'name_ar', 
    //             'name_en',
    //         ]);
        
    //         return $this->returnData('inner_categories', $inner_categories , 'success');
    //     } catch (\Exception $e) {
    //         return $this->returnError($e->getCode(), $e->getMessage());
    //     }
    // }
}
