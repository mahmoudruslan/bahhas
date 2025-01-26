<?php

namespace App\Http\Controllers;

use App\DataTables\SubCategoryDataTable;
use App\Http\Requests\SubCategoryRequest;
use App\Models\Category;
use App\Models\SubCategory;
use App\Traits\Files;

class SubCategoryController extends Controller
{
    use Files;

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
        $categories = Category::where('type', 'product')->get();
        return view('admin.sub_categories.create', compact('categories'));
    }

    public function store(SubCategoryRequest $request)
    {
        try {
            $data = $request->validated();
                $path = 'images/sub_categories/';
                $file_name = $this->saveImag($path, [$request->cover]);
                $data['cover'] = $path . $file_name;
            SubCategory::create($data);
            return redirect()->route('admin.sub-categories.index')->with([
                'message' => __('Item Created successfully.'),
                'alert-type' => 'success']);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function edit($id)
    {
        try {
            $sub_category = SubCategory::findOrFail($id);
            $categories = Category::where('type', 'product')->get();
            return view('admin.sub_categories.edit', compact('sub_category', 'categories'));
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function update(SubCategoryRequest $request, $id)
    {
        try {
            $category = SubCategory::findOrFail($id);
            $data = $request->validated();
            $image = $request->file('cover');
            if ($image) {
                $this->deleteFiles($category->cover);
                $path = 'images/sub_categories/';
                $file_name = $this->saveImag($path, [$request->cover]);
                $data['cover'] = $path . $file_name;
            }
            $category->update($data);
            return redirect()->route('admin.sub-categories.index')->with([
                'message' => __('Item updated successfully.'),
                'alert-type' => 'success']);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function show($id)
    {
        try {
            $sub_category = SubCategory::findOrFail($id);
            return view('admin.sub_categories.show', compact('sub_category'));
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function destroy($id)
    {
        try {
            $sub_category = SubCategory::findOrFail($id);
            if (count($sub_category->products) > 0) {

                return redirect()->route('admin.sub-categories.index')->with([
                    'message' => __('can\'t delete this item'),
                    'alert-type' => 'danger']);
            }
            $this->deleteFiles($sub_category->image);
            $sub_category->delete();
            return redirect()->route('admin.sub-categories.index')->with([
                'message' => __('Item deleted successfully.'),
                'alert-type' => 'success']);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

}
