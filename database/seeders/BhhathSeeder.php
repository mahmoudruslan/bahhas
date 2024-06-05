<?php

namespace Database\Seeders;

use App\Models\Bhhath;
use Illuminate\Database\Seeder;

class BhhathSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Bhhath::create([
            'brief_ar' => 'منصة رقمية متخصصة تعمل على تعزيز البحث العلمي وتمكين الباحثين والأكاديميين والطلاب الجامعيين والمؤسسات الأكاديمية والبحثية والمشاريع متخصصة إلى جانب حلول رقمية مبتكرة',
            'brief_en' => 'A specialized digital platform that works to enhance scientific research and empower researchers, academics, university students, academic and research institutions, and specialized projects, along with innovative digital solutions.',
            'facebook_link' => 'https://www.facebook.com/?locale=ar_AR',
            'youtube_link' => 'https://www.youtube.com/',
            'X_link' => 'https://x.com/?lang=ar',
            'instagram_link' => 'https://www.instagram.com/?hl=ar',

        ]);
    }
}
