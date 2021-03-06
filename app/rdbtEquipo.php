<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class rdbtEquipo extends Model
{
    //
      use SoftDeletes;
     protected $fillable = [
        'rdbtnombre','rdbtdescripcion',
    ];

    //marca
   public function rdbtMarcas()
    {
    	//return $this->hasMany('App\rdbtModelo'); dice una marca tiene muchas Modelos y hace una relacion
            return $this->hasMany('App\rdbtMarca');
    }
     
}
