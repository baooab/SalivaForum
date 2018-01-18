<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\User::class, 10)->create();
        factory(\App\Models\Category::class, 5)->create();
        factory(\App\Models\Discussion::class, 25)->create();
        factory(\App\Models\Comment::class, 12)->create();
    }
}
