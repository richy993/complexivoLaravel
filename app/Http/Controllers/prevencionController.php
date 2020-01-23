<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\rdbtEquipoMarca;
use App\User;
use App\rdbtPreventivo;
use App\rdbtAsignacion;


use Carbon\Carbon; 

class prevencionController extends Controller
{
    //
	public function __construct()
	{
		$this->middleware('auth');
	}
	public function index()
	{
		$users=auth()->user();
		$equipos_marcas=rdbtEquipoMarca::where('client_id',$users->id)->get();


		return view('Admin.preventivo.clientePreventivo')->with(compact('equipos_marcas'));
	}

	public function indexSoporte(){
		$user=auth()->user();

		$my_incidents=rdbtEquipoMarca::where('support_id',$user->id)->get();
		return view('Admin.preventivo-Soporte.SoportePreventivo')->with(compact('my_incidents',));	
	}

	public function indexAdmin(){

		$user=auth()->user(); 
		$my_incidents=rdbtEquipoMarca::where('support_id','!=',null)->get();
		$pending_incidents=rdbtEquipoMarca::where('support_id',null)->get();

		$soporte=User::where('rdbtrol',1)->get();
		return view('Admin.preventivo-Admin.AdminPreventivo')->with(compact('my_incidents', 'pending_incidents','soporte'));	
	}

	public function show($id){
		$user=auth()->user();
		$inc=rdbtEquipoMarca::findOrFail($id);
		if($user->id==$inc->client_id){
		$incident=rdbtEquipoMarca::findOrFail($id);//obtener el numero de dias que falta para el mantenimiento
		$valFecha=$incident->created_at;
		$valFecha2=$incident->rdbtFechaPrevencion;
		$hi=Carbon::parse($valFecha);
		$hi2=Carbon::parse($valFecha2);


		$hello=$hi2->diffInDays($hi);  
		                 //mensajes chat
		$messages=$incident->messages;
		return view('Admin.preventivo.show')->with(compact('incident','messages','hello','hi','hi2'));
	}
	return redirect("/home");

}

	//sacaremos el valor equipo marca


public function showSoporte($id){
	$user=auth()->user();
	$inc=rdbtEquipoMarca::findOrFail($id);

	if($user->id==$inc->support_id){
		$incident=rdbtEquipoMarca::findOrFail($id);
		$valFecha=$incident->created_at;
		$valFecha2=$incident->rdbtFechaPrevencion;
		$hi=Carbon::parse($valFecha);
		$hi2=Carbon::parse($valFecha2);
		$hello=$hi2->diffInDays($hi);                   

		//mensajes chat
		$messages=$incident->messages;
		return view('Admin.preventivo.show')->with(compact('incident','messages','hello','hi','hi2'));
	}


	return redirect("/home");
}
public function showAdmin($id){
	$incident=rdbtEquipoMarca::findOrFail($id);
	$valFecha=$incident->created_at;
	$valFecha2=$incident->rdbtFechaPrevencion;
	$hi=Carbon::parse($valFecha);
	$hi2=Carbon::parse($valFecha2);


	$hello=$hi2->diffInDays($hi);                   
	$soporte=User::where('rdbtrol',1)->get();
		//mensajes chat
	$messages=$incident->messages;
	return view('Admin.preventivo.show')->with(compact('incident','messages','hello','soporte','hi','hi2'));
}


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


	

	$message = new rdbtPreventivo(); 
	$message->equipo_marca_id = $request->input('equipo_marca_id');
	$message->rdbtDetalle = $request->input('rdbtDetalle');
	$message->rdbtRecomendacion = $request->input('rdbtRecomendacion');
	$message->support_id = auth()->user()->id;
	$message->save();
	return back()->with('notification', 'Su informe se ha enviado con éxito.');
}
}
