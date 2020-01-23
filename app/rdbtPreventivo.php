<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class rdbtPreventivo extends Model
{
    //
     public function rdbtEquipoMarca()
    {
    	return $this->belongsTo('App\rdbtEquipoMarca');
    }
    public function support()
    {
    	return $this->belongsTo('App\User', 'support_id');
    }
}
