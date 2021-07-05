<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            AdminSeeder::class,
            CreatorSeeder::class
        ]);
        \App\Models\Admin::factory(4)->create();
        \App\Models\Creator::factory(10)->create();
        \App\Models\Post::factory(15)->create();
    }
}
