<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Coupon;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CouponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    Coupon::create([
        'code' => 'ramadan200',
        'status' => true,
        'value' => 12,
        'description_ar' => 'خصم 100 ريال على مبيعاتك على الموقع',
        'description_en' => 'Discount 200 pound on your sales on website',
        'use_times' => 100,
        'used_times' => 20,
        'start_date' => Carbon::now(),
        'expire_date' => Carbon::now()->addMonth(),
        'greater_than' => 200,
]);
    Coupon::create([
            'code' => '3edfetr200',
            'status' => false,
            'value' => 20,
            'description_ar' => 'خصم 200 جنيه على مبيعاتك على الموقع',
            'description_en' => 'Discount 200 pound on your sales on website',
            'use_times' => 100,
            'used_times' => 20,
            'start_date' => Carbon::now(),
            'expire_date' => Carbon::now()->addMonth(),
            'greater_than' => 200,
    ]);
    }
}
