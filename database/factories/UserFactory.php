<?php

$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'username' => $faker->name,
        'avatar' => $faker->imageUrl(256, 256),
        'confirmed' => false,
        'confirmation_code' => $faker->md5,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'type' => \App\Models\User::DEFAULT,
        'remember_token' => str_random(10),
    ];
});
