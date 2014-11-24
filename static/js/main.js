function changeMunicipio(s, id){
	var est = $(s).find(':selected').attr('data-id');
	$.ajax({
		type: 'POST',
		url: '/user/getMunicipios',
		data: {estado:est},
		success: function(response){
			if(id != undefined){
				$("#"+id).html(response);
			}
		},
		error: function(){
			alert('Algo salio mal, selecciona tu estado de nuevo.');
		}
	});
}

