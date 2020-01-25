@extends('layouts.app')
<script src="//code.jquery.com/jquery-1.12.3.js"></script>
<script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script
src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
<link rel="stylesheet"
href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<link rel="stylesheet"
href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">
@section('content')

<div class="container" style="padding-left: 90px; padding-right: 90px;">

<div class="container" >

  <div class="panel panel-default" >
    <div class="panel-heading" style="background: -webkit-linear-gradient(left, #3366cc , white); color: #ffffff">Dashboard</div>

    <div class="panel-body">
     <!-- VALIDACIONES Y MENSAJES DE ERROR-->
     @if (session('notification'))
     <div class="alert alert-sucess">
      {{session('notification')}}
    </div>
    @endif
    <!-- VALIDACIONES Y MENSAJES DE ERROR--> 
    @if (count($errors)>0)
    <div class="alert alert-danger">
      <ul>
        @foreach($errors->all() as $error)
        <li>{{$error}}</li>
        @endforeach
      </ul>
    </div>
    @endif

    <form action="" method="POST">
      {{csrf_field()}}

      <div class="form-group">
       <label for="email">Email</label>
       <!--{{old('title')}} permite conserva el dato que se puso cuando salen los errores -->
       <input type="email" name="email" class="form-control" value="{{old('email')}}" > 
     </div>
     <div class="form-group">
       <label for="rdbtnombre">Nombre</label>
       <input type="text" name="rdbtnombre" class="form-control" value="{{old('rdbtnombre')}}" required pattern="[A-Za-z ]+"
         title="solo letras">    </div>
       <div class="form-group">
         <label for="rdbtapellido">Apellido</label>
         <input type="text" name="rdbtapellido" class="form-control" value="{{old('rdbtapellido')}}" required pattern="[A-Za-z ]+"
         title="solo letras"> 
       </div>

       <div class="form-group" >

         <label for="rdbtcedula">Cedula</label>
         <input type="text" name="rdbtcedula" class="form-control" value="{{old('rdbtcedula')}}" required pattern="[0-9]+"
         title="solo numeros positivos">  </div>

         <div class="form-group" >
           <label for="rdbttelefono">Telefono</label>
           <input type="text" name="rdbttelefono" class="form-control" value="{{old('rdbttelefono')}}" required pattern="[0-9]+"
         title="solo numeros positivos">   </div>

           <div class="form-group">
             <label for="rdbtdirreccion">Dirreccion</label>
             <input type="text" name="rdbtdirreccion" class="form-control" value="{{old('rdbtdirreccion')}}">   </div>
             <div class="form-group">
              <select name="rdbtrol" class="form-control" id="select-level">
                <option value="1">Tecnico</option>
                <option value="2">Cliente</option>
              </select>
            </div>
              <div class="form-group">
               <label for="password">Contraseña</label>
               <textarea name="password" class="form-control">{{old('password',str_random(8))}}</textarea> 
             </div>
             <div class="form-group">
               <button class="btn btn-primary">Registrar Usuario</button>
             </div>
             
           </form>
            <table id="Usertable" class="display table table-bordered"  >
       <thead  style="background: -webkit-linear-gradient(left, green , white); color: #ffffff">
         <tr>
          <th>Email</th>
          <th>Nombre</th>
          <th>Apellido</th>
          <th>Cedula</th>
          <th>Telefono</th>
          <th>Dirreccion</th>
          <th>Tipo Usuario</th>
          <th>Opciones</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($users as $user)
        <tr>
          <td>{{$user->email}}</td>
          <td>{{$user->rdbtnombre}}</td>
          <td>{{$user->rdbtapellido}}</td>
          <td>{{$user->rdbtcedula}}</td>
          <td>{{$user->rdbttelefono}}</td>
          <td>{{$user->rdbtdirreccion}}</td>
          @if($user->rdbtrol==1)
          <td> {{$user->rdbtrol='tecnico'}} </td>
          @else
          <td> {{$user->rdbtrol='cliente'}} </td>
          @endif
          <td>

            <a href="{{route('usuarios.edit.view',$user->id) }}" class="btn btn-sm btn-primary" title="Editar">
              <!--esta linea permitira poner el icono en el boton-->
              <span class="glyphicon glyphicon-pencil"></span>
            </a>
            <a href="{{route('usuarios.delete.view', $user->id,'eliminar') }}" class="btn btn-sm btn-danger" title="Eliminar">
              <span class="glyphicon glyphicon-remove"></span>
            </a>
          </td>
        </tr>
        @endforeach

      </tbody>
    </table>
         </div>

       </div>

     </div>
   
   </div>
    
   
    @endsection

    <script>$(document).ready( function () {
      $('#Usertable').DataTable();
    } );
  </script>
