<?php

namespace App\Http\Controllers;

use App\DataTables\AdminDataTable;
use App\Models\User;
use App\Http\Requests\AdminRequest;
use App\Traits\Files;
use App\Traits\HtmlTrait;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    use HtmlTrait, Files;

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
        $roles = Role::select('id', 'name')->get();
        return view('admin.admins.create', compact('roles'));
    }

    public function store(AdminRequest $request)
    {
        try {
            $data = $request->validated();
            $image = $request->file('image');
            if ($image) {
                $path = 'images/admins/';
                $file_name = $this->saveImag($path, [$request->image]);
                
                $data['image'] = $path . $file_name;
            }
            $admin = User::create($data);
            $admin->markEmailAsVerified();
            $admin->assignRole($request->role);
            return redirect()->route('admin.admins.index')->with([
                'message' => __('Item Created successfully.'),
                'alert-type' => 'success']);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function edit($id)
    {
        try {
            $roles = Role::select('id', 'name')->get();
            $admin = User::findOrFail($id);
            return view('admin.admins.edit', compact('admin', 'roles'));
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function update(AdminRequest $request, $id)
    {
        try {
            $admin = User::findOrFail($id);
            $data = $request->validated();
            $image = $request->file('image');
            if ($image) {
                $this->deleteFiles($admin->image);
                $path = 'images/admins/';
                $file_name = $this->saveImag($path, [$request->image]);
                $data['image'] = $path . $file_name;
            }
            $admin->update($data);
            $admin->syncRoles($request->role);
            return redirect()->route('admin.admins.index')->with([
                'message' => __('Item updated successfully.'),
                'alert-type' => 'success']);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function show($id)
    {
        try {
            $admin = User::findOrFail($id);
            return view('admin.admins.show', compact('admin'));
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function destroy($id)
    {
        try {
            $admin = User::findOrFail($id);
            $this->deleteFiles($admin->image);
            $admin->delete();
            return redirect()->route('admin.admins.index')->with([
                'message' => __('Item deleted successfully.'),
                'alert-type' => 'success']);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
