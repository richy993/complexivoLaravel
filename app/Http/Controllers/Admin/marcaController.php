<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\rdbtMarca;
use App\rdbtEquipo;
class marcaController extends Controller
{

public function index()
	{		
		//vamos a mostrar los que estan eliminados igual
		$marcas=rdbtmarca::withTrashed()->get();

		//mostrara todos los marcas el all()
		//$marcas=rdbtmodelo::all();
	//	$equipos=rdbtEquipo::all();
		//$marcas=marcas::where('role',1)->get();
		return view('Admin.marcas.btrd_index')->with(compact('marcas'));
	}
    //store es el guardar nuevo registro
	public function store(Request $request)
	{
		$rules=[
			'rdbtnombre' => 'required|string|max:255|unique:rdbt_marcas',
			'rdbtdescripcion' => 'required|string|max:255',
		];
		$messages=[
			'rdbtnombre.required'=>'Es necesario ingresar el nombre del marcas',
			'rdbtnombre.max'=>'el nombre es demasiado extenso',
			'rdbtnombre.unique'=>'la marca ya esta registrada',
			'rdbtdescripcion.required'=>'Es necesario ingresar la descripcion del usuario',
			'rdbtdescripcion.max'=>'la descripcion es demasiado extenso',			
		];
		$this->validate($request,$rules,$messages);
		$marcas=new rdbtmarca();
		//$marcas->rdbt_equipo_id=trim($request->input('rdbt_equipo_id'));
		$marcas->rdbtnombre=trim($request->input('rdbtnombre'));
		$marcas->rdbtdescripcion=trim($request->input('rdbtdescripcion'));
		$marcas->save();
		//dd($request->all());
		return back()->with('notification','marcas registrado exitosamente');
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
		$marcas=rdbtmarca::find($id);
		//$marcas->rdbt_equipo_id=trim($request->input('rdbt_equipo_id'));
		$marcas->rdbtnombre=trim($request->input('rdbtnombre'));
		$marcas->rdbtdescripcion=trim($request->input('rdbtdescripcion'));
		$marcas->save();
	//	$marcas->update($request->all());
		
		return back()->with('notification','marca actualizado exitosamente');
	}
	public function delete($id)
	{
		$marcas=rdbtmarca::find($id);
		$marcas->delete();

		return back()->with('notification','la marca se ah eliminado correctamente');
	}
	public function restore($id)
	{
		rdbtmarca::withTrashed()->find($id)->restore();
		return back()->with('notification', 'La marca se ha habilitado correctamente.');
	}

	
}