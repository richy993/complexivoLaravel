<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class rdbtEquipoMarca extends Model
{
    //
  protected $table='rdbt_Equipo_Marca';

  use SoftDeletes;

public function rdbtAsignacion()
    {
      //return $this->hasMany('App\rdbtSerie'); dice un modelo tiene muchas Series y hace una relacion
          return $this->hasMany('App\rdbtAsignacion');
    }
 
 public function rdbtEquipo(){
   return $this->belongsTo('App\rdbtEquipo','rdbt_equipo_id','id');
 }
 public function rdbtMarca(){
   return $this->belongsTo('App\rdbtMarca','rdbt_marca_id','id');
 }
 public function rdbtModelo(){
   return $this->belongsTo('App\rdbtModelo','rdbt_modelo_id','id');
 }

 public function getSupportNameAttribute()
    {
        if ($this->support)
            return $this->support->rdbtnombre." ".$this->support->rdbtapellido;

        return 'Sin asignar';
    }
     public function support()
    {
        return $this->belongsTo('App\User', 'support_id');
    }
 
    public function client()
    {
        return $this->belongsTo('App\User','client_id');
    }

public function rdbtPreventivo()
    {
      //return $this->hasMany('App\rdbtSerie'); dice un modelo tiene muchas Series y hace una relacion
          return $this->hasMany('App\rdbtPreventivo');
    }

}
