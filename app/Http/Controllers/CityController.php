<?php

namespace App\Http\Controllers;

use App\DataTables\CityDataTable;
use Illuminate\Http\Request;

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
}
