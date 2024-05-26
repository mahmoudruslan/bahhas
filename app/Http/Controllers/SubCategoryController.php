<?php

namespace App\Http\Controllers;

use App\DataTables\SubCategoryDataTable;
use App\Http\Requests\SubCategoryRequest;
use App\Models\Category;
use App\Models\SubCategory;
use App\Traits\HtmlTrait;
use App\Traits\SaveImageTrait;

class SubCategoryController extends Controller
{
    use HtmlTrait, SaveImageTrait;

    public function index(SubCategoryDataTable $dataTable)
    {
        try {
            return $dataTable->render('admin.sub_categories.index');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }


    public function create()
    {
        $categories = Category::select(
            'id',
            'name_ar',
            'name_en',
        )->get();
        return view('admin.inner_categories.create', compact('categories'));
    }

    public function store(SubCategoryRequest $request)
    {
        try {
            $photo_name = $this->saveImage('inner_categories', $request->photo);
            SubCategory::create([
                'name_ar' => $request->name_ar,
                'name_en' => $request->name_en,
                'photo' => $photo_name,
                'category_id' => $request->category_id,
            ]);

            return redirect()->route('admin.inner_categories.index')->with(['success' => 'Created Successfully']);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }


    public function show($id)
    {
        try {
            $inner_category = SubCategory::findOrFail($id);
            return view('admin.inner_categories.show', compact('inner_category'));
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }


    public function edit($id)
    {
        try {
            $inner_category = SubCategory::findOrFail($id);// inner category
            $categories = Category::select('id', 'name_ar', 'name_en')->get();
            return view('admin.inner_categories.edit', compact('inner_category', 'categories'));
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }


    public function update(SubCategoryRequest $request, $id)
    {
        try {
            $photo =$this->saveImage('inner_categories', $request->photo);
            $inner_category = SubCategory::findOrFail($id);
            $inner_category->update([
                'name_ar' => $request->name_ar,
                'name_en' => $request->name_en,
                'photo' => $photo ?? $inner_category->photo,
                'category_id' => $request->category_id,
            ]);
            return redirect()->route('admin.inner_categories.index')->with(['success' => 'Updated Successfully']);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }


    public function destroy($id)
    {
        try {
            $inner_category = SubCategory::findOrFail($id);
            if (count($inner_category->products) > 0) {
                return redirect()->back()->with(['error' => 'Element can\'t be deleted, there are things about it']);
            }
            $inner_category->delete();
            return redirect()->back()->with(['success' => 'Deleted Successfully']);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

}
