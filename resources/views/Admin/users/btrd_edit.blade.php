
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

@section('content')

<div class="container" style="padding-left: 90px; padding-right: 90px;">
  <div class="panel panel-default">
    <div class="panel-heading">Dashboard</div>

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
          <div class="form-group">
         <label for="email">Email</label>
         <!--{{old('title')}} permite conserva el dato que se puso cuando salen los errores -->
         <input type="email" name="email" class="form-control" value="{{old('email',$user->email)}}"> 
       </div>
       <div class="form-group">
         <label for="rdbtnombre">Nombre</label>
         <input type="text" name="rdbtnombre" class="form-control" value="{{old('rdbtnombre',$user->rdbtnombre)}}" required pattern="[A-Za-z ]+"
         title="solo letras">   </div>
       <div class="form-group">
         <label for="rdbtapellido">Apellido</label>
         <input type="text" name="rdbtapellido" class="form-control" value="{{old('rdbtapellido',$user->rdbtapellido)}}" required pattern="[A-Za-z ]+"
         title="solo letras">  </div>
       <div class="form-group">
         <label for="rdbtcedula">Cedula</label>
        <input type="text" name="rdbtcedula" class="form-control" value="{{old('rdbtcedula',$user->rdbtcedula)}}" required pattern="[0-9]+"
         title="solo numeros positivos">  </div>
       <div class="form-group">
         <label for="rdbttelefono">Telefono</label>
         <input type="text" name="rdbttelefono" class="form-control" value="{{old('rdbttelefono',$user->rdbttelefono)}}" required pattern="[0-9]+"
         title="solo numeros positivos">   </div>
         <div class="form-group">
         <label for="rdbtdirreccion">Dirreccion</label>
         <input type="text" name="rdbtdirreccion" class="form-control" value="{{old('rdbtdirreccion',$user->rdbtdirreccion)}}">   </div>
         <div class="form-group">
                      <select name="rdbtrol" class="form-control" id="select-level">
                        <option value="1">Tecnico</option>
                          <option value="2">Cliente</option>
                    </select>
       <div class="form-group">
         <label for="password">Contraseña    Ingresar solo si se desea modificar</em></label>
         <textarea name="password" class="form-control">{{old('password')}}</textarea> 
       </div>
       <div class="form-group">
         <button class="btn btn-primary">Guardar Usuario</button>

               <a href="/usuarios" class="btn btn-secondary">Regresar</a>
             
       </div>
       
     </form>

  </div>

</div>
</div>
@endsection


