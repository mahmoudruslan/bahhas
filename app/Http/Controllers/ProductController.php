<?php

namespace App\Http\Controllers;

use App\DataTables\ProductDataTable;
use App\Http\Requests\ProductRequest;
use App\Models\InnerCategory;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Traits\HtmlTrait;
use App\Traits\SaveImageTrait;


class ProductController extends Controller
{
    use SaveImageTrait;
    use HtmlTrait;
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
            $categories = InnerCategory::select('id','name_ar','name_en')->get();

            if (isset($request->product_id)) {
                $product = Product::find($request->product_id);
                return view('admin.products.create', compact('categories', 'product'));
            }
            return view('admin.products.create', compact('categories'));
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }


    public function store(ProductRequest $request)
    {
        try {
            $photo = $this->saveImage('products', $request->photo);
            $product = Product::create([
                'name_ar' => $request->name_ar,
                'name_en' => $request->name_en,
                'details_ar' => $request->details_ar ?? '---',
                'details_en' => $request->details_en ?? '---',
                'amount' => $request->amount ?? '---',
                'photo' => $photo,
                'price' => $request->price ?? '---',
                'unit' => $request->unit ?? '---',

                'discount_price' => $request->discount_price,
                'inner_category_id' => $request->inner_category_id,
                'product_id' => null,
            ]);
            $product->update([
                'first_appearing' => $product->id,

            ]);

            return redirect()->back()->with(['success' => 'Created Successfully']);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }


    public function edit($id)
    {
        try {
            $categories = InnerCategory::select('id', 'name_ar', 'name_en')->get();
            $product = Product::findOrFail($id);
            return view('admin.products.edit', compact(['product', 'categories']));
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
            $photo = $this->saveImage('products', $request->photo);
            $product = Product::findOrFail($id);
            $product->update([
                // 'first_appearing' => $request->first_appearing ?? $product->first_appearing,
                'name_ar' => $request->name_ar,
                'name_en' => $request->name_en,
                'details_ar' => $request->details_ar,
                'details_en' => $request->details_en,
                // 'amount' => $request->amount,
                'photo' => $photo ?? $product->photo,
                // 'price' => $request->price,
                // 'unit' => $request->unit,
                // 'discount_price' => $request->discount_price,

                'inner_category_id' => $request->inner_category_id,
            ]);
            return redirect()->back()->with(['success' => 'Updated Successfully']);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function destroy($id)
    {
        try {
            $product = Product::findOrFail($id);
            if (count($product->products) > 0 || count($product->orders) > 0) {
                return redirect()->back()->with(['error' => 'Element can\'t be deleted, there are things about it']);
            }
            $product->delete();
            return redirect()->back()->with(['success' => 'Deleted Successfully']);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
