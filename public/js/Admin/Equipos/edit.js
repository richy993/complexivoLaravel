$(function(){

	//lamar el id de los select
	$('#select-marca').on('change',onSelectMarcaChange);
$('#select-marca1').on('change',onSelectMarca1Change);

$('#select-modelo').on('change',onSelectModeloChange);

});

function onSelectMarcaChange(){
	var marca_id=$(this).val();

//si no se selecciona en el select no se seleccionara el modelo
	if(!marca_id)
		$('#select-modelo').html('<option value="">Seleccione el modelo</option>');

	$.get('/api/marca/'+marca_id+'/modelos', function (data) {
		var html_select='<option value="">Seleccione el modelo</option>';
		for(var i=0;i<data.length;++i)
			html_select+='<option value="'+data[i].id+'">'+data[i].rdbtnombre+'</option>'
	//	console.log(html_select);
	//aqui se seleccionara en donde va la informacion en el otro select
		$('#select-modelo').html(html_select);
});

}
function onSelectMarca1Change(){
	var marca_id=$(this).val();

//si no se selecciona en el select no se seleccionara el modelo
	if(!marca_id)
		$('#select-modelo1').html('<option value="">Seleccione el modelo</option>');

	$.get('/api/marca/'+marca_id+'/modelos1', function (data) {
		var html_select='<option value="">Seleccione el modelo</option>';
		for(var i=0;i<data.length;++i)
			html_select+='<option value="'+data[i].id+'">'+data[i].rdbtnombre+'</option>'
	//	console.log(html_select);
	//aqui se seleccionara en donde va la informacion en el otro select
		$('#select-modelo1').html(html_select);
});

}

function onSelectModeloChange(){
	var modelo_id=$(this).val();


$.get('/api/modelo/'+modelo_id+'/series',function(data){
	   var html_select='<option value="">Seleccione la serie del equipo</option>';
for(var i=0;i<data.length;++i)
	
	 html_select+='<option value="'+data[i].id+'">'+data[i].rdbtnombre+'</option>'
	$('#select-serie').html(html_select);
});
}