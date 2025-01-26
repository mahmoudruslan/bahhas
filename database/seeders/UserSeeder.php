<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        User::factory()->count(10)->create();
        $super_admin = User::factory()->create([
            'first_name' => 'mahmoud',
            'last_name' => 'kora',
            'email' => 'admin@admin.com',
            'password' => '00000000',
            'mobile' => '01092199386',
            'image' => 'images/admins/admin.svg.png',

        ]);
        $super_admin->assignRole('super-admin');
        $admin = User::factory()->create([
            'first_name' => 'rezk',
            'last_name' => 'kora',
            'email' => 'rezk@gmail.com',
            'password' => '00000000',
            'mobile' => '010545445446',
            'image' => 'images/admins/admin.svg.png',
        ]);
        $admin->assignRole('admin');
        $employee = User::factory()->create([
            'first_name' => 'ebraheem',
            'last_name' => 'kora',
            'email' => 'ebraheem@gmail.com',
            'password' => '00000000',
            'mobile' => '01097978898986',
            'image' => 'images/admins/admin.svg.png',
        ]);
        $employee->assignRole('employee');
    }
}
