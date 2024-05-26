<?php

namespace App\Http\Controllers;

use App\DataTables\AdminDataTable;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\AdminRequest;
use App\Traits\HtmlTrait;
use DataTables;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    use HtmlTrait;

    public function index(AdminDataTable $dataTable)
    {
        try {
            return $dataTable->render('admin.admins.index');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function create()
    {
        return view('admin.admins.create');
    }

    public function store(AdminRequest $request)
    {
        
        try {
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
                'phone' => $request->phone,
                'address' => $request->address,
            ]);
            return redirect()->route('admin.admins.index')->with(['success' => 'Created Successfully']);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }



    public function edit($id)
    {
        try {
            $admin = User::findOrFail($id);
            return view('admin.admins.edit', compact('admin'));
        } catch (\Exception $e) {

            return $e->getMessage();
        }
    }


    public function update(AdminRequest $request, $id)
    {
        try {
            $admin = User::findOrFail($id);
            $admin->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
                'phone' => $request->phone,
                'address' => $request->address,
            ]);
            return redirect()->back()->with(['success' => 'Updated Successfully']);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }


    public function destroy($id)
    {
        try {
            $admin = User::findOrFail($id);
            $admin->delete();
            return redirect()->back()->with(['success' => 'Deleted Successfully']);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
