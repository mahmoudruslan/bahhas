<?php

namespace Database\Seeders;

use App\Models\ParentCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ParentCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ParentCategory::create([
            'name_ar' => 'خدمات بحاث',
            'name_en' => 'bahhas services',
            'cover' => 'images/parent-categories/cover.jpg',
            'type' => 'service',
        ]);

        ParentCategory::create([
            'name_ar' => 'متجر بحاث',
            'name_en' => 'bahhas store',
            'cover' => 'images/parent-categories/cover.jpg',
            'type' => 'products',
        ]);

        ParentCategory::create([
            'name_ar' => 'خبراء بحاث',
            'name_en' => 'bahhas advisor',
            'cover' => 'images/parent-categories/cover.jpg',
            'type' => 'service',
        ]);
    }
}
