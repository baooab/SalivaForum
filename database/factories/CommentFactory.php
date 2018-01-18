<?php

$factory->define(\App\Models\Comment::class, function (Faker\Generator $faker) {
    $userIds = App\Models\User::pluck('id')->toArray();
    $discussionIds = App\Discussion::pluck('id')->toArray();

    return [
        'body' => $faker->paragraph,
        'user_id' => $faker->randomElement($userIds),
        'discussion_id' => $faker->randomElement($discussionIds),
    ];
});
