<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\rdbt_message;
use App\rdbtAsignacion;
class MessageController extends Controller
{
    //
    public function __construct()
	{
		$this->middleware('auth');
	}


	public function store(Request $request)
	{
$rules = [
    		'message' => 'required|min:5|max:255'
    	];
    	$messages = [
    		'message.required' => 'Olvidó ingresar un mensaje.',
    		'message.min' => 'Ingrese al menos 5 caracteres.',
    		'message.max' => 'Ingrese como máximo 255 caracteres.'
    	];

    	$this->validate($request, $rules, $messages);

    	$message = new rdbt_message();

    	$message->rdbt_asignacion_id = $request->input('rdbt_asignacion_id');
    	$message->rdbtmessage = $request->input('message');
    	$message->user_id = auth()->user()->id;
    	$message->save();

    	return back()->with('notification', 'Su mensaje se ha enviado con éxito.');
	}
}
