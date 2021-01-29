<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = [
        'name',
        
    ];

     // !RELAZIONE POSTS-TAGS (*-*)
     public function posts() {
        return $this->belongsToMany('App\Post');
    }
}
