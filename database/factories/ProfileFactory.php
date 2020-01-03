<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\profile;
use Faker\Generator as Faker;

$factory->define(profile::class, function (Faker $faker) {
    return [
        'user_id' => $faker->unique()->randomDigit,
		'phone' =>$faker->unique()->phoneNumber,
		'address' =>$faker->text,
    ];
});
