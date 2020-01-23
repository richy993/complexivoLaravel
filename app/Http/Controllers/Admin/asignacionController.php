<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\rdbtAsignacion;
use App\rdbtEquipoMarca;
use Carbon\Carbon;
use App\User;
class asignacionController extends Controller
{
    //p
	public function __construct()
	{
		$this->middleware('auth');
	}
	public function show($id){
		$incident=rdbtAsignacion::findOrFail($id);
		//mensajes chat
		$messages=$incident->messages;
		return view('incidencia.show')->with(compact('incident','messages'));
	}
	public function indexSoporte(){
		$user=auth()->user();

		$my_incidents=rdbtAsignacion::where('support_id',$user->id)->get();
		$pending_incidents=rdbtAsignacion::where('support_id',null)->get();
		return view('Admin.asignacion.support')->with(compact('my_incidents', 'pending_incidents'));	
	}
	public function indexAdministrador(){
		$user=auth()->user();
		$users=User::where('rdbtrol','==',1)->get();
		$my_incidents=rdbtAsignacion::where('support_id',$user->id)->get();
		$pending_incidents=rdbtAsignacion::where('support_id',null)->get();
		
		$incidents_by_me=rdbtAsignacion::where('client_id',$user->id)->get();

		return view('Admin.asignacion.admin')->with(compact('incidents_by_me','my_incidents', 'pending_incidents','users'));	
	}
	public function indexCliente(){
		$user=auth()->user();

		$incidents_by_me=rdbtAsignacion::where('client_id',$user->id)->get();

		return view('Admin.asignacion.cliente')->with(compact('incidents_by_me'));	
	}


	public function index(){
		$user=auth()->user();
		$my_incidents=rdbtAsignacion::where('support_id',$user->id)->get();
		$equipos=rdbtEquipoMarca::where('client_id',$user->id)->get();
		return view('incidencia.create')->with(compact('my_incidents', 'equipos'));
	}
	public function store(Request $request)
	{
		$this->validate($request, rdbtAsignacion::$rules);

		$incident = new rdbtAsignacion();
		$incident->equipo_marca_id=$request->input('equipo');
		$incident->severity = $request->input('severity');
		$incident->title = $request->input('title');
		$incident->description = $request->input('description');
		$valFecha=Carbon::now();
		//$incident->rdbtFechaPrevencion=$valFecha->addMonths(6);

		$user = auth()->user();

		$incident->client_id = $user->id;


		$incident->save();

		return back();
	}

	// ver incidencias

	public function take(Request $request)
	{
		$user=auth()->user();
		if(!$user->is_admin)
			return back();

		$incident=new rdbtAsignacion();
		dd($incident->support_id=$request->input('user_id'));
		$incident->save();

		return back()->with('notification','marcas registrado exitosamente');
	}
	public function solve($id)
	{
		$incident=rdbtAsignacion::findOrFail($id);

		if($incident->client_id != auth()->user()->id)
			return back();

		$incident->active = 0 ;
		$incident->save();

		return back();
	}
	public function open($id)
	{
		$incident=rdbtAsignacion::findOrFail($id);
		if($incident->client_id != auth()->user()->id)
			return back();

		$incident->active = 1 ;
		$incident->save();

		return back();
	}
	public function edit($id)
	{
		$user=auth()->user();
		$incident=rdbtAsignacion::findOrFail($id);
		$equipos=rdbtEquipoMarca::where('client_id',$user->id)->get();
		return view('incidencia.edit')->with(compact('incident','equipos'));
	}
	public function update(Request $request,$id)
	{
		$this->validate($request, rdbtAsignacion::$rules);

		$incident =rdbtAsignacion::findOrFail($id);
		$incident->equipo_marca_id=$request->input('equipo');
		$incident->severity = $request->input('severity');
		$incident->title = $request->input('title');
		$incident->description = $request->input('description');

		$incident->save();

		return redirect("/ver/$id");
	}
	
}
