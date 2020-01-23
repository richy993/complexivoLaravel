<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\rdbtAsignacion;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('content');
    }
    
     public function indexPrincipal()
    {
        $user = auth()->user();

          if($user->is_support){

                $my_incidents = rdbtAsignacion::where('support_id', $user->id)->get();

                    $pending_incidents = rdbtAsignacion::where('support_id', null)->get();                          
               }
               
               
                     $incidents_by_me = rdbtAsignacion::where('client_id', $user->id)->get();
              
       
        return view('Admin.asignacion.principal')->with(compact('my_incidents', 'pending_incidents', 'incidents_by_me'));
    }
}
