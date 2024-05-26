<?php

namespace App\Http\Controllers;

use App\DataTables\CategoryDataTable;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Illuminate\Http\Request;
use App\Traits\HtmlTrait;
use App\Traits\SaveImageTrait;
use DataTables;

class CategoryController extends Controller
{
    use HtmlTrait, SaveImageTrait;

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
            $photo_name = $this->saveImage('categories', $request->photo);
            Category::create([
                'name_ar' => $request->name_ar,
                'name_en' => $request->name_en,
                'photo' => $photo_name,
            ]);

            return redirect()->route('admin.categories.index')->with(['success' => 'Created Successfully']);
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
            $photo_name = $this->saveImage('categories', $request->photo);

            $category = Category::findOrFail($id);
            $category->update([
                'name_ar' => $request->name_ar,
                'name_en' => $request->name_en,
                'photo' => $photo_name ?? $category->photo,
            ]);
            return redirect()->route('admin.categories.index')->with(['success' => 'Updated Successfully']);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    

    public function destroy($id)
    {
        try {
            $category = Category::findOrFail($id);
            if (count($category->innerCategories) > 0) {
                return redirect()->back()->with(['error' => 'Element can\'t be deleted, there are things about it']);
            }
            $category->delete();
            return redirect()->back()->with(['success' => 'Deleted Successfully']);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
