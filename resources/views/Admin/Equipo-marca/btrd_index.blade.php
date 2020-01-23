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
    <div class="panel-heading">Dashboard</div>

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
    <center>
      <form action="" method="POST">
        {{csrf_field()}}

        <div class="row">
          <div class="col-md-11">
           <div class="form-group">
             <label for="user_id">seleccione el usuario</label>
             <select class="form-control" id="select-user" name="user_id">
              <option value="0">Seleccione el user</option>
              @foreach($users as $user)
              <option value="{{$user->id}}">{{$user->rdbtnombre}}&nbsp; {{$user->rdbtapellido}}</option>
              @endforeach
            </select>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-5">
         <div class="form-group">
           <label for="user_id">seleccione el equipo</label>
           <select class="form-control" id="select-equipo" name="equipo_id">
            <option value="0">Seleccione el equipo</option>
            @foreach($equipos as $equipo)
            <option value="{{$equipo->id}}">{{$equipo->rdbtnombre}}</option>
            @endforeach
          </select>
        </div>
      </div>


      <div class="col-md-6">
       <div class="form-group">
         <label for="user_id">seleccione la marca</label>
         <select class="form-control" id="select-marca" name="marca_id">
          <option value="0">Seleccione la marca</option>
          @foreach($marcas as $marca)
          <option value="{{$marca->id}}">{{$marca->rdbtnombre}}</option>
          @endforeach
        </select>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-5">
      <div class="form-group">
       <label for="user_id">seleccione el modelo</label>
       <select class="form-control" id="select-modelo" name="modelo_id">
         <option value="">Seleccione el modelo</option>
       </select>
     </div>
   </div>
   <div class="col-md-6">
    <div class="form-group">
     <label for="rdbtserie">Serie</label>
     <input type="text" name="rdbtserie" class="form-control" value="{{old('rdbtserie')}}"> </div>    
   </div>
 </div>
 <div class="row">
  <div class="col-md-5">
   <div class="form-group">
    <select name="prevencion" class="form-control" id="select-level">
      <option value="1">3 meses</option>
      <option value="2">6 meses</option>
       <option value="3">9 meses</option>
        <option value="4">12 meses</option>
    </select>
  </div>
</div>
</div>  
<br>
<div class="form-group">
  <button class="btn btn-primary">Registrar Equipo</button>
</div>    
</form>
</center>
<br>
<br>
<br>
<table id="Usertable" class="display table table-bordered">
 <thead class="thead-dark">
   <tr>
    <th>Identificacion</th>
    <th>Nombre</th>
    <th>Apellido</th>
    <th>Equipo</th>
    <th>Marca</th>
    <th>Modelo</th>
    <th>Serie</th>
    
  </tr>
</thead>
<tbody>
  @foreach ($equipos_marcas as $equipo)
  <tr>
    <td>{{$equipo->client->rdbtcedula}}</td>
    <td>{{$equipo->client->rdbtnombre}}</td>
    <td>{{$equipo->client->rdbtapellido}}</td>
    <td>{{$equipo->rdbtEquipo->rdbtnombre}}</td>
    <td>{{$equipo->rdbtMarca->rdbtnombre}}</td>
    <td>{{$equipo->rdbtModelo->rdbtnombre}}</td>
    <td>{{$equipo->rdbtserie}}</td>

    
    <td>

      @if($equipo->Trashed())
      <a href="{{route('Equipo-marca.restore.view', $equipo->id,'restaurar') }}" class="btn btn-sm btn-sucess" title="Restaurar">
        <span class="glyphicon glyphicon-repeat"></span>
      </a>
      @else
      <button type="button" class="btn btn-sm btn-warning" data-toggle='modal' data-target="#myModal{{$equipo->id}}" title="Editar">
        <span class="glyphicon glyphicon-pencil"></span>
      </button>
      <!--pantalla modal-->

      <a href="{{route('Equipo-marca.delete.view', $equipo->id,'eliminar') }}" class="btn btn-sm btn-danger" title="Eliminar">
        <span class="glyphicon glyphicon-remove"></span>
      </a>
      <div class="modal fade" tabindex="-1" role="dialog" id="myModal{{$equipo->id}}">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Editar Equipo</h4>
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

             <form action="{{route('Equipomarca.update.view',$equipo)}}" method="POST">
              <!--{{method_field('PUT')}} este indica que se usa el metodo put en las rutas-->
              {{ csrf_field() }} {{method_field('PUT')}}
              <div class="modal-body">  
                <div class="row">
                  <div class="col-md-11">      
                   <div class="form-group">
                    <label for="usuario">Usuario</label>
                    <select name="user_id" class="form-control" id='user_id'>
                      @foreach($users as $user)
                      <option value="{{$user->id}}" @if($equipo->client_id==$user->id) selected @endif  >{{$user->rdbtnombre}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-5">      
                 <div class="form-group">
                  <label for="equipo">EQUIPO</label>
                  <select name="equipo_id" class="form-control" id='equipo_id'>
                    @foreach($equipos as $equipa)
                    <option value="{{$equipa->id}}" @if($equipo->rdbt_equipo_id==$equipa->id) selected @endif  >{{$equipa->rdbtnombre}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-md-6">
               <div class="form-group">
                 <label for="marca">seleccione la marca</label>
                 <select class="form-control" id="marca_id" name="marca_id">   
                  @foreach($marcas as $marca)
                  <option value="{{$marca->id}}" @if($equipo->rdbt_marca_id==$marca->id) selected @endif>{{$marca->rdbtnombre}}</option>
                  @endforeach
                </select>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-5">
             <div class="form-group">
               <label for="user_id">seleccione el modelo</label>
                <select class="form-control" id="modelo_id" name="modelo_id">   
                  @foreach($modelos as $modelo)
                  <option value="{{$modelo->id}}" @if($equipo->rdbt_modelo_id==$modelo->id) selected @endif>{{$modelo->rdbtnombre}}</option>
                  @endforeach
                </select>
             </div>
           </div>
         </div>

         <div class="form-group">
           <label for="rdbtnombre">Serie</label>
           <input type="text" name="rdbtserie" class="form-control" value="{{$equipo->rdbtserie}}" > </div>   


           <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary">Guardar cambios</button>
          </div>
        </form>
      </div>

    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
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

@section('scripts')


<script type="text/javascript" src="{{ asset('js/Admin/Equipos/edit.js') }}"></script>
@endsection

