<?php

namespace App\Http\Controllers;

use App\DataTables\AdDataTable;
use App\Http\Requests\AdRequest;
use App\Models\Ad;
use App\Traits\Files;

class AdController extends Controller
{
    use Files;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(AdDataTable $dataTable)
    {
        try {
            return $dataTable->render('admin.ads.index');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function create()
    {
        // $parent_ads = ParentAd::get();
        return view('admin.ads.create');
    }

    public function store(AdRequest $request)
    {
        try {
            $data = $request->validated();
                $path = 'images/ads/';
                $file_name = $this->saveImag($path, [$request->cover]);
                $data['cover'] = $path . $file_name;
            Ad::create($data);
            return redirect()->route('admin.ads.index')->with([
                'message' => __('Item Created successfully.'),
                'alert-type' => 'success']);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function edit(Ad $ad)
    {
        try {
            // $ad = Ad::findOrFail($id);
            // $parent_ads = ParentAd::get();
            return view('admin.ads.edit', compact('ad'));
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function update(AdRequest $request, $id)
    {
        try {
            $category = Ad::findOrFail($id);
            $data = $request->validated();
            $image = $request->file('cover');
            if ($image) {
                $this->deleteFiles($category->cover);
                $path = 'images/ads/';
                $file_name = $this->saveImag($path, [$request->cover]);
                $data['cover'] = $path . $file_name;
            }
            $category->update($data);
            return redirect()->route('admin.ads.index')->with([
                'message' => __('Item updated successfully.'),
                'alert-type' => 'success']);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function show(Ad $ad)
    {
        try {
            return view('admin.ads.show', compact('ad'));
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function destroy(Ad $ad)
    {
        try {
            $this->deleteFiles($ad->cover);
            $ad->delete();
            return redirect()->route('admin.ads.index')->with([
                'message' => __('Item deleted successfully.'),
                'alert-type' => 'success']);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
