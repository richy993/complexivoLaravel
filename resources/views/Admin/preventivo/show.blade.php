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
        <thead >
          <tr>
            <th>Código</th>
            <th>Cliente</th>
            <th>equipo Cliente</th>
            <th>modelo equipo</th>
            <th>marca Equipo</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td id="incident_key">{{ $incident->id }}</td>
            <td id="incident_name">{{$incident->client->rdbtnombre.' '.$incident->client->rdbtapellido}}</td>
            <td id="incident_equipo">{{$incident->rdbtequipo->rdbtnombre}}</td>
            <td id="incident_modelo">{{$incident->rdbtmodelo->rdbtnombre}}</td>
            <td id="incident_marca">{{$incident->rdbtmarca->rdbtnombre}}</td>
          </tr>
        </tbody>
        <thead>
          <tr>
            <th>Serie Equipos</th>
            <th>Fecha de Asignacion</th>
            <th>Fecha de Mantenimiento</th>
            <th>Responsable</th>
            <th>Dias Restantes</th>
          </tr>
        </thead>
        <tbody>
          <tr>
           <td id="incident_serie">{{$incident->rdbtserie}}</td>
           <td id="incident_created_at">{{ $incident->created_at }}</td>
           <td id="incident_created_at">{{ $incident->rdbtFechaPrevencion }}</td>

           <td id="incident_responsible">{{$incident->support_name}}</td>
           @if($incident->support!=null)
           <td id="incident_dias_faltantes"><b>asignado</b></td>
           @else


           @if($hello >=20 && $hi<$hi2)
           <td id="incident_dias_faltantes"><b>{{$hello}} dias</b></td>
           @elseif($hello<20 && $hello>=10 && $hi<$hi2)
            <td id="incident_dias_faltantes" bgcolor="green" ><font color="#000000"><b>{{$hello}} dias </b></td>
              @elseif($hello<10 && $hello>5 && $hi<$hi2)
                <td id="incident_dias_faltantes" bgcolor="yellow" ><font color="#000000"><b>{{$hello}} dias </b></font></td>
                @elseif($hello<=5 && $hello>=0 && $hi<=$hi2)
                <td id="incident_dias_faltantes" bgcolor="orange" ><font color="#ffffff"><b>{{$hello}} dias </b></td>
                  @elseif($hello>0 && $hi>$hi2)
                  <td id="incident_dias_faltantes" bgcolor="red" ><font color="#ffffff"><b>{{$hello}} dias de atraso</b></td>
                    @endif
                    @endif

                  </tr>
                </tbody>
              </table>


              @if($incident->support_id!=null && auth()->user()->id == $incident->support_id && $incident->active==1)

              <button type="button" class="btn btn-sm btn-warning" data-toggle='modal' data-target="#myModal1{{$incident->id}}" title="Editar" > Ingresar informe </button>
              <a href="{{route('preventivo.solve.view',$incident->id)}}" class="btn btn-info btn-sm" id="incident_btn_solve">
               Marcar como resuelto
             </a>
             <a href="/preventivo/soporte" class="btn btn-secondary">Regresar</a>
             <div class="modal fade" tabindex="-1" role="dialog" id="myModal1{{$incident->id}}">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Editar marca</h4>
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

                   <form action="/preventivo/informe" method="POST">
                    <!--{{method_field('PUT')}} este indica que se usa el metodo put en las rutas-->
                    {{ csrf_field() }} 
                    <div class="modal-body">        

                      <input type="hidden" name="equipo_marca_id" value="{{$incident->id}}" >
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
          @if(auth()->user()->rdbtrol == 0 && $incident->support_id==null)


          <button type="button" class="btn btn-sm btn-success" data-toggle='modal' data-target="#myModal{{$incident->id}}" title="Atender">
            Asignar
          </button>

          <div class="modal fade" tabindex="-1" role="dialog" id="myModal{{$incident->id}}">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title">Seleccionar tecnico</h4>
                </div>
                <div class="modal-body">

                  <style type="text/css">
                    select {text-transform: uppercase;}
                    button {text-transform: uppercase;}     
                  </style>

                  <form action="{{route('preventivo.take.view',$incident)}}" method="POST">
                    <!--{{method_field('PUT')}} este indica que se usa el metodo put en las rutas-->
                    {{ csrf_field() }} {{method_field('PUT')}}
                    <div class="modal-body">        

                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <select class="form-control" id="rdbt_support_id" name="rdbt_support_id">
                              <option value="">Seleccione el tecnico</option>
                              @foreach($soporte as $sup)
                              <option value="{{$sup->id}}">{{$sup->rdbtnombre.' '.$sup->rdbtapellido}}</option>
                              @endforeach
                            </select>
                          </div>
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

          </td>


          @endif
           <a href="/preventivo/soporte" class="btn btn-secondary">Regresar</a>
        </div>
      </div>
    </div>

    @endsection
