<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\rdbtAsignacion;
use App\rdbtEquipoMarca;
use App\rdbtCorrectivo;
use Carbon\Carbon;
use App\User;
use model;

class asignacionController extends Controller 
{
	
    //p
	public function __construct()
	{
		$this->middleware('auth');
	}	

	public function indexSoporte(){
		$user=auth()->user();

		$my_incidents=rdbtAsignacion::where('support_id',$user->id)->get();
		$pending_incidents=rdbtAsignacion::where('support_id',null)->get();
		
		

		return view('Admin.asignacion.support')->with(compact('my_incidents', 'pending_incidents'));	
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
		$rules = [
    'category_id' => 'sometimes|exists:categories,id',
    'severity' => 'required|in:M,N,A',
    'title' => 'required|min:5',
    'description' => 'required|min:15',
    
];

$messages = [
    'category_id.exists' => 'La categoría seleccionada no existe en nuestra base de datos.',
    'title.required' => 'Es necesario ingresar un título para la incidencia.',
    'title.min' => 'El título debe presentar al menos 5 caracteres.',
    'description.required' => 'Es necesario ingresar una descripción para la incidencia.',
    'description.min' => 'La descripción debe presentar al menos 15 caracteres.'
];

		$this->validate($request,$rules,$messages);

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
		$rules = [
    'category_id' => 'sometimes|exists:categories,id',
    'severity' => 'required|in:M,N,A',
    'title' => 'required|min:5',
    'description' => 'required|min:15',
    
];

$messages = [
    'category_id.exists' => 'La categoría seleccionada no existe en nuestra base de datos.',
    'title.required' => 'Es necesario ingresar un título para la incidencia.',
    'title.min' => 'El título debe presentar al menos 5 caracteres.',
    'description.required' => 'Es necesario ingresar una descripción para la incidencia.',
    'description.min' => 'La descripción debe presentar al menos 15 caracteres.'
];

		$this->validate($request,$rules,$messages);

		$incident =rdbtAsignacion::findOrFail($id);
		$incident->equipo_marca_id=$request->input('equipo');
		$incident->severity = $request->input('severity');
		$incident->title = $request->input('title');
		$incident->description = $request->input('description');

		$incident->save();

		return redirect("/ver/$id");
	}


	public function report($id){
		$user=auth()->user();
		$inc=rdbtAsignacion::findOrFail($id);

		if($user->id==$inc->client_id || $user->id==$inc->support_id){
			
		$incident=rdbtAsignacion::findOrFail($id);//mensajes chat
		$informe=rdbtCorrectivo::where('rdbt_asignacion_id',$incident->id)->first();
		$messages=$incident->messages;
			$valFecha=Carbon::now();
		$view=view('reporte.reporteIncidenciaSoporte')->with(compact('incident','messages','informe','valFecha'));
		$pdf=\App::make('dompdf.wrapper');
		$pdf->loadhtml($view);
		return $pdf->stream();
	}
	return redirect("/home");
}


}
