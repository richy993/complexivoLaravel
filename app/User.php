<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    use SoftDeletes;
    protected $fillable = [
        'rdbtnombre','rdbtapellido','rdbtcedula','rdbttelefono','rdbtdirreccion','rdbtrol','email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function rdbtPrevencion()
    {
      //return $this->hasMany('App\rdbtSerie'); dice un modelo tiene muchas Series y hace una relacion
      return $this->hasMany('App\rdbtPreventivo');
  }
public function rdbtCorrectivo()
    {
      //return $this->hasMany('App\rdbtSerie'); dice un modelo tiene muchas Series y hace una relacion
      return $this->hasMany('App\rdbtCorrectivo');
  }

  public function getAvatarPathAttribute()
  {
    if ($this->is_client)
        return '/img/anadir.png';

    return '/img/soporte.png';
}

//relations
public function Equipo_Marca()
{
    return $this->hasMany(rdbtEquipoMarca::class);
}

// rol del usuario
public function getIsAdminAttribute(){
    return $this->rdbtrol==0;
}
public function getIsSupportAttribute()
{
    return $this->rdbtrol == 1;
}
public function getIsClientAttribute(){
 return $this->rdbtrol==2;
}


}
