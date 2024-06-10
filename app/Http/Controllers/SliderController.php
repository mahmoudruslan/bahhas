<?php

namespace App\Http\Controllers;

use App\DataTables\SliderDataTable;
use App\Http\Requests\SliderRequest;
use App\Models\Slider;
use App\Traits\Files;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    use Files;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(SliderDataTable $dataTable)
    {
        try {
            return $dataTable->render('admin.sliders.index');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function create()
    {
        return view('admin.sliders.create');
    }

    public function store(SliderRequest $request)
    {
        try {
            $data = $request->validated();
                $path = 'images/sliders/';
                $file_name = $this->saveImag($path, [$request->cover]);
                $data['cover'] = $path . $file_name;
            Slider::create($data);
            return redirect()->route('admin.sliders.index')->with([
                'message' => __('Item Created successfully.'),
                'alert-type' => 'success']);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function edit(Slider $slider)
    {
        try {
            // $slider = Slider::findOrFail($id);
            // $parent_sliders = ParentSlider::get();
            return view('admin.sliders.edit', compact('slider'));
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function update(SliderRequest $request, $id)
    {
        try {
            $category = Slider::findOrFail($id);
            $data = $request->validated();
            $image = $request->file('cover');
            if ($image) {
                $this->deleteFiles($category->cover);
                $path = 'images/sliders/';
                $file_name = $this->saveImag($path, [$request->cover]);
                $data['cover'] = $path . $file_name;
            }
            $category->update($data);
            return redirect()->route('admin.sliders.index')->with([
                'message' => __('Item updated successfully.'),
                'alert-type' => 'success']);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function show(Slider $slider)
    {
        try {
            return view('admin.sliders.show', compact('slider'));
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function destroy(Slider $slider)
    {
        try {
            $this->deleteFiles($slider->cover);
            $slider->delete();
            return redirect()->route('admin.sliders.index')->with([
                'message' => __('Item deleted successfully.'),
                'alert-type' => 'success']);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
