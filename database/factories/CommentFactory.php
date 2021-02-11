<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Comment;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        //
        'fullname' => $faker->word,
        'body' => $faker ->paragraphs(2, true),
        'email' => $faker->email,
        'commentable_id' => 1, //$faker ->numberBetween(1, 11)
        'commentable_type' =>'App\Post'
    ];
});
