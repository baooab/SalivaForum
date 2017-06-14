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

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'avatar' => $faker->imageUrl(256, 256),
        'confirm_code' => str_random(48),
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Discussion::class, function (Faker\Generator $faker) {
    $ids = App\User::pluck('id')->toArray();

    return [
        'title' => $faker->sentence,
        'body' => $faker->paragraph,
        'user_id' => $faker->randomElement($ids),
        'last_user_id' => $faker->randomElement($ids),
    ];
});

$factory->define(App\Comment::class, function (Faker\Generator $faker) {
    $userIds = App\User::pluck('id')->toArray();
    $discussionIds = App\Discussion::pluck('id')->toArray();

    return [
        'body' => $faker->paragraph,
        'user_id' => $faker->randomElement($userIds),
        'discussion_id' => $faker->randomElement($discussionIds),
    ];
});