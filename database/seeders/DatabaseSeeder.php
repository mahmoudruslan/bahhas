<?php

namespace Database\Seeders;

use App\Models\Ad;
use App\Models\User;
use App\Models\Review;
use App\Models\Address;
use App\Models\Blog;
use App\Models\Product;
use App\Models\Category;
use App\Models\Customer;
use App\Models\SubCategory;
use Illuminate\Database\Seeder;
use Database\Seeders\CitySeeder;
use Database\Seeders\CouponSeeder;
use Database\Seeders\CountrySeeder;
use Database\Seeders\ParentCategorySeeder;
use Database\Seeders\RolePermissionSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolePermissionSeeder::class);
        Ad::factory()->count(10)->create();
        User::factory()->count(10)->create();
        $this->call([CountrySeeder::class, CitySeeder::class]);
        Address::factory()->count(10)->create();
        Customer::factory()->count(10)->create();
        $this->call(ParentCategorySeeder::class);
        Category::factory()->count(10)->create();
        SubCategory::factory()->count(10)->create();
        Product::factory()->count(10)->create();
        Review::factory()->count(10)->create();
        // Blog::factory()->count(50)->create();
        $this->call([CouponSeeder::class, BlogSeeder::class]);

        $super_admin = User::factory()->create([
            'first_name' => 'mahmoud',
            'last_name' => 'kora',
            'email' => 'admin@admin.com',
            'password' => '00000000',
            'mobile' => '01092199386',
            'image' => 'images/users/avatar.svg',
            'status' => 1,
            'image' => 'admin.svg',

        ]);
        $super_admin->assignRole('super-admin');
        $admin = User::factory()->create([
            'first_name' => 'rezk',
            'last_name' => 'kora',
            'email' => 'rezk@gmail.com',
            'password' => '00000000',
            'mobile' => '010545445446',
            'image' => 'images/users/avatar.svg',
            'status' => 1,
            'image' => 'admin.svg',
        ]);
        $admin->assignRole('admin');
        $employee = User::factory()->create([
            'first_name' => 'ebraheem',
            'last_name' => 'kora',
            'email' => 'ebraheem@gmail.com',
            'password' => '00000000',
            'mobile' => '01097978898986',
            'image' => 'images/users/avatar.svg',
            'status' => 1,
            'image' => 'admin.svg',
        ]);
        $employee->assignRole('employee');

    }
}
