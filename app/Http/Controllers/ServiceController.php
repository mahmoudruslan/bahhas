<?php

namespace App\Http\Controllers;

use App\DataTables\ServiceDataTable;
use App\Http\Requests\ServiceRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use App\Traits\Files;
use Illuminate\Http\Request;


class ServiceController extends Controller
{
    use Files;
    public function index(ServiceDataTable $dataTable)
    {
        try {
            return $dataTable->render('admin.services.index');

        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function create(Request $request)
    {
        try {
            $categories = Category::WhereDoesntHave('subCategories')->select('id','name_ar','name_en')->get();
            $sub_categories = SubCategory::select('id','name_ar','name_en')->get();
            return view('admin.services.create', compact('categories', 'sub_categories'));
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function store(ServiceRequest $request)
    {
        try {
            $data = $request->validated();
                $path = 'images/services/';
                $file_name = $this->saveImag($path, [$request->image]);
                $data['image'] = $path . $file_name;
                if($request->file('book'))
                {
                    $book_name = $this->saveImag($path, [$request->book]);
                    $data['book'] = $book_name;
                }
            Product::create($data);
            return redirect()->route('admin.services.index')->with([
                'message' => __('Item Created successfully.'),
                'alert-type' => 'success']);

            return redirect()->back()->with(['success' => 'Created Successfully']);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function edit($id)
    {
        try {
            $categories = Category::WhereDoesntHave('subCategories')->select('id','name_ar','name_en')->get();
            $sub_categories = SubCategory::select('id','name_ar','name_en')->get();
            $product = Product::findOrFail($id);
            return view('admin.services.edit', compact('categories', 'sub_categories', 'product'));
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function show($id)
    {
        try {
            $product = Product::findOrFail($id);
            $product_types = $product->types;
            return view('admin.services.show', compact(['product', 'product_types']));
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }


    public function update(ServiceRequest $request, $id)
    {
        try {
            $product = Product::findOrFail($id);
            $data = $request->validated();
            $image = $request->file('image');
            $path = 'images/services/';
            if ($image) {
                $this->deleteFiles($product->image);
                $file_name = $this->saveImag($path, [$request->image]);
                $data['image'] = $path . $file_name;
            }
            if($request->file('book'))
                {
                    if($product->book != null)
                    {
                        $this->deleteFiles($product->book);
                    }
                    $book_name = $this->saveImag($path, [$request->book]);
                    $data['book'] = $book_name;
                }
            $product->update($data);

            return redirect()->route('admin.services.index')->with([
                'message' => __('Item updated successfully.'),
                'alert-type' => 'success']);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function destroy($id)
    {
        try {
            $product = Product::findOrFail($id);
            $this->deleteFiles($product->image);
            $product->delete();
            return redirect()->route('admin.services.index')->with([
                'message' => __('Item deleted successfully.'),
                'alert-type' => 'success']);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
