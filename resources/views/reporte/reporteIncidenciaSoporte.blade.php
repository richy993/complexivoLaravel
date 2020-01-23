

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
					<h3>Reporte Tecnico</h3>
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
					<table class="table table-bordered">
                <thead>
                    <tr bgcolor="#CCCCFF">
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
                    <tr bgcolor="#CCCCFF"">
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
                        <th bgcolor="#CCCCFF"">Equipo</th>
                        <td id="incident_attachment">{{$incident->rdbtEquipoMarca->rdbtEquipo->rdbtnombre.' '.$incident->rdbtEquipoMarca->rdbtMarca->rdbtnombre }}</td>
                    </tr>
                    <tr>
                        <th bgcolor="#CCCCFF"">Título</th>
                        <td id="incident_summary">{{ $incident->title }}</td>
                    </tr>
                    <tr>
                        <th bgcolor="#CCCCFF"">Descripción</th>
                        <td id="incident_description">{{ $incident->description }}</td>
                    </tr>

                </tbody>
            </table>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th bgcolor="#CCCCFF"">Detalle del equipo</th>
                    </tr>
                    <tr><td>{{strtoupper($informe->rdbtDetalle)}}</td></tr>
                    <tr>
                        <th bgcolor="#CCCCFF"">Recomendacion del equipo</th>
                    </tr>
                    <tr><td>{{strtoupper($informe->rdbtRecomendacion)}}</td></tr>

                </tbody>
            </table>

<br><br><br><br><br>
<table>
    <tbody>
         <tr><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;____________________</td><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td>_____________________</td></tr>
    <tr><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$incident->support_name}}</td><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td>{{$incident->client->rdbtnombre.' '.$incident->client->rdbtapellido}}</td></tr>
    <tr><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<center>soporte</center> </td><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td><center>cliente</center></td></tr>
    </tbody>
   
</table>
					</div>
					<html>
