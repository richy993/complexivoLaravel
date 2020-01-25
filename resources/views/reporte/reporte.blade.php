

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<div class="panel panel-primary">
	
	<div class="panel-body">
		<html>
		<head>
			<link rel="stylesheet" type="text/css" href="{{ URL::asset('/css/reporte.css')}}">
			<body>
				<header>
					<img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTiB6UcPV58dBeVdkiN63ZboxZOBPxmVtf_AFhJ5Wc9N-4Z_UsC&s" width="250px;">
					<h3>Incidencias</h3>
				</header>
				<footer>
					<table>
						<tr>
							<td>
								<p class="izq">
									Itsco /Richard Balarezo
								</p>
							</td>
							<td>
								<p class="page">
									Página
								</p>
							</td>
						</tr>
						<tr> <center> <label type="date" class="form-control" style="border: 0;">{{$valFecha}}</label></center></tr>
					</table>
				</footer>
				<div id="content">
					<div class="panel panel-primary">
						<div class="panel-heading">
							<h3 class="panel-title">Incidencias resueltas</h3>
						</div>
						<div class="panel-body">
							<table class="table table-bordered">
								<thead>
									<tr bgcolor="#CCCCFF">
										<th>Código</th>
										<th>Cliente</th>
										<th>soporte</th>
										<th>Severidad</th>
										<th>Estado</th>
										<th>Fecha creación</th>
										<th>Descripcion</th>
									</tr>
								</thead>
								<tbody id="dashboard_my_incidents">
									<!-- severity_full se encuentrs en el modelo y permite obtener el nombre completo de la severidad de la asignacion-->
									@foreach ($my_results as $incident)
									<tr >
										<td>{{ $incident->id }}</td>
										<td>{{$incident->client->rdbtnombre.' '.$incident->client->rdbtapellido}}</td>
										<td>{{$incident->support->rdbtnombre.' '.$incident->support->rdbtapellido}}
											<td>{{ $incident->severity_full }}</td>
											<td>{{ $incident->state }}</td>
											<td>{{ $incident->created_at }}</td>
											<td>{{ $incident->title_long }}</td>
										</tr>
										@endforeach

									</tbody>
								</table>
							</div>
						</div>
						clientes asignado a soporte: {{$contar}}
						<br>
						<br>
							<div class="panel panel-primary">
						<div class="panel-heading">
							<h3 class="panel-title">Incidencias asignadas a Soporte</h3>
						</div>
						<div class="panel-body">
							<table class="table table-bordered">
								<thead>
									<tr bgcolor="#CCCCFF">
										<th>Código</th>
										<th>Cliente</th>
										<th>soporte</th>
										<th>Severidad</th>
										<th>Estado</th>
										<th>Fecha creación</th>
										<th>Descripcion</th>
									</tr>
								</thead>
								<tbody id="dashboard_my_incidents">
									<!-- severity_full se encuentrs en el modelo y permite obtener el nombre completo de la severidad de la asignacion-->
									@foreach ($my_incidents as $incident)
									<tr>
										<td>{{ $incident->id }}</td>
										<td>{{$incident->client->rdbtnombre.' '.$incident->client->rdbtapellido}}</td>
										<td>{{$incident->support->rdbtnombre.' '.$incident->support->rdbtapellido}}
											<td>{{ $incident->severity_full }}</td>
											<td>{{ $incident->state }}</td>
											<td>{{ $incident->created_at }}</td>
											<td>{{ $incident->title_long }}</td>
										</tr>
										@endforeach

									</tbody>
								</table>
							</div>
						</div>
						clientes asignado a soporte: {{$contar1}}
						<br>
						<br>
						<div class="panel panel-primary">
							<div class="panel-heading">
								<h3 class="panel-title">Incidencias sin asignar</h3>
							</div>

							<div class="panel-body">
								<table class="table table-bordered">
									<thead>
										<tr bgcolor="#CCCCFF">
											<th>Código</th>	
											<th>Cliente</th>
											<th>Equipo</th>
											<th>Severidad</th>
											<th>Estado</th>
											<th>Fecha creación</th>
											<th>Titulo</th>


										</tr>
									</thead>

									<tbody id="dashboard_my_incidents">
										@foreach ($pending_incidents as $incident)
										<tr>
											<td>
												<a> {{ $incident->id }}</a>
											</td>
											<td>{{$incident->client->rdbtnombre.' '.$incident->client->rdbtapellido}}</td>
											<td>{{$incident->rdbtEquipoMarca->rdbtEquipo->rdbtnombre}}</td>
											<td>{{ $incident->severity_full }}</td>
											<td>{{ $incident->state }}</td>
											<td>{{ $incident->created_at }}</td>
											<td>{{ $incident->title_long }}</td>
										</tr>
										@endforeach
									</tbody>

								</table>

							</div>

						</div>
						clientes sin asignar a soporte: {{$contar2}}
					</div>
					<html>
