<?php

use Faker\Generator as Faker;

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

$factory->define(App\Message::class, function (Faker $faker) {
    return [
        'uid'     => $faker->uuid,
        'sender'  => $faker->name(),
        'subject' => $faker->text,
        'content' => $faker->realText(),
        'sent_at' => $faker->dateTime,
    ];
});
