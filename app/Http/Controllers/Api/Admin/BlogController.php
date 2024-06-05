<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    use GeneralTrait;
    public function index()
    {
        try {
            $blogs = Blog::with('related')->select(
                'id',
                'title_'.app()->getLocale() . ' AS title', 
                'description_'.app()->getLocale() . ' AS description', 
                'image', )
                ->get();
            return $this->returnData('blogs', $blogs, 'success');
        } catch (\Exception $e) {
            return $this->returnError($e->getCode(), $e->getMessage());
        }
    }
}
