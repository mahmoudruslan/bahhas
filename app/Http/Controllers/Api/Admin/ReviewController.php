<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReviewRequest;
use App\Models\Review;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReviewController extends Controller
{
    use GeneralTrait;


    public function index()
    {
        try {
            $reviews = Review::select('id', 'description', 
            'username', 'created_at')
        ->orderBy('id', 'desc')
        ->get();
            return $this->returnData('reviews', $reviews, 'success');
        } catch (\Exception $e) {
            return $this->returnError($e->getCode(), $e->getMessage());
        }
    }

    public function store()
    {
        try {

            $validator = Validator::make(request()->all(), [
                'description' => 'required|string|max:500',
            'username' => 'required|string',
            'rating' => 'nullable',
            ]);
            
            if ($validator->fails()) {
                return $this->returnValidationError($validator);
            }
            Review::create($validator->validated());
            
            return $this->returnSuccess();
        } catch (\Exception $e) {
            return $this->returnError($e->getCode(), $e->getMessage());
        }
    }
}
