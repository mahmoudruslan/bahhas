<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use App\DataTables\BlogDataTable;
use App\Http\Requests\BlogRequest;
use App\Traits\Files;

class BlogController extends Controller
{
    use Files;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(BlogDataTable $dataTable)
    {
        return $dataTable->render('admin.blogs.index');
    }

    public function create()
    {
        $blogs = Blog::get();
        return view('admin.blogs.create', compact('blogs'));
    }

    public function store(BlogRequest $request)
    {
        try {
            $data = $request->validated();
                $path = 'images/blogs/';
                $file_name = $this->saveImag($path, [$request->image]);
                $data['image'] = $path . $file_name;
            Blog::create($data);
            return redirect()->route('admin.blogs.index')->with([
                'message' => __('Item Created successfully.'),
                'alert-type' => 'success']);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function edit(Blog $blog)
    {
        try {
            $blogs = Blog::get();
        return view('admin.blogs.edit', compact('blogs', 'blog'));
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function update(BlogRequest $request, Blog $blog)
    {
        try {
            $data = $request->validated();
            $image = $request->file('image');
            if ($image) {
                $this->deleteFiles($blog->image);
                $path = 'images/blogs/';
                $file_name = $this->saveImag($path, [$request->image]);
                $data['image'] = $path . $file_name;
            }
            $blog->update($data);
            return redirect()->route('admin.blogs.index')->with([
                'message' => __('Item updated successfully.'),
                'alert-type' => 'success']);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function show(Blog $blog)
    {
        try {
            return view('admin.blogs.show', compact('blog'));
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function destroy(Blog $blog)
    {
        try {
            $this->deleteFiles($blog->image);
            $blog->delete();
            return redirect()->route('admin.blogs.index')->with([
                'message' => __('Item deleted successfully.'),
                'alert-type' => 'success']);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
