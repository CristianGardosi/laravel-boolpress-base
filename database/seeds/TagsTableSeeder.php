<?php

use Illuminate\Database\Seeder;

use App\Tag;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = ['css', 'html', 'javascript', 'php', 'laravel'];

        foreach ($tags as $tag) {
            $newTag = New Tag();
            $newTag->name = $tag;

            $newTag->save();
        }
    }
}
