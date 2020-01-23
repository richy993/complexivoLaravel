@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<div class="container" style="padding-left: 40px; padding-right: 40px;">
	<div class="panel panel-primary">
	<div class="panel-heading">Dashboard</div>


	<div class="panel-body">

		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title">Incidencias asignadas a mí</h3>
			</div>
			<div class="panel-body">
				<table class="table table-bordered">
					<thead>
							<tr>
								<th>Código</th>
								<th>usuario</th>
								<th>equipo</th>
								<th>marca</th>
								<th>modelo</th>
								<th>serie</th>
								<th>Fecha Asignacion</th>
								<th>Fecha Mantenimiento</th>
								<th>Responsable</th>
							</tr>
						</thead>
						<tbody id="dashboard_my_incidents">
							@foreach ($my_incidents as $incident)
							<tr>
								<td>
									<a href="/ver/{{ $incident->id }}/view" >
										{{ $incident->id }}
									</a>
								</td>
								

								<td>{{ $incident->client->rdbtnombre.' '.$incident->client->rdbtapellido}}</td>
								<td>{{ $incident->rdbtequipo->rdbtnombre }}</td>
								<td>{{ $incident->rdbtmarca->rdbtnombre }}</td>
								<td>{{ $incident->rdbtmodelo->rdbtnombre }}</td>
								<td>{{ $incident->rdbtnombre }}</td>
								<td>{{ $incident->created_at }}</td>
								<td>{{$incident->rdbtFechaPrevencion}}</td>
								<td>
									{{ $incident->support_id ? $incident->support->rdbtnombre." ".$incident->support->rdbtapellido : 'Sin asignar' }}
								</td>
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
