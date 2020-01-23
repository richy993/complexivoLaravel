$(function(){
	alert('holi');
	$('[data-equipo]').on('click',editEquipoModal);

});

function editEquipoModal()
{
	//id
	var equipo_id=$(this).data('rdbtEquipo');

	$('#equipo_id').val(equipo_id);

// name
var rdbtnombre=$(this).parent().prev().text();

$('#rdbtnombre').val(rdbtnombre);
//descripcion
var rdbtdescripcion=$(this).parent().prev().text();

$('#rdbtdescripcion').val(rdbtdescripcion);
	//show
	$('#modalEditEquipo').modal('show');
}


var Mostrar=function(id)
{
	var route="{{url(equipo)}}/"+id+"/edit";
	$.get(route,function(data){
		//$("#id").val(data.id);
		//$("#rdbtnombre").val(data.rdbtnombre);
		//$("#rdbtdescripcion").val(data.rdbtdescripcion);
		alert(id);
	});
}