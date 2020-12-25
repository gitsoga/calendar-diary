<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Diary;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Diary::class, function (Faker $faker) {
    return [
        'user_id' => $faker->randomDigitNotNull(),
        'date' => $faker->date(),
        'diary' => $faker->realText(),
    ];
});
