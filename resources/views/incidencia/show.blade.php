@extends('layouts.app')
<script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script
src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

<link rel="stylesheet"
href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
@section('content')
<div class="container" style="padding-left: 90px; padding-right: 90px;">
    <div class="panel panel-primary">
        <div class="panel-heading" style="background: -webkit-linear-gradient(left, #3366cc , white); color: #ffffff">Dashboard</div>

        <div class="panel-body">
            @if (session('notification'))
            <div class="alert alert-success">
                {{ session('notification') }}
            </div>
            @endif

            <table class="table table-bordered" >
                <thead style="background: -webkit-linear-gradient(left, green , white); color: #ffffff">
                    <tr>
                        <th>Código</th>
                        <th>Cliente</th>
                        <th>Telefono Cliente</th>
                        <th>Email Cliente</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td id="incident_key">{{ $incident->id }}</td>
                        <td id="incident_name">{{$incident->client->rdbtnombre.' '.$incident->client->rdbtapellido}}</td>
                        <td id="incident_LastName">{{$incident->client->rdbttelefono}}</td>
                        <td id="incident_email">{{$incident->client->email}}</td>
                    </tr>
                </tbody>
                <thead>
                    <tr>
                        <th>Fecha de incidencia</th>
                        <th>Asignado a</th>
                        <th>Estado</th>
                        <th>Severidad</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td id="incident_created_at">{{ $incident->created_at }}</td>
                        <td id="incident_responsible">{{$incident->support_name}}</td>
                        <td id="incident_state">{{$incident->state}}</td>
                        <td id="incident_severity">{{ $incident->severity_full }}</td>
                    </tr>
                </tbody>
            </table>


            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th>Equipo</th>
                        <td id="incident_attachment">{{$incident->rdbtEquipoMarca->rdbtEquipo->rdbtnombre.' '.$incident->rdbtEquipoMarca->rdbtMarca->rdbtnombre }}</td>
                    </tr>
                    <tr>
                        <th>Título</th>
                        <td id="incident_summary">{{ $incident->title }}</td>
                    </tr>
                    <tr>
                        <th>Descripción</th>
                        <td id="incident_description">{{ $incident->description }}</td>
                    </tr>

                </tbody>
            </table>
<!--
        @if($incident->support_id==null && $incident->active && auth()->user()->rdbtrol ==1 )
        <a href="/incidencia/{{$incident->id}}/atender" class="btn btn-primary btn-sm" id="incident_btn_apply">
            Atender incidencia
        </a>
        @endif

    -->
     @if($incident->support_id!=null && auth()->user()->id == $incident->support_id  )
   @if($incident->active==1)

   <button type="button" class="btn btn-sm btn-warning" data-toggle='modal' data-target="#myModal1{{$incident->id}}" title="Editar"> Ingresar informe </button>  

  <a href="{{route('asignacion.solve.view',$incident->id)}}" class="btn btn-info btn-sm" id="incident_btn_solve">
       Marcar como resuelto
   </a>
   @endif
    <a href="/AsSoporte" class="btn btn-secondary">Regresar</a>
       
   </a>

   <div class="modal fade" tabindex="-1" role="dialog" id="myModal1{{$incident->id}}">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Ingresar Informe</h4>
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

     <form action="/correctivo/informe" method="POST">
      <!--{{method_field('PUT')}} este indica que se usa el metodo put en las rutas-->
      {{ csrf_field() }} 
      <div class="modal-body">        

        <input type="hidden" name="rdbt_asignacion_id" value="{{$incident->id}}" >
        <div class="form-group">
           <label for="rdbtDetalle">Detalle</label>
           <textarea name="rdbtDetalle" class="form-control">{{old('rdbtDetalle')}}</textarea> 
           <div class="form-group">
             <label for="rdbtRecomendacion">Recomendacion</label>
             <!--{{old('title')}} permite conserva el dato que se puso cuando salen los errores -->
             <textarea name="rdbtRecomendacion" class="form-control">{{old('rdbtRecomendacion')}}</textarea> 
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

@endif

  
   
    <!--    @if(auth()->user()->id == $incident->client_id)
                @if($incident->active)
       
           <a href="/incidencia/{{$incident->id}}/editar" class="btn btn-success btn-sm" id="incident_btn_edit">
            Editar incidencia
        </a>

                @else
        <a href="/incidencia/{{$incident->id}}/abrir" class="btn btn-info btn-sm" id="incident_btn_open">
            Volver a abrir incidencia
        </a>
    
               @endif
       @endif
   -->
</div>
</div>
</div>
</div>
@if(auth()->user()->rdbtrol!=0 && $incident->support_id!=null && $incident->active!=0)
@include('layouts.chat')
@endif

@endsection
