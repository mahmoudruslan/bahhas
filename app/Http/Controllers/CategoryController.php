<?php

namespace App\Http\Controllers;

use App\DataTables\CategoryDataTable;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Traits\Files;

class CategoryController extends Controller
{
    use Files;

    public function index(CategoryDataTable $dataTable)
    {
        try {
            return $dataTable->render('admin.categories.index');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(CategoryRequest $request)
    {
        try {
            $data = $request->validated();
                $path = 'images/categories/';
                $file_name = $this->saveImag($path, [$request->cover]);
                $data['cover'] = $path . $file_name;
            Category::create($data);
            return redirect()->route('admin.categories.index')->with([
                'message' => __('Item Created successfully.'),
                'alert-type' => 'success']);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function edit($id)
    {
        try {
            $category = Category::findOrFail($id);
            return view('admin.categories.edit', compact('category'));
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function update(CategoryRequest $request, $id)
    {
        try {
            $category = Category::findOrFail($id);
            $data = $request->validated();
            $image = $request->file('cover');
            if ($image) {
                $this->deleteFiles($category->cover);
                $path = 'images/categories/';
                $file_name = $this->saveImag($path, [$request->cover]);
                $data['cover'] = $path . $file_name;
            }
            $category->update($data);
            return redirect()->route('admin.categories.index')->with([
                'message' => __('Item updated successfully.'),
                'alert-type' => 'success']);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function show($id)
    {
        try {
            $category = Category::findOrFail($id);
            return view('admin.categories.show', compact('category'));
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function destroy($id)
    {
        try {
            $category = Category::findOrFail($id);
            if (count($category->subCategories) > 0 || count($category->products) > 0) {

                return redirect()->route('admin.categories.index')->with([
                    'message' => __('can\'t delete this item'),
                    'alert-type' => 'danger']);
            }
            $this->deleteFiles($category->image);
            $category->delete();
            return redirect()->route('admin.categories.index')->with([
                'message' => __('Item deleted successfully.'),
                'alert-type' => 'success']);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
