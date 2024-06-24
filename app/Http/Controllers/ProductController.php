<?php

namespace App\Http\Controllers;

use App\DataTables\ProductDataTable;
use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use App\Traits\Files;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    use Files;
    public function index(ProductDataTable $dataTable)
    {
        try {

            return $dataTable->render('admin.products.index');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function create(Request $request)
    {
        try {
            $categories = Category::whereHas('subCategories')->select('id','name_ar','name_en')->get();
            return view('admin.products.create', compact('categories'));
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function store(ProductRequest $request)
    {
        try {
            $data = $request->validated();
                $path = 'images/products/';
                $file_name = $this->saveImag($path, [$request->image]);
                $data['image'] = $path . $file_name;
                if($request->file('book'))
                {
                    $book_name = $this->saveImag($path, [$request->book]);
                    $data['book'] = $book_name;
                }
            Product::create($data);
            return redirect()->route('admin.products.index')->with([
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
            $categories = Category::whereHas('subCategories')->select('id','name_ar','name_en')->get();
            $sub_categories = SubCategory::select('id','name_ar','name_en')->get();
            $product = Product::findOrFail($id);
            return view('admin.products.edit', compact('categories', 'sub_categories', 'product'));
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function show($id)
    {
        try {
            $product = Product::findOrFail($id);
            $product_types = $product->types;
            return view('admin.products.show', compact(['product', 'product_types']));
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }


    public function update(ProductRequest $request, $id)
    {
        try {
            
            $product = Product::findOrFail($id);
            $data = $request->validated();
            $image = $request->file('image');
            $path = 'images/products/';
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

            return redirect()->route('admin.products.index')->with([
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
            return redirect()->route('admin.products.index')->with([
                'message' => __('Item deleted successfully.'),
                'alert-type' => 'success']);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
