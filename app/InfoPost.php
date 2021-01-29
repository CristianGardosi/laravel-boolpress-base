<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InfoPost extends Model
{
      // !RELAZIONE POST-INFOPOST(1-*)
      public function post() {
        return $this->belongsTo('App\Post');
    }
}
