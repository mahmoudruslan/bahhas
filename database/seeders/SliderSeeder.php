<?php

namespace Database\Seeders;

use App\Models\Slider;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Slider::create([
            'title_ar' => 'منصة رقمية متخصصة',
            'title_en' => 'A specialized digital platform',
            'details_ar' => 'لتقديم خدمات بحثية وتعليمية ........',
            'details_en' => 'To provide research and educational services....',
            'cover' => 'images/sliders/slide.jpg',
            'status' => true,
            'url' => 'https://bhhath.com/',
        ]);

    }
}
