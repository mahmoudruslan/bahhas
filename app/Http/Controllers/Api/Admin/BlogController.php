<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Traits\GeneralTrait;

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

    public function show($id)
    {
        // dd(true);
        try {
            $lang = app()->getLocale();
            $blog = Blog::select('id','title_'. $lang . ' AS title', 
                'description_'. $lang . ' AS description', 
                'image','blog_id','created_at')
                ->with(['related' => function($query) use ($lang){
                return $query->select('id', 'title_'. $lang . ' AS title', 
                'description_'. $lang . ' AS description', 
                'image','blog_id','created_at');
                }
            ])->find($id);
            if (!$blog) {
                return $this->returnError('404', 'blog not found');
            }
            return $this->returnData('blog', $blog, 'success');
        } catch (\Exception $e) {
            return $this->returnError($e->getCode(), $e->getMessage());
        }
    }
}
