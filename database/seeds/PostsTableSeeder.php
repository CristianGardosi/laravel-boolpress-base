<?php

use Illuminate\Database\Seeder;

use App\Post;

use Faker\Generator as Faker;

use Illuminate\Support\Str;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {

        for ($i = 0; $i < 30; $i++ ) {
            // Salvo title in una variabile per riutilizzarlo nello slug altrimente ne produrrebbe uno casuale ogni volta
            $title = $faker->text(40);

            $newPost = new Post();

            $newPost->title = $title;
            $newPost->body = $faker->paragraph(5, true);
            $newPost->slug = Str::slug($title, '-');
            $newPost->path_img = $faker->imageUrl(150, 150, 'animals', true);

            $newPost->save();

        }
    }
}

