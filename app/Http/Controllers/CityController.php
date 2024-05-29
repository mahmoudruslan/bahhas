<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Country;
use App\DataTables\CityDataTable;
use App\Http\Requests\CityRequest;

class CityController extends Controller
{
    public function index(CityDataTable $dataTable)
    {
        try {
            return $dataTable->render('admin.cities.index');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    public function create()
    {
        $countries = Country::get();
        return view('admin.cities.create', compact('countries'));
    }

    public function store(CityRequest $request)
    {
        try {
            City::create($request->validated());
            return redirect()->route('admin.cities.index')->with([
                'message' => __('Item Created successfully.'),
                'alert-type' => 'success']);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function destroy(City $city)
    {
        try {
            $city->delete();
            return redirect()->route('admin.cities.index')->with([
                'message' => __('Item deleted successfully.'),
                'alert-type' => 'success']);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
