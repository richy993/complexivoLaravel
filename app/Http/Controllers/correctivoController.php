<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\rdbtCorrectivo;
use APP\rdbtAsignacion;

class correctivoController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}
    //
	public function create(Request $request)
	{
		$rules = [
			'rdbtDetalle' => 'required|min:5|max:255',
			'rdbtRecomendacion' => 'required|min:5|max:255'
		];
		$messages = [
			'rdbtDetalle.required' => 'Olvidó ingresar un detalle',
			'rdbtDetalle.min' => 'Ingrese al menos 5 caracteres.',
			'rdbtDetalle.max' => 'Ingrese como máximo 255 caracteres.',
			'rdbtRecomendacion.required' => 'Olvidó ingresar una recomendacion.',
			'rdbtRecomendacion.min' => 'Ingrese al menos 5 caracteres.',
			'rdbtRecomendacion.max' => 'Ingrese como máximo 255 caracteres.'
		];

		$this->validate($request, $rules, $messages);
		
		$message = new rdbtCorrectivo();

		$message->rdbt_asignacion_id = $request->input('rdbt_asignacion_id');
		$message->rdbtDetalle = $request->input('rdbtDetalle');
		$message->rdbtRecomendacion = $request->input('rdbtRecomendacion');
		$message->support_id = auth()->user()->id;
		$message->save();

		return back()->with('notification', 'Su informe se ha enviado con éxito.');
	}
}
