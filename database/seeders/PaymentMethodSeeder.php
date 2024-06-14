<?php

namespace Database\Seeders;

use App\Models\PaymentMethod;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PaymentMethod::create([
            'name' => 'rajhi',
            'code' => 'PPEX',
            'driver_name' => 'RAJHI_EXPRESS',
            'merchant_email' => null,
            'username' => null,
            'password' => null,
            'secret' => null,
            'sandbox_username' => null,
            'sandbox_password' => null,
            'sandbox_secret' => null,
            'sandbox' => null,
            'status' => null,
        ]);
    }
}
