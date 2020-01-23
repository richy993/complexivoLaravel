<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\rdbtEquipo;


class equipoController extends Controller
{
	public function index()
	{		
		//vamos a mostrar los que estan eliminados igual
		$equipos=rdbtEquipo::withTrashed()->get();

		//mostrara todos los equipos el all()

		
	//	$marcas=rdbtMarca::all();
	//	$equipos_marcas=rdbtEquipoMarca::all();

		//$equipos=equipo::where('role',1)->get();
		return view('Admin.equipos.btrd_index')->with(compact('equipos'));
	}
    //store es el guardar nuevo registro
	public function store(Request $request)
	{
		$rules=[
			'rdbtnombre' => 'required|string|max:255|unique:rdbt_equipos',
			'rdbtdescripcion' => 'required|string|max:255',
		];
		$messages=[
			'rdbtnombre.required'=>'Es necesario ingresar el nombre del equipo',
			'rdbtnombre.max'=>'el nombre es demasiado extenso',
			'rdbtnombre.unique'=>'el nombre ya esta registrado',
			'rdbtdescripcion.required'=>'Es necesario ingresar la descripcion del usuario',
			'rdbtdescripcion.max'=>'la descripcion es demasiado extenso',			
		];
		$this->validate($request,$rules,$messages);
		$equipos=new rdbtEquipo();
		
		$equipos->rdbtnombre=trim($request->input('rdbtnombre'));
		$equipos->rdbtdescripcion=trim($request->input('rdbtdescripcion'));
		$equipos->save();
		
		//dd($request->all());
		return back()->with('notification','Equipo registrado exitosamente');
	}
	
	public function update(Request $request,$id)
	{
		$rules=[
			'rdbtnombre' => 'required|string|max:255',
			'rdbtdescripcion' => 'required|string|max:255',
		];
		$messages=[
			'rdbtnombre.required'=>'Es necesario ingresar el nombre del usuario',
			'rdbtnombre.max'=>'el nombre es demasiado extenso',
			'rdbtdescripcion.required'=>'Es necesario ingresar la descripcion del usuario',
			'rdbtdescripcion.max'=>'la descripcion es demasiado extenso',			
		];
		$this->validate($request,$rules,$messages);

		$equipos=rdbtEquipo::find($id);
		
		$equipos->rdbtnombre=trim($request->input('rdbtnombre'));
		$equipos->rdbtdescripcion=trim($request->input('rdbtdescripcion'));
		$equipos->save();
		
		return back()->with('notification','Equipo actualizado exitosamente');
	}
	public function delete($id)
	{
		$equipo=rdbtEquipo::find($id);
		$equipo->delete();

		return back()->with('notification','el equipo se ah eliminado correctamente');
	}
	public function restore($id)
	{
		rdbtEquipo::withTrashed()->find($id)->restore();
		return back()->with('notification', 'El equipo se ha habilitado correctamente.');
	}

	
}