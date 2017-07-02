<?php

$factory->define(\App\Models\Category::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->text(15),
        'slug' => $faker->slug,
    ];
});