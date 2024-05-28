<?php

namespace App\Http\Controllers;

use App\DataTables\ParentCategoryDataTable;
use App\Http\Requests\ParentCategoryRequest;
use App\Models\ParentCategory;
use App\Traits\Files;

class ParentCategoryController extends Controller
{
    use Files;
    public function index(ParentCategoryDataTable $dataTable)
    {
        try {
            return $dataTable->render('admin.parent_categories.index');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    public function create()
    {
        return view('admin.parent_categories.create');
    }

    public function store(ParentCategoryRequest $request)
    {
        try {
            $data = $request->validated();
                $path = 'images/parent_categories/';
                $file_name = $this->saveImag($path, [$request->cover]);
                $data['cover'] = $path . $file_name;
            ParentCategory::create($data);
            return redirect()->route('admin.parent-categories.index')->with([
                'message' => __('Item Created successfully.'),
                'alert-type' => 'success']);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function edit($id)
    {
        try {
            $parent_category = ParentCategory::findOrFail($id);
            return view('admin.parent_categories.edit', compact('parent_category'));
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function update(ParentCategoryRequest $request, $id)
    {
        try {
            $parent_category = ParentCategory::findOrFail($id);
            $data = $request->validated();
            $image = $request->file('cover');
            if ($image) {
                $this->deleteFiles($parent_category->cover);
                $path = 'images/parent_categories/';
                $file_name = $this->saveImag($path, [$request->cover]);
                $data['cover'] = $path . $file_name;
            }
            $parent_category->update($data);
            return redirect()->route('admin.parent-categories.index')->with([
                'message' => __('Item updated successfully.'),
                'alert-type' => 'success']);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function show($id)
    {
        try {
            $parent_category = ParentCategory::findOrFail($id);
            return view('admin.parent_categories.show', compact('parent_category'));
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function destroy($id)
    {
        try {
            $parent_category = ParentCategory::findOrFail($id);
            $this->deleteFiles($parent_category->image);
            $parent_category->delete();
            return redirect()->route('admin.parent-categories.index')->with([
                'message' => __('Item deleted successfully.'),
                'alert-type' => 'success']);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
