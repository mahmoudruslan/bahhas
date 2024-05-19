<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Traits\GeneralTrait;

class CategoryController extends Controller
{
    use GeneralTrait;
    public function index()
    {
        try {
            $categories = Category::get()->makeHidden(['name_ar', 'name_en']);
            return $this->returnData('categories', $categories, 'success');
        } catch (\Exception $e) {
            return $this->returnError($e->getCode(), $e->getMessage());
        }
    }

    public function show($id)
    {
        try {
            $category = Category::findOrFail($id);
            $inner_categories = $category->innerCategories->makeHidden([
                'name_ar', 
                'name_en',
            ]);
        
            return $this->returnData('inner_categories', $inner_categories , 'success');
        } catch (\Exception $e) {
            return $this->returnError($e->getCode(), $e->getMessage());
        }
    }
}
