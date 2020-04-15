<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\CommandError;
use Faker\Generator as Faker;

$factory->define(CommandError::class, function (Faker $faker) {
    return [
        'command' => $faker->slug(6, true),
        'error_id' => $faker->swiftBicNumber,
        'created_at' => $faker->dateTimeBetween('-20 years'),
        'updated_at' => function($reg) {
            return \Illuminate\Support\Carbon::parse($reg['created_at'])->addDays(random_int(0, 30));
        },
    ];
});
