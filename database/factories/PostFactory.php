<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\post;
use Faker\Generator as Faker;

$factory->define(post::class, function (Faker $faker) {
    return [
		'user_id' => $faker->randomDigit,
        'email' => $faker->unique()->safeEmail,
		'name' => $faker->name,
		'description' => $faker->text,
		'created_at' => now(),
		'updated_at' => now()
    ];
});
