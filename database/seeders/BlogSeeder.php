<?php

namespace Database\Seeders;

use App\Models\Blog;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Blog::factory()->count(50)->create();

        $blogs = Blog::where('id', '>', 10)->select('id', 'blog_id')->get();

        foreach($blogs as $blog)
        {
            $blog->update([
                'blog_id' => rand(1, 50),
            ]);
            
        }
        
    }
}
