<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    $topic = $faker->word;
    $slug = \Str::slug($topic);  
    return [
        //
        'topic' => $topic,
        'body' => $faker ->paragraphs(2, true),
        'slug' => $slug,
        'photo' => $faker->image('public/storage/images', 640, 480),
        'category_id' => 1 //$faker ->numberBetween(1, 11)
    ];
});
