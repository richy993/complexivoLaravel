<?php

namespace App;      

use Illuminate\Database\Eloquent\Model;

class rdbtAsignacion extends Model
{
  public static $rules = [
    'category_id' => 'sometimes|exists:categories,id',
    'severity' => 'required|in:M,N,A',
    'title' => 'required|min:5',
    'description' => 'required|min:15',
    
];

public static $messages = [
    'category_id.exists' => 'La categoría seleccionada no existe en nuestra base de datos.',
    'title.required' => 'Es necesario ingresar un título para la incidencia.',
    'title.min' => 'El título debe presentar al menos 5 caracteres.',
    'description.required' => 'Es necesario ingresar una descripción para la incidencia.',
    'description.min' => 'La descripción debe presentar al menos 15 caracteres.'
];

protected $appends = ['state'];

    // relationships


public function support()
{
    return $this->belongsTo('App\User', 'support_id');
}

public function client()
{
    return $this->belongsTo('App\User', 'client_id');
}



    // accessors

public function getSeverityFullAttribute()
{
   switch ($this->severity) {
      case 'M':
      return 'Menor';

      case 'N':
      return 'Normal';
      
      default:
      return 'Alta';
  }
}




public function getTitleShortAttribute()
{
   return mb_strimwidth($this->title, 0, 20, '...');
}
public function getTitleLongAttribute()
{
   return mb_strimwidth($this->title, 0, 60, '...');
}

    // category_name

//aqui se pondra en la vista show poder ver si esta asignado o no
    // support_name
public function getSupportNameAttribute()
{
    if ($this->support)
        return $this->support->rdbtnombre." ".$this->support->rdbtapellido;

    return 'Sin asignar';
}

public function getStateAttribute()
{
    if ($this->active == 0)
        return 'Resuelto';

    if ($this->support_id)
        return 'Asignado';

    return 'Pendiente';
}

public function rdbtEquipoMarca()
{
        //return $this->hasMany('App\rdbtSerie'); dice un modelo tiene muchas Series y hace una relacion
  return $this->belongsTo('App\rdbtEquipoMarca','equipo_marca_id');
}


public function messages()
{
    return $this->hasMany('App\rdbt_message');
}
public function rdbtCorrectivo()
{
    return $this->hasMany('App\rdbtCorrectivo');
}

}
