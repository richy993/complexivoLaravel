<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class rdbt_message extends Model
{
    //
     public function user()
    {
    	return $this->belongsTo('App\User');
    }
}
