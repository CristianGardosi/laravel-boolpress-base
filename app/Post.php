<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Post extends Model
{
    protected $fillable = [
        'title',
        'body',
        'path_img',
        'slug'
    ];

    // !RELAZIONE POST-INFOPOST(1-*)
    public function infopost() {
        return $this->hasOne('App\InfoPost');
    }

    // !RELAZIONE POSTS-TAGS (*-*)
    public function tags() {
        return $this->belongsToMany('App\Tag');
    }
}
