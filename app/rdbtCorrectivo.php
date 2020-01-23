<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class rdbtCorrectivo extends Model
{
    //
	public function rdbtAsignacion()
	{
		return $this->belongsTo('App\rdbtAsignacion');
	}
	public function support()
	{
		return $this->belongsTo('App\User', 'support_id');
	}
}
