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
            $lang = app()->getLocale();
            $blogs = Blog::with(['related' => function($query) use ($lang){
                return $query->select('id','blog_id',
                'title_'.$lang . ' AS title', 
                'description_'.$lang . ' AS description', 
                'image','created_at')->get();
            }])->select('id','title_'.$lang . ' AS title', 
                'description_'.$lang . ' AS description', 
                'image','created_at','blog_id' )
                ->paginate(PAGINATION);
            return $this->returnData('blogs', $blogs, 'success');
        } catch (\Exception $e) {
            return $this->returnError($e->getCode(), $e->getMessage());
        }
    }
}
