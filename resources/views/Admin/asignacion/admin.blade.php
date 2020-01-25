
@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

<div class="panel panel-primary">
	<div class="panel-heading" style="background:-webkit-linear-gradient(left,#3366cc , white); color: #ffffff">Dashboard</div>


	<div class="panel-body">
		<div class="panel panel-primary">
			<div class="panel-heading" style="background: -webkit-linear-gradient(left, green , white); color: #ffffff">
				<h3 class="panel-title">Incidencias resueltas</h3>
			</div>
			<div class="panel-body">
				<table class="table table-bordered">
					<thead >
						<tr>
							<th>Código</th>
							<th>Cliente</th>
							<th>soporte</th>
							<th>Severidad</th>
							<th>Estado</th>
							<th>Fecha Finalizacion</th>
							<th>Descripcion</th>
						</tr>
					</thead>
					<tbody id="dashboard_my_incidents">
						<!-- severity_full se encuentrs en el modelo y permite obtener el nombre completo de la severidad de la asignacion-->
						@foreach ($my_results as $incident)
						<tr>
							<td><a href="/ver/{{ $incident->id }}/incident">
								{{ $incident->id }}</td>
								<td>{{$incident->client->rdbtnombre.' '.$incident->client->rdbtapellido}}</td>
								<td>{{$incident->support->rdbtnombre.' '.$incident->support->rdbtapellido}}</td>
								<td>{{ $incident->severity_full }}</td>
								<td>{{ $incident->state }}</td>
								<td>{{ $incident->updated_at }}</td>
								<td>{{ $incident->title_long }}</td>
							</tr>
							@endforeach

						</tbody>
					</table>
				</div>
			</div>
			<div class="panel panel-primary">
				<div class="panel-heading" style="background: -webkit-linear-gradient(left, green , white); color: #ffffff">
					<h3 class="panel-title">Incidencias asignadas a Soporte</h3>
				</div>
				<div class="panel-body">
					<table class="table table-bordered">
						<thead>
							<tr>
								<th>Código</th>
								<th>Cliente</th>
								<th>soporte</th>
								<th>Severidad</th>
								<th>Estado</th>
								<th>Fecha asignacion</th>
								<th>Descripcion</th>
							</tr>
						</thead>
						<tbody id="dashboard_my_incidents">
							<!-- severity_full se encuentrs en el modelo y permite obtener el nombre completo de la severidad de la asignacion-->
							@foreach ($my_incidents as $incident)
							<tr>
								<td>
									<a href="/ver/{{ $incident->id }}/incident">
										{{ $incident->id }}

									</td>
									<td>{{$incident->client->rdbtnombre.' '.$incident->client->rdbtapellido}}</td>
									<td>{{$incident->support->rdbtnombre.' '.$incident->support->rdbtapellido}}</td>
									<td>{{ $incident->severity_full }}</td>
									<td>{{ $incident->state }}</td>
									<td>{{ $incident->updated_at }}</td>
									<td>{{ $incident->title_short }}</td>
								</tr>
								@endforeach

							</tbody>
						</table>
					</div>
				</div>
				<form action="" method="POST">
					{{csrf_field()}}
					<div class="panel panel-primary">
						<div class="panel-heading" style="background: -webkit-linear-gradient(left, green , white); color: #ffffff">
							<h3 class="panel-title">Incidencias sin asignar</h3>
						</div>

						<div class="panel-body">
							<table class="table table-bordered">
								<thead>
									<tr>
										<th>Código</th>	
										<th>Cliente</th>
										<th>Severidad</th>
										<th>Estado</th>
										<th>Fecha creación</th>
										<th>Titulo</th>
										<th>asignar tecnico</th>

									</tr>
								</thead>

								<tbody id="dashboard_my_incidents">
									@foreach ($pending_incidents as $incident)
									<tr>
										<td>
											<a href="/ver/{{ $incident->id }}/incident">
												{{ $incident->id }}
											</a>
										</td>
										<td>{{$incident->client->rdbtnombre.' '.$incident->client->rdbtapellido}}</td>
										<td>{{ $incident->severity_full }}</td>
										<td>{{ $incident->state }}</td>
										<td>{{ $incident->created_at }}</td>
										<td>{{ $incident->title_short }}</td>

										<td>
											<a href="/incidencia/{{$incident->id}}/editar" class="btn btn-primary btn-sm" id="incident_btn_apply">
												Asignar
											</a>


										</td>
									</tr>
									@endforeach
								</tbody>

							</table>
						</div>
					</div>
				</form>

			</div>
		</div>
		@endsection
