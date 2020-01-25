<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\rdbtAsignacion;
use Mail;
class rdbtChartController extends Controller
{
    //
    public function index(){
    	
    	return view('chart.graficas');
    }
    public function store(Request $request){
    	Mail::send('chart.contact',$request->all(),function($smj){
    		$smj->subject('correo de contacto');
    		$smj->to('richdeivid993@gmail.com');
    	});
    	return redirect('/chart.graficas');
    }
}
