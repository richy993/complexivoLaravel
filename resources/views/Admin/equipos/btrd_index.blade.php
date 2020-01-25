@extends('layouts.app')

<script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script
src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

<link rel="stylesheet"
href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

<style>
  input {text-transform: uppercase;}
  textarea {text-transform: uppercase;}
</style>
@section('content')

<div class="container" style="padding-left: 90px; padding-right: 90px;">
  <div class="panel panel-default">
    <div class="panel-heading" style="background: -webkit-linear-gradient(left, #3366cc , white); color: #ffffff">Dashboard</div>

    <div class="panel-body">
     <!-- VALIDACIONES Y MENSAJES DE ERROR-->
     @if (session('notification'))
     <div class="alert alert-primary">
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
       <label for="rdbtnombre">Nombre</label>
       <input type="text" name="rdbtnombre" class="form-control" value="{{old('rdbtnombre')}}"> </div>
       <div class="form-group">
         <label for="rdbtdescripcion">Descripcion</label>
         <!--{{old('title')}} permite conserva el dato que se puso cuando salen los errores -->
         <textarea name="rdbtdescripcion" class="form-control" > {{old('rdbtdescripcion')}} 
         </textarea>
       </div>
       
    <div class="form-group">
      <button class="btn btn-primary">Registrar equipo</button>
    </div>    
  </form>
  <table id="Usertable" class="display table table-bordered" >
   <thead style="background: -webkit-linear-gradient(left, green , white); color: #ffffff">
     <tr>
      <th>Nombre</th>
      <th>Descripcion</th>
     <th>opciones</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($equipos as $equipo)
    <tr>
      <td>{{strtoupper($equipo->rdbtnombre)}}</td>
      <td>{{strtoupper($equipo->rdbtdescripcion)}}</td>
      
      <td>

       @if($equipo->Trashed())
       <a href="{{route('equipos.restore.view', $equipo->id,'restaurar') }}" class="btn btn-sm btn-sucess" title="Restaurar">
        <span class="glyphicon glyphicon-repeat"></span>
      </a>
      @else
      <button type="button" class="btn btn-sm btn-warning" data-toggle='modal' data-target="#myModal{{$equipo->id}}" title="Editar">
        <span class="glyphicon glyphicon-pencil"></span>
      </button>
      <!--pantalla modal-->
      <div class="modal fade" tabindex="-1" role="dialog" id="myModal{{$equipo->id}}">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Editar equipo</h4>
            </div>
            <div class="modal-body">
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
              <style type="text/css">
               input {text-transform: uppercase;}
               textarea {text-transform: uppercase;}     
             </style>

             <form action="{{route('equipos.update.view',$equipo)}}" method="POST">
              <!--{{method_field('PUT')}} este indica que se usa el metodo put en las rutas-->
              {{ csrf_field() }} {{method_field('PUT')}}
              <div class="modal-body">        

                <div class="form-group">
                 <label for="rdbtnombre">Nombre</label>
                 <input type="text" name="rdbtnombre" class="form-control" value="{{$equipo->rdbtnombre}}" > </div>
                 <div class="form-group">
                   <label for="rdbtdescripcion">Descripcion</label>
                   <!--{{old('title')}} permite conserva el dato que se puso cuando salen los errores -->
                   <input type="text" name="rdbtdescripcion" class="form-control" value="{{$equipo->rdbtdescripcion}}">
                 </div>    
               </div>
               
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
              <button type="submit" class="btn btn-primary">Guardar cambios</button>
            </div>
          </form>
        </div>

      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->

  <a href="{{route('equipos.delete.view', $equipo->id,'eliminar') }}" class="btn btn-sm btn-danger" title="Eliminar">
    <span class="glyphicon glyphicon-remove"></span>
  </a>
  @endif
</td>
</tr>
@endforeach

</tbody>
</table>



</div>

</div>
</div>


@endsection

<script>$(document).ready( function () {
  $('#Usertable').DataTable();
} );
</script>


