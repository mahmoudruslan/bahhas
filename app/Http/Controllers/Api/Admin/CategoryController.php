<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Traits\GeneralTrait;

class CategoryController extends Controller
{
    use GeneralTrait;
    // public function index()
    // {
    //     try {
    //         $categories = Category::select('id', 'name_'.app()->getLocale() . ' AS name', 'cover', 'parent_category_id')
    //         ->with('parent:id,name_'.app()->getLocale() . ' AS name,cover')->get();
    //         return $this->returnData('categories', $categories, 'success');
    //     } catch (\Exception $e) {
    //         return $this->returnError($e->getCode(), $e->getMessage());
    //     }
    // }

    public function productCategories()
    {
        try {
            $categories = Category::select('id', 'name_'.app()->getLocale() . ' AS name', 'cover', 'type')->with('subCategories')->where('type', 'product')->get();
            return $this->returnData('categories', $categories, 'success');
        } catch (\Exception $e) {
            return $this->returnError($e->getCode(), $e->getMessage());
        }
    }

    public function serviceCategories()
    {
        try {
            $categories = Category::select('id', 'name_'.app()->getLocale() . ' AS name', 'cover', 'type')->where('type', 'service')->get();
            return $this->returnData('categories', $categories, 'success');
        } catch (\Exception $e) {
            return $this->returnError($e->getCode(), $e->getMessage());
        }
    }

    public function advisorCategories()
    {
        try {
            $categories = Category::select('id', 'name_'.app()->getLocale() . ' AS name', 'cover', 'type')->where('type', 'advisor')->get();
            return $this->returnData('categories', $categories, 'success');
        } catch (\Exception $e) {
            return $this->returnError($e->getCode(), $e->getMessage());
        }
    }

    // public function show($id)
    // {
    //     try {
    //         $category = Category::findOrFail($id);
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
