<?php

use Illuminate\Database\Seeder;
use App\Category;
class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $categories = factory(Category::class, 5)->create();
        $categories->each(function($category){
            factory(\App\Post::class, 3)->create([
                'category_id' => $category->id,
            ]);
        });
    }
}
