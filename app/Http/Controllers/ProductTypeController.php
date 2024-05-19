<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductTypeRequest;
use App\Models\InnerCategory;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Traits\HtmlTrait;
use App\Traits\SaveImageTrait;

class ProductTypeController extends Controller
{
    use HtmlTrait, SaveImageTrait;

    public function index(){
        return abort(404);
    }

    public function all(Request $request, $id)
    {
        try {
            $product = Product::findOrFail($id);
            $product_types = $product->products()->orderBy('first_appearing', 'DESC')->paginate(PAGINATION);
            return view('admin.product_types.index', compact('product_types', 'product'));
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function create(Request $request)
    {
        try {
            $categories = InnerCategory::select(
                'id',
                'name_ar',
                'name_en',
            )->get();

                $product = Product::find($request->product_id);
                return view('admin.product_types.create', compact('categories', 'product'));

        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function store(ProductTypeRequest $request)
    {
        try {
            $photo = $this->saveImage('products', $request->photo);
            $product = Product::create([
                'name_ar' => $request->name_ar,
                'name_en' => $request->name_en,
                'details_ar' => $request->details_ar,
                'details_en' => $request->details_en,
                'amount' => $request->amount,
                'photo' => $photo,
                'price' => $request->price,
                'unit' => $request->unit,
                'discount_price' => $request->discount_price,
                'inner_category_id' => $request->inner_category_id,
                'product_id' => $request->product_id,
            ]);
            $product->update([
                'first_appearing' => $product->id,

            ]);

            return redirect()->back()->with(['success' => 'Created Successfully']);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function show($id)
    {
        try {
            $product = Product::findOrFail($id);
            $product_types = $product->types;
            return view('admin.product_types.show', compact(['product', 'product_types']));
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function edit($id)
    {
        try {
            $categories = InnerCategory::select('id', 'name_ar', 'name_en')->get();
            $product = Product::findOrFail($id);
            return view('admin.product_types.edit', compact(['product', 'categories']));
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function update(ProductTypeRequest $request, $id)
    {
        // return $request->discount_price;
        try {
            $photo = $this->saveImage('products', $request->photo);
            $product = Product::findOrFail($id);
            $product->update([
                'first_appearing' => $request->first_appearing ?? $product->first_appearing,
                'name_ar' => $request->name_ar,
                'name_en' => $request->name_en,
                'details_ar' => $request->details_ar,
                'details_en' => $request->details_en,
                'amount' => $request->amount,
                'photo' => $photo ?? $product->photo,
                'price' => $request->price,
                'unit' => $request->unit,
                'discount_price' => $request->discount_price,
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
            if (count($product->orders) > 0) {
                return redirect()->back()->with(['error' => 'Element can\'t be deleted, there are things about it']);
            }
            $product->delete();
            return redirect()->back()->with(['success' => 'Deleted Successfully']);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
