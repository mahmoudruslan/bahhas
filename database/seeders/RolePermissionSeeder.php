<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $all_permissions = [
            'main',
            'roles',
            'admins',
            'categories',
            'products',
            'coupons',
            'cities',
            'reviews',
            'parent-categories',
            'sub-categories',
            'services',
            'orders',
            'ads',
            'sliders',
            'contact-me',
            'bhhath',
            'customer',
            'settings',
            'bank-accounts',
            'experts'
        ];

        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();
        $permissions = collect($all_permissions)->map(function($permission){
            return [
                'name' => $permission ,
                'guard_name'=> 'web'
            ];
        });
        // dd($permissions->toArray());
        Permission::insert($permissions->toArray());

        Role::create(['name' => 'super-admin']);
        // Role::create(['name' => 'customer']);
        $admin_role = Role::create(['name' => 'admin']);
        $employee_role = Role::create(['name' => 'employee']);

        $admin_role->givePermissionTo([ 'admins', 'roles', 'main']);
        $employee_role->givePermissionTo(['products', 'categories']);
    }
}
