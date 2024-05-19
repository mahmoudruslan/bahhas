<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\InnerCategoryRequest;
use App\Models\Category;
use App\Models\InnerCategory;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Traits\HtmlTrait;
use App\Traits\SaveImageTrait;
use DataTables;
use Yajra\DataTables\Facades\DataTables as FacadesDataTables;

class SubCategoryController extends Controller
{
    use HtmlTrait, SaveImageTrait;

    public function index(Request $request)
    {
        try {
            if ($request->ajax()) {
                $inner_category = InnerCategory::orderBy('id', 'desc')->get();
                return FacadesDataTables::of($inner_category)
                    ->addIndexColumn()
                    ->editColumn('category_id', function($row){
                        return $row->category->name_ar;
                    })
                    ->addColumn('action', function ($row) {
                        $btn = $this->h_edit(route('admin.inner_categories.edit', $row->id));
                        $btn = $btn . ' ' . $this->h_show(route('admin.inner_categories.show', $row->id));
                        $btn = $btn . ' ' . $this->h_delete($row);
                        $btn = $btn . ' ' . $this->modal($row, route('admin.inner_categories.destroy', $row->id));
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }
            return view('admin.inner_categories.index');
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

    public function store(InnerCategoryRequest $request)
    {
        try {
            $photo_name = $this->saveImage('inner_categories', $request->photo);
            InnerCategory::create([
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
            $inner_category = InnerCategory::findOrFail($id);
            return view('admin.inner_categories.show', compact('inner_category'));
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }


    public function edit($id)
    {
        try {
            $inner_category = InnerCategory::findOrFail($id);// inner category
            $categories = Category::select('id', 'name_ar', 'name_en')->get();
            return view('admin.inner_categories.edit', compact('inner_category', 'categories'));
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }


    public function update(InnerCategoryRequest $request, $id)
    {
        try {
            $photo =$this->saveImage('inner_categories', $request->photo);
            $inner_category = InnerCategory::findOrFail($id);
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
            $inner_category = InnerCategory::findOrFail($id);
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
