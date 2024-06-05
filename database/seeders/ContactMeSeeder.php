<?php

namespace Database\Seeders;

use App\Models\ContactMe;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContactMeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ContactMe::create([
            'whatsapp_number' => '01092199386',
            'phone' => '01092199386',
            'email' => 'bhhath@bhhath.com',
        ]);
    }
}
