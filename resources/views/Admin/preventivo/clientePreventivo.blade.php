@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<div class="container" style="padding-left: 40px; padding-right: 40px;">
	<div class="panel panel-primary">
		<div class="panel-heading" style="background: -webkit-linear-gradient(left, #3366cc , white); color: #ffffff">Dashboard</div>
		<div class="panel-body">

			<div class="panel panel-primary">
				<div class="panel-heading" style="background: -webkit-linear-gradient(left, green , white); color: #ffffff">
					<h3 class="panel-title">Mantenimientos preventivos</h3>
				</div>
				<div class="panel-body">
					<table class="table table-bordered" >
						<thead >
							<tr >
								<th>Código</th>
								<th>usuario</th>
								<th>equipo</th>
								<th>marca</th>
								<th>modelo</th>
								<th>serie</th>
								<th>Fecha Asignacion</th>
								<th>Fecha Mantenimiento</th>
								<th>Responsable</th>
								<th>Informe</th>
							</tr>
						</thead>
						<tbody id="dashboard_my_incidents">
							@foreach ($equipos_marcas as $incident)
							<tr>
								<td>
									<a href="/ver/{{ $incident->id }}" >
										{{ $incident->id }}
									</a>
								</td>
								

								<td>{{ $incident->client->rdbtnombre.' '.$incident->client->rdbtapellido}}</td>
								<td>{{ $incident->rdbtequipo->rdbtnombre }}</td>
								<td>{{ $incident->rdbtmarca->rdbtnombre }}</td>
								<td>{{ $incident->rdbtmodelo->rdbtnombre }}</td>
								<td>{{ $incident->rdbtserie }}</td>
								<td>{{ $incident->created_at }}</td>
								<td>{{$incident->rdbtFechaPrevencion}}</td>
								<td>
									{{ $incident->support_id ? $incident->support->rdbtnombre." ".$incident->support->rdbtapellido : 'Sin asignar' }}
								</td>
								@if($incident->active==0)
								<td>	<a href="{{route('prevencion.reportCliente.view',$incident->id)}}" target="_blank"  title="reporte"><b>PDF</b>
									<span class="glyphicon glyphicon-list-alt"></span></a>
								</td>
								@else
								<td>no Resuelto</td>
								@endif
							</tr>
							@endforeach
							
						</tbody>
					</table>

				</div>

			</div>

		</div>

			
	</div>
</div>
@endsection
