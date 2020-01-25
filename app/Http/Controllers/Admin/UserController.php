<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
USE Illuminate\Contracts\Encryption\Encrypter;
use Illuminate\Support\Facades\Crypt;
class UserController extends Controller
{
    //
	public function getRouteKey()
	{
		$hashids = new \Hashids\Hashids('MySecretSalt');

		return $hashids->encode($this->getKey());
	}


	public function index()
	{
		$users=User::where('rdbtrol','!=',0)->get();
		//$users=User::where('role',1)->get();
		return view('Admin.users.btrd_index')->with(compact('users'));
	}
    //store es el guardar nuevo registro
	public function store(Request $request)
	{
		$rules=[
			'rdbtnombre' => 'required|string|max:255',
			'rdbtapellido' => 'required|string|max:255',
			'rdbtcedula' => 'required|numeric|digits_between:10,10|unique:users',
			'rdbttelefono' => 'required|numeric|digits_between:7,12',
			'rdbtdirreccion' => 'string|max:255',
			'email' => 'required|string|email|max:255|unique:users',
			'password' => 'required|string|min:6',
		];
		$messages=[
			'rdbtnombre.required'=>'Es necesario ingresar el nombre del usuario',
			'rdbtnombre.max'=>'el nombre es demasiado extenso',
			'rdbtapellido.required'=>'Es necesario ingresar el apellido del usuario',
			'rdbtapellido.max'=>'el apellido es demasiado extenso',			
			'rdbtcedula.required'=>'Es necesario ingresar la cedula del usuario',
			'rdbtcedula.digits_between'=>'la cedula debe ser de 10 digitos',
			'rdbtcedula.unique'=>'Esta cedula ya se encuentra en uso',
			'rdbtcedula.numeric'=>'Esta cedula solo acepta valores numericos',
			'rdbttelefono.required'=>'Es necesario ingresar el telefono del usuario',
			'rdbttelefono.max'=>'el telefono es demasiado extenso',
			'rdbttelefono.min'=>'el telefono es demasiado corto',
			'rdbttelefono.numeric'=>'el telefono solo acepta cadena de numeros',
			'rdbttelefono.digits_between'=>'el telefono solo acepta cadena de 7 hasta 12 digitos',
			'rdbtdirreccion.string'=>'debe ingresar una dirreccion',
			'rdbtdirreccion.max'=>'la dirreccion es demasiado extenso',
			'email.required'=>'Es indispensable ingresar el e-mail del usuario',
			'email.email'=>'el E-mail ingresado no es valido',
			'email.max'=>'El E-mail es demasiado extenso',
			'email.unique'=>'Este E-mail ya se encuentra en uso',
			'password.required'=>'Olvido ingresar una contraseña',
			'password.min'=>'La contraseña debe presentar al menos 6 caracteres'
		];
		$this->validate($request,$rules,$messages);
		$user=new User();
		$user->rdbtnombre=$request->input('rdbtnombre');
		$user->rdbtapellido=$request->input('rdbtapellido');
		$user->rdbtcedula=$request->input('rdbtcedula');
		$user->rdbttelefono=$request->input('rdbttelefono');
		$user->rdbtdirreccion=$request->input('rdbtdirreccion');
		$user->rdbtrol=$request->input('rdbtrol');
		$user->email=$request->input('email');
		$user->password=bcrypt($request->input('password'));

		
		$user->save();
		//dd($request->all());
		return back()->with('notification','Usuario registrado exitosamente');
	}
	
	public function edit($id)
	{
		$user=User::find($id);		
		return  view('Admin.users.btrd_edit')->with(compact('user'));
		
	}
//se pondran los errores
		//$this->notFound($user);

		// cambar el select dinamicamente
	//	$projects=rdbt_proyecto::all();


	//	$projects_user=rdbt_proyectoUser::where('user_id',$user->id)->get();
		//return view('Admin.users.btrd_edit')->with(compact('user'));
	
	public function update($id,Request $request)
	{
		$rules=[
			'rdbtnombre' => 'required|string|max:255',
			'rdbtapellido' => 'required|string|max:255',
			'rdbtcedula' => 'numeric|required|string|min:10',
			'rdbttelefono' => 'numeric|required|string|min:7',
			'rdbtdirreccion' => 'string|max:255',
			'email' => 'required|string|email|max:255',
			'password' => 'nullable|string|min:6',
		];
		$messages=[
			'rdbtnombre.required'=>'Es necesario ingresar el nombre del usuario',
			'rdbtnombre.max'=>'el nombre es demasiado extenso',
			'rdbtapellido.required'=>'Es necesario ingresar el apellido del usuario',
			'rdbtapellido.max'=>'el apellido es demasiado extenso',			
			'rdbtcedula.required'=>'Es necesario ingresar la cedula del usuario',
			//'rdbtcedula.max'=>'la cedula es demasiado extensa',
			'rdbtcedula.min'=>'la cedula es demasiado corta',
			'rdbtcedula.unique'=>'Esta cedula ya se encuentra en uso',
			'rdbtcedula.numeric'=>'Este campo solo acepta numeros',
			'rdbttelefono.required'=>'Es necesario ingresar el telefono del usuario',
			//'rdbttelefono.max'=>'el telefono es demasiado extenso',
			'rdbttelefono.min'=>'el telefono es demasiado corto',
			'rdbttelefono.numeric'=>'el telefono solo acepta cadena de numeos',
			'rdbtdirreccion.max'=>'la dirreccion es demasiado extenso',
			'email.required'=>'Es indespinsable ingresar el e-mail del usuario',
			'email.email'=>'el E-mail ingresado no es valido',
			'email.max'=>'El E-mail es demasiado extenso',
			'email.unique'=>'Este E-mail ya se encuentra en uso',
			'password.required'=>'Olvido ingresar una contraseña',
			'password.min'=>'La contraseña debe presentar al menos 6 caracteres'
		];
		$this->validate($request,$rules,$messages);

		$user=User::find($id);
		$user->rdbtnombre=trim(strtoupper($request->input('rdbtnombre')));
		$user->rdbtapellido=trim(strtoupper($request->input('rdbtapellido')));
		$user->rdbtcedula=trim($request->input('rdbtcedula'));
		$user->rdbttelefono=trim($request->input('rdbttelefono'));
		$user->rdbtdirreccion=trim(strtoupper($request->input('rdbtdirreccion')));
		$user->rdbtrol=trim($request->input('rdbtrol'));
		$user->email=trim($request->input('email'));
		$password=trim(bcrypt($request->input('password')));
		if($password)
			$user->password=bcrypt($password);
		$user->save();
		return back()->with('notification','Usuario actualizado exitosamente');
	}
	public function delete($id)
	{
		$user=User::find($id);
		$user->destroy($user->id);

		return back()->with('notification','el usuario se ah eliminado correctamente');
	}
}




