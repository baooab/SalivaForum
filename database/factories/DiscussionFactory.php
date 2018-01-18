<?php

$factory->define(\App\Models\Discussion::class, function (Faker\Generator $faker) {
    $user = factory(\App\Models\User::class)->create();
    $userIds = App\Models\User::pluck('id')->toArray();

    return [
        'title' => $faker->text(20),
        'slug' => $faker->slug,
        'body' => $faker->text,
        'user_id' => $user->id,
        'last_user_id' => $faker->randomElement($userIds),
    ];
});