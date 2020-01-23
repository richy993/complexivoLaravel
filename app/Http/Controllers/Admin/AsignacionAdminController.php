<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\rdbtAsignacion;
use App\rdbtEquipoMarca;
use Carbon\Carbon;
class AsignacionAdminController extends Controller
{
    //
	public function indexAdministrador(){
		$user=auth()->user();
		$users=User::where('rdbtrol',1)->get();
		$my_incidents=rdbtAsignacion::where('support_id','!=',null)->where('active','!=',0)->get();
			$my_results=rdbtAsignacion::where('active',0)->get();
		$pending_incidents=rdbtAsignacion::where('support_id',null)->get();

		$incidents_by_me=rdbtAsignacion::where('client_id',$user->id)->get();

		return view('Admin.asignacion.admin')->with(compact('incidents_by_me','my_incidents', 'pending_incidents','users','my_results'));	
	}
	public function take(Request $request,$id)
	{
		$user=auth()->user();
		if(!$user->is_admin)
			return back();

		$incident =rdbtAsignacion::findOrFail($id);

		$incident->support_id=$request->input('user_id');
		$incident->save();

		return back()->with('notification','marcas registrado exitosamente');
	}
	public function show($id){
		$incident=rdbtAsignacion::findOrFail($id);
		//mensajes chat
		$messages=$incident->messages;
		return view('incidencia.show')->with(compact('incident','messages'));
	}
	public function edit($id)
	{
		$users=User::where('rdbtrol',1)->get();

		$user=auth()->user();
		$incident=rdbtAsignacion::findOrFail($id);
		$equipos=rdbtEquipoMarca::where('client_id',$incident->client_id)->get();
		return view('incidencia.edit')->with(compact('incident','equipos','users'));
	}
	public function update(Request $request,$id)
	{
		$this->validate($request, rdbtAsignacion::$rules);

		$incident =rdbtAsignacion::findOrFail($id);
		$incident->support_id=$request->input('user_id');
		

		$incident->save();

		return redirect("/AsAdministrador");
	}


	public function report(){
		$user=auth()->user();
		$users=User::where('rdbtrol',1)->get();
		$my_incidents=rdbtAsignacion::where('support_id','!=',null)->where('active','!=',0)->get();
		$my_results=rdbtAsignacion::where('active',0)->get();
		$pending_incidents=rdbtAsignacion::where('support_id',null)->get();
		$contar=count($my_results);
		$contar1=count($my_incidents);
		$contar2=count($pending_incidents);
		
		$incidents_by_me=rdbtAsignacion::where('client_id',$user->id)->get();
		$valFecha=Carbon::now();
		$view= view('reporte.reporte')->with(compact('incidents_by_me','my_incidents', 'pending_incidents','my_results','users','valFecha','contar','contar1','contar2'));	
		$pdf=\App::make('dompdf.wrapper');
		$pdf->loadhtml($view);
		return $pdf->stream();
	}
	
}
