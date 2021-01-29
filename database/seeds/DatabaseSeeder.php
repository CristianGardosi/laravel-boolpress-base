<?php

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
            // POST SEEDER
            PostsTableSeeder::class,
            // TAG SEEDER
            TagsTableSeeder::class,
            // INFOPOST SEEDER
            InfoPostTableSeeder::class
        ]);
    }
}
