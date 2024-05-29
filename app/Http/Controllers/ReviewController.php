<?php

namespace App\Http\Controllers;

use App\DataTables\ReviewDataTable;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ReviewDataTable $dataTable)
    {
        try {
            return $dataTable->render('admin.reviews.index');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function destroy(Review $review)
    {
        try {
            $review->delete();
            return redirect()->route('admin.reviews.index')->with([
                'message' => __('Item deleted successfully.'),
                'alert-type' => 'success']);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
