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
            'title_ar' => '11منصة رقمية متخصصة',
            'title_en' => 'A specialized digital platform11',
            'details_ar' => 'لتقديم خدمات بحثية وتعليمية ........',
            'details_en' => 'To provide research and educational services....',
            'cover' => 'images/sliders/slide.jpg',
            'status' => true,
            'url' => 'https://bhhath.com/',
        ]);
        Slider::create([
            'title_ar' => '22منصة رقمية متخصصة',
            'title_en' => 'A specialized digital platform22',
            'details_ar' => 'لتقديم خدمات بحثية وتعليمية ........',
            'details_en' => 'To provide research and educational services....',
            'cover' => 'images/sliders/slide.jpg',
            'status' => true,
            'url' => 'https://bhhath.com/',
        ]);
        Slider::create([
            'title_ar' => '33منصة رقمية متخصصة',
            'title_en' => 'A specialized digital platform33',
            'details_ar' => 'لتقديم خدمات بحثية وتعليمية ........',
            'details_en' => 'To provide research and educational services....',
            'cover' => 'images/sliders/slide.jpg',
            'status' => true,
            'url' => 'https://bhhath.com/',
        ]);
        Slider::create([
            'title_ar' => '44منصة رقمية متخصصة',
            'title_en' => 'A specialized digital platform44',
            'details_ar' => 'لتقديم خدمات بحثية وتعليمية ........',
            'details_en' => 'To provide research and educational services....',
            'cover' => 'images/sliders/slide.jpg',
            'status' => true,
            'url' => 'https://bhhath.com/',
        ]);
        Slider::create([
            'title_ar' => '55منصة رقمية متخصصة',
            'title_en' => 'A specialized digital platform55',
            'details_ar' => 'لتقديم خدمات بحثية وتعليمية ........',
            'details_en' => 'To provide research and educational services....',
            'cover' => 'images/sliders/slide.jpg',
            'status' => true,
            'url' => 'https://bhhath.com/',
        ]);

    }
}
