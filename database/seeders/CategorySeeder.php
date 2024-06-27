<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'name_ar' => 'الاستشارات العلمية',
            'name_en' => 'bahhas services',
            'cover' => 'images/categories/category.jpg',
            'type' => 'service',
        ]);
        Category::create([
            'name_ar' => 'النقد الاكاديمى',
            'name_en' => 'bahhas services',
            'cover' => 'images/categories/category.jpg',
            'type' => 'service',
        ]);
        Category::create([
            'name_ar' => 'التحليل الإحصائى',
            'name_en' => 'bahhas services',
            'cover' => 'images/categories/category.jpg',
            'type' => 'service',
        ]);

        Category::create([
            'name_ar' => 'كتب ومراجعة',
            'name_en' => 'bahhas store',
            'cover' => 'images/categories/category.jpg',
            'type' => 'product',
        ]);
        Category::create([
            'name_ar' => 'لقاءات علمية مباشرة',
            'name_en' => 'bahhas store',
            'cover' => 'images/categories/category.jpg',
            'type' => 'product',
        ]);

        Category::create([
            'name_ar' => 'الخبراء والمستشارون',
            'name_en' => 'bahhas advisor',
            'cover' => 'images/categories/category.jpg',
            'type' => 'advisor',
        ]);
        Category::create([
            'name_ar' => 'الخبيرات والمستشارات',
            'name_en' => 'bahhas advisor',
            'cover' => 'images/categories/category.jpg',
            'type' => 'advisor',
        ]);

    }
}
