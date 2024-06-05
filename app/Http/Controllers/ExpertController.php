<?php

namespace App\Http\Controllers;

use App\DataTables\ExpertDataTable;
use App\Http\Requests\ExpertRequest;
use App\Models\Country;
use App\Models\Expert;
use App\Traits\Files;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class ExpertController extends Controller
{
    use Files;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ExpertDataTable $dataTable)
    {
        try {
            return $dataTable->render('admin.experts.index');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    // public function create()
    // {
    //     return view('admin.experts.create');
    // }

    // public function store(ExpertRequest $request)
    // {
    //     try {
    //         $data = $request->validated();
    //             $path = 'images/experts/';
    //             $file_name = $this->saveImag($path, [$request->image]);
    //             $data['image'] = $path . $file_name;
    //         Expert::create($data);
    //         return redirect()->route('admin.experts.index')->with([
    //             'message' => __('Item Created successfully.'),
    //             'alert-type' => 'success']);
    //     } catch (\Exception $e) {
    //         return $e->getMessage();
    //     }
    // }

    public function edit(Expert $expert)
    {
        try {
            $countries = Country::get();
            return view('admin.experts.edit', compact('expert', 'countries'));
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function update(ExpertRequest $request, Expert $expert)
    {
        try {
            $data = $request->validated();
            $image = $request->file('image');

            if ($image) {
                $this->deleteFiles($expert->image);
                $path = 'images/experts/';
                $file_name = $this->saveImag($path, [$request->image]);
                $data['image'] = $path . $file_name;
            }
            $expert->update($data);
            return redirect()->route('admin.experts.index')->with([
                'message' => __('Item updated successfully.'),
                'alert-type' => 'success']);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function show(Expert $expert)
    {
        try {
            return view('admin.experts.show', compact('expert'));
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function destroy(Expert $expert)
    {
        try {
            $this->deleteFiles($expert->image);
            $this->deleteFiles($expert->the_biography);
            $this->deleteFiles($expert->IBAN_certificate);
            $expert->delete();
            return redirect()->route('admin.experts.index')->with([
                'message' => __('Item deleted successfully.'),
                'alert-type' => 'success']);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }


          //download PDF
    public function download(Request $request)
    {
        $expert = Expert::find($request->id);
        return response()->download(public_path('storage/' . $expert[$request->input_name]));

    }
    
}
