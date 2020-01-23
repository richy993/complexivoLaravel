<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\rdbtModelo;
use App\rdbtMarca;
class modeloController extends Controller
{

	public function byMarca($id){
		return rdbtmodelo::where('rdbt_marca_id',$id)->get();
	}
public function byMarca1($id){
		return rdbtmodelo::where('rdbt_marca_id',$id)->get();
	}
	public function index()
	{		
		//vamos a mostrar los que estan eliminados igual
		$modelos=rdbtmodelo::withTrashed()->get();

		//mostrara todos los modelos el all()
		//$modelos=rdbtmodelo::all();
		$marcas=rdbtMarca::all();
		//$modelos=modelo::where('role',1)->get();
		return view('Admin.modelos.btrd_index')->with(compact('modelos','marcas'));
	}
    //store es el guardar nuevo registro
	public function store(Request $request)
	{
		$rules=[
			'rdbtnombre' => 'required|string|max:255|unique:rdbt_modelos',
			'rdbtdescripcion' => 'required|string|max:255',
		];
		$messages=[
			'rdbtnombre.required'=>'Es necesario ingresar el nombre del modelo',
			'rdbtnombre.max'=>'el nombre es demasiado extenso',
			'rdbtnombre.unique'=>'el modelo ya esta registrado',
			'rdbtdescripcion.required'=>'Es necesario ingresar la descripcion del usuario',
			'rdbtdescripcion.max'=>'la descripcion es demasiado extenso',			
		];
		$this->validate($request,$rules,$messages);
		$modelo=new rdbtmodelo();
		$modelo->rdbt_marca_id=trim($request->input('rdbt_marca_id'));
		$modelo->rdbtnombre=trim($request->input('rdbtnombre'));
		$modelo->rdbtdescripcion=trim($request->input('rdbtdescripcion'));
		$modelo->save();
		//dd($request->all());
		return back()->with('notification','modelo registrado exitosamente');
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
		$modelo=rdbtmodelo::find($id);
		$modelo->rdbt_marca_id=trim($request->input('rdbt_marca_id'));
		$modelo->rdbtnombre=trim($request->input('rdbtnombre'));
		$modelo->rdbtdescripcion=trim($request->input('rdbtdescripcion'));
		$modelo->save();
	//	$modelo->update($request->all());
		
		return back()->with('notification','modelo actualizado exitosamente');
	}
	public function delete($id)
	{
		$modelo=rdbtmodelo::find($id);
		$modelo->delete();

		return back()->with('notification','el modelo se ah eliminado correctamente');
	}
	public function restore($id)
	{
		rdbtmodelo::withTrashed()->find($id)->restore();
		return back()->with('notification', 'El modelo se ha habilitado correctamente.');
	}

	
}