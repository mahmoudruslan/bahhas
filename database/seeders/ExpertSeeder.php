<?php

namespace Database\Seeders;

use App\Models\Expert;
use Illuminate\Database\Seeder;

class ExpertSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Expert::create([
            'full_name' => 'محمد الغامدى',
            'specialization' => 'رياضيات',
            'degree' => 'دكتوراة',
            'university' => 'جامعة الباحة',
            'country_id' => rand(1, 10),
            'city_id' => rand(1, 10),
            'text_introduction' => 'التعليم الأكاديمي:
            دكتوراه في المناهج وطرق تدريس الرياضيات - جامعة الإمام محمد بن سعود الإسلامية
            ماجستير في المناهج وطرق تدريس الرياضيات - جامعة الإمام محمد بن سعود الإسلامية
            بكالوريوس في الرياضيات - جامعة الباحة
            الخبرات الأكاديمية:
            معلم رياضيات في التعليم العام - وزارة التعليم
            محكم للبحوث العلمية بمراكز متعددة
            الإنجازات والمؤلفات:
            عدة أبحاث منشورة في مجلات بالجامعات السعودية
            المشاركة بعرض عدة أوراق علمية بمؤتمرات علمية
            ',
            'phone' => '01092199386',
            'email' => 'mohamed@gmail.com',
            'international_bank_number' => '12456',
            'IBAN_certificate' => 'images/experts/cert.pdf',
            'the_biography' => 'images/experts/cv.pdf',
            'show_information' => true,
            'publish_achievements' => false,
            'gender' => 1,
            'status' => false,
            // 'image' => 'expert.jpg'
        ]);

        Expert::create([
            'full_name' => 'زكريا الدخيل',
            'specialization' => 'لغة انجليزية',
            'degree' => 'دكتوراة',
            'university' => 'جامعة القصيم',
            'country_id' => rand(1, 10),
            'city_id' => rand(1, 10),
            'text_introduction' => 'التعليم الأكاديمي:
            دكتوراه في المناهج وطرق تدريس الانجليزية - جامعة الإمام محمد بن سعود الإسلامية
            ماجستير في المناهج وطرق تدريس الانجليزية - جامعة الإمام محمد بن سعود الإسلامية
            بكالوريوس في الانجليزية - جامعة القصيم
            الخبرات الأكاديمية:
            معلم انجليزى في التعليم العام - وزارة التعليم
            محكم للبحوث العلمية بمراكز متعددة
            الإنجازات والمؤلفات:
            عدة أبحاث منشورة في مجلات بالجامعات السعودية
            المشاركة بعرض عدة أوراق علمية بمؤتمرات علمية
            ',
            'phone' => '01092199386',
            'email' => 'zakaria@gmail.com',
            'international_bank_number' => '12458',
            'IBAN_certificate' => 'images/experts/cert.pdf',
            'the_biography' => 'images/experts/cv.pdf',
            'show_information' => true,
            'publish_achievements' => false,
            'gender' => 1,            
            'status' => false,
            // 'image' => 'expert.jpg'
        ]);
    
    }
}
