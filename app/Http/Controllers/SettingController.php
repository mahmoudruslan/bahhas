<?php

namespace App\Http\Controllers;

use App\DataTables\SettingDataTable;
use App\Http\Requests\SettingRequest;
use App\Models\Setting;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(SettingDataTable $dataTable)
    {
        try {
            return $dataTable->render('admin.settings.index');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function edit(Setting $setting)
    {
        try {
            return view('admin.settings.edit', compact('setting'));
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function update(SettingRequest $request, $id)
    {
        try {
            $setting = Setting::findOrFail($id);
    
            $setting->update($request->validated());
            return redirect()->route('admin.settings.index')->with([
                'message' => __('Item updated successfully.'),
                'alert-type' => 'success']);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

}
