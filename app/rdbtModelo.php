<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class rdbtModelo extends Model
{
    //
    use SoftDeletes;
	protected $fillable = [
		'rdbtnombre', 'rdbtdescripcion',
	];
	 
     public function rdbtMarca()
    {
    	//return $this->hasMany('App\rdbtSerie'); dice un modelo tiene muchas Series y hace una relacion
          return $this->belongsTo('App\rdbtMarca');
    }
    
}
