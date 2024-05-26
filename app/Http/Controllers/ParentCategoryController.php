<?php

namespace App\Http\Controllers;

use App\DataTables\ParentCategoryDataTable;
use Illuminate\Http\Request;

class ParentCategoryController extends Controller
{
    public function index(ParentCategoryDataTable $dataTable)
    {
        try {
            return $dataTable->render('admin.parent_categories.index');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
