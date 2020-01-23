<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\rdbtEquipoMarca;
use App\rdbtMarca;
use App\rdbtEquipo;
use App\user;
use Carbon\carbon;
use App\rdbtModelo;

class EquipoMarcaController extends Controller
{
    //
    public function index(){
        $equipos=rdbtEquipo::all();
        $marcas=rdbtMarca::all();
        $modelos=rdbtModelo::all();
        $users=user::where('rdbtrol','!=',0)->get();
        $equipos_marcas=rdbtEquipoMarca::withTrashed()->get();

        return view('Admin.Equipo-marca.btrd_index')->with(compact('marcas','equipos_marcas','equipos','users','modelos'));
    }
    public function store(Request $request){
    	//la serie pertenece a un modelo
    	//asegurar que la marca existe 
        $rules=[

            'rdbtserie' => 'unique:rdbt_equipo_marca|required|string',
        ];
        $messages=[

            'rdbtserie.unique'=>'la serie ya existe',           
        ]; 
        $this->validate($request,$rules,$messages);

        $rdbt_modelo_id=$request->input('modelo_id');
        
        $equipo_marca=rdbtEquipoMarca::where('rdbt_modelo_id',$rdbt_modelo_id)->first();

        $equipo_marca=new rdbtEquipoMarca(); 
        $equipo_marca->client_id=$request->input('user_id');
        $equipo_marca->rdbt_equipo_id=$request->input('equipo_id');
        $equipo_marca->rdbt_marca_id=$request->input('marca_id');
        $equipo_marca->rdbt_modelo_id=$rdbt_modelo_id;
        $equipo_marca->rdbtserie=$request->input('rdbtserie');
        $valFecha=carbon::now();
        if($request->input('prevencion')==1)  {
            $equipo_marca->rdbtFechaPrevencion=$valFecha->addMonths(3);
        }             
        elseif ($request->input('prevencion')==2) {
             # code...
            $equipo_marca->rdbtFechaPrevencion=$valFecha->addMonths(6);
        }elseif ($request->input('prevencion')==3) {
             # code...
          $equipo_marca->rdbtFechaPrevencion=$valFecha->addMonths(9);
      }elseif ($request->input('prevencion')==4) {
             # code...
          $equipo_marca->rdbtFechaPrevencion=$valFecha->addMonths(12);
      }else{
        return back()->with('notification','error en fecha de mantenimiento');
    }

    $equipo_marca->save();
    return back();
}

public function update(Request $request,$id)
{
    $rules=[
        'rdbtserie' => 'required|string',
    ];
    $messages=[
        'rdbtserie.required'=>'la serie debe ingresar',            
    ]; 
    $this->validate($request,$rules,$messages);

    $equipo_marca=rdbtEquipoMarca::find($id);
    $equipo_marca->client_id=$request->input('user_id');
    $equipo_marca->rdbt_equipo_id=$request->input('equipo_id');
    $equipo_marca->rdbt_marca_id=$request->input('marca_id');
    $equipo_marca->rdbt_modelo_id=$request->input('modelo_id');
    $equipo_marca->rdbtserie=$request->input('rdbtserie');
    $equipo_marca->save();


    return back()->with('notification','Equipo actualizado exitosamente');
}



public function delete($id)
{
    $equipo_marca=rdbtEquipoMarca::find($id);
    $equipo_marca->delete();

    return back()->with('notification','el equipo se ah eliminado correctamente');
}
public function restore($id)
{
    rdbtEquipoMarca::withTrashed()->find($id)->restore();
    return back()->with('notification', 'El equipo se ha habilitado correctamente.');
}

public function take(Request $request,$id){
    $equipo_marca=rdbtEquipoMarca::find($id);
    $equipo_marca->support_id=$request->input('rdbt_support_id');
    $equipo_marca->save();
    return back();
}

}

