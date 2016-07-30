<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Admin\Message::class, function (Faker\Generator $faker) {
    return [
    	'id' => $faker->unique()->numberBetween(1,100),
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'phone' => $faker->e164PhoneNumber,
        'message' => $faker->realText(1000,2),
        'ip' => $faker->ipv4,
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,
        'status_id' => $faker->numberBetween(1,3),
        'subject' => $faker->realText(200,2),
    ];
});
