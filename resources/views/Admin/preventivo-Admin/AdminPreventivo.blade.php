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
					<h3 class="panel-title">Incidencias asignadas a soporte</h3>
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
							@foreach ($my_incidents as $incidente)
							<tr>
								<td>
									<a href="/ver/{{ $incidente->id }}/Admin" >
										{{ $incidente->id }}
									</a>
								</td>
								
								<td>{{$incidente->client->rdbtnombre." ".$incidente->client->rdbtapellido}}</td>
								<td>{{ $incidente->rdbtequipo->rdbtnombre }}</td>
								<td>{{ $incidente->rdbtmarca->rdbtnombre }}</td>
								<td>{{ $incidente->rdbtmodelo->rdbtnombre }}</td>
								<td>{{ $incidente->rdbtserie }}</td>
								<td>{{ $incidente->created_at }}</td>
								<td>{{$incidente->rdbtFechaPrevencion}}</td>
								<td>
									{{ $incidente->support_id ? $incidente->support->rdbtnombre." ".$incidente->support->rdbtapellido : 'Sin asignar' }}
								</td>
							</tr>
							@endforeach
							
						</tbody>
					</table>
				</div>
			</div>

			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">Incidencias sin asignar</h3>
				</div>
				<div class="panel-body">
					<table class="table table-bordered">
						<thead>
							<tr>
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
								@foreach ($pending_incidents as $incident)
								<tr>
									<td>
										<a href="/ver/{{ $incident->id }}/Admin" >
											{{ $incident->id }}
										</a>
									</td>


									<td>{{$incident->client->rdbtnombre." ".$incident->client->rdbtapellido}}</td>
									<td>{{ $incident->rdbtequipo->rdbtnombre }}</td>
									<td>{{ $incident->rdbtmarca->rdbtnombre }}</td>
									<td>{{ $incident->rdbtmodelo->rdbtnombre }}</td>
									<td>{{ $incident->rdbtserie }}</td>
									<td>{{ $incident->created_at }}</td>
									<td>{{$incident->rdbtFechaPrevencion}}</td>
									<td>
										<button type="button" class="btn btn-sm btn-success" data-toggle='modal' data-target="#myModal{{$incident->id}}" title="Atender">
										ATENDER
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
