<?php

namespace App\Http\Controllers;

use App\DataTables\RoleDataTable;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Http\Requests\RolePermissionRequest;


class RolePermissionController extends Controller
{

    public function index(RoleDataTable $dataTable)
    {
        $permissions = userAbility(['roles']);
        return $dataTable->with('permissions' , $permissions)->render('admin.roles_permissions.index');
    }

    public function create()
    {
        userAbility(['roles']);
        $permissions = Permission::get();
        return view('admin.roles_permissions.create', compact('permissions'));
    }

    public function store(RolePermissionRequest $request)
    {
        try {
            userAbility(['roles']);
            $role = Role::create([
                'name' => $request->name,
                'guard_name' => 'web',
            ]);
            $role->givePermissionTo($request->permissions);
            return redirect()->route('admin.permission-roles.index')->with([
                'message' => __('Item Created successfully.'),
                'alert-type' => 'success']);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function edit($id)
    {
        try {
            userAbility(['roles']);
            $permissions = Permission::get();
            $role = Role::findOrFail($id);
            return view('admin.roles_permissions.edit', compact('permissions', 'role'));
        } catch (\Exception $e) {

            return $e->getMessage();
        }
    }

    public function update(RolePermissionRequest $request, $id)
    {
        try {
            userAbility(['roles']);

            $role = Role::findOrFail($id);
            $role->update(['name' => $request->name , 'guard_name'=> 'web' ]);
            $permissions = $request->permissions ?? [];
            $role->syncPermissions($permissions);
            return redirect()->route('admin.permission-roles.index')->with([
                'message' => __('Item Updated successfully.'),
                'alert-type' => 'success']);

        } catch (\Exception $e) {
            return $e->getMessage();
        }
}

    public function destroy(Role $role, $id)
    {
        try {
            userAbility(['roles']);
            $role = Role::findOrFail($id);
            $permissions = $role->permissions->pluck('name');
            $role->revokePermissionTo($permissions);
            $role->delete();
            return redirect()->route('admin.permission-roles.index')->with('success', __('Item Deleted successfully.'));
        } catch (\Exception $e) {

            return $e->getMessage();
        }

    }
}