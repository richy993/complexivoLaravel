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
          
                    @endif

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
