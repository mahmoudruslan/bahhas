<?php

namespace App\Http\Controllers;

use App\DataTables\AdDataTable;
use App\Http\Requests\AdRequest;
use App\Models\Ad;
use App\Traits\SaveImageTrait;
use Illuminate\Http\Request;

class AdController extends Controller
{
    use SaveImageTrait;
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
        try {
            return view('admin.ads.create');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function store(AdRequest $request)
    {
        try {
            $photo_name = $this->saveImage('ads', $request->photo);
            Ad::create([
                'photo' => $photo_name,
                'target' => $request->target,
            ]);
            return redirect()->route('admin.ads.index')->with('success', __('Created Successfully'));
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }


    public function show($id)
    {
        try {
            $ad = Ad::findOrFail($id);

            return view('admin.ads.show', compact('ad'));
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function edit($id)
    {
        try {
            $ad = Ad::findOrFail($id);

            return view('admin.ads.edit', compact('ad'));
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $photo_name = $this->saveImage('ads', $request->photo);

            $ad = Ad::findOrFail($id);
            $ad->update([
                'target' => $request->target,
                'photo' => $photo_name ?? $ad->photo
            ]);
            return redirect()->route('admin.ads.index')->with('success', __('Updated Successfully'));

        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function destroy($id)
    {
        try {
            $ad = Ad::findOrFail($id);
            $ad->delete();
            return redirect()->back()->with('success', __('Deleted Successfully'));

        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
