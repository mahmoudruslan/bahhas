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
        $this->call(UserSeeder::class);
        Ad::factory()->count(5)->create();
        
        $this->call(CountrySeeder::class);
        $this->call(CustomerSeeder::class);
        $this->call(CategorySeeder::class);
        SubCategory::factory()->count(10)->create();
        Product::factory()->count(50)->create();
        Review::factory()->count(10)->create();
        $this->call(CouponSeeder::class);
        $this->call(BlogSeeder::class);
        $this->call(ContactMeSeeder::class);
        $this->call(BhhathSeeder::class);
        $this->call(ExpertSeeder::class);
        $this->call(SliderSeeder::class);
        $this->call(PaymentMethodSeeder::class);
        $this->call(SettingSeeder::class);
        $this->call(OrderSeeder::class);
        $this->call(OrderProductSeeder::class);
        




    }
}
