<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// !TABELLA PIVOT POSTS-TAGS (*-*)

class CreatePostTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_tag', function (Blueprint $table) {
            // Struttura tabella, voglio una colonna id e le due colonne per gli id di posts e gli id di tags
            $table->id();
            // FK 1 (posts)
            $table->unsignedBigInteger('post_id');
            // FK 2 (tags)
            $table->unsignedBigInteger('tag_id');

            // RELAZIONI TRA POSTS E TAGS GRAZIE ALLA TABELLA PIVOT
            $table->foreign('post_id')
            ->references('id')
            ->on('posts')
            ->onDelete('cascade');

            $table->foreign('tag_id')
            ->references('id')
            ->on('tags')
            ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_tag');
    }
}
