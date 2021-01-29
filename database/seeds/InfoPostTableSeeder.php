<?php

use Illuminate\Database\Seeder;

use App\Post;

use App\InfoPost;

use Faker\Generator as Faker;

class InfoPostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker) 
    {
        $posts = Post::all();

        foreach($posts as $post) {
            $newInfo = new InfoPost();
            // Relazione FK PK
            $newInfo->post_id = $post->id;
            $newInfo->status = $faker->randomElement(['open', 'private']);

            $newInfo->save();
        }
    }
}
