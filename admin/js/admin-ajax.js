$(document).ready(function(){
	$('#guardar-registro').on('submit',function(e){
		e.preventDefault();

		var datos = $(this).serializeArray();

		$.ajax({
			type:$(this).attr('method'),
			data: datos,
			url:$(this).attr('action'),
			dataType:'json',
			success:function(data){
				var resultado = data;
				console.log(resultado);
				if(resultado.respuesta==='exito'){
					Swal.fire(
						'Correcto',
						'Se guardo correctamente',
						'success'
						);
					
				}else{
					
					Swal.fire(
						'Error!',
						'Hubo un error',
						'error'
						);
				}
			},
			error:function(e){
				console.log(e.responseText);
			} 
		});
	});

	// Eliminar un registro
	$('.borrar_registro').on('click',function(e){
		e.preventDefault();
		var id = $(this).attr('data-id');
		var tipo = $(this).attr('data-tipo');

		Swal.fire({
			title: 'Estas seguro?',
			text: "Un registro eliminado no se puede recuperar",
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Si,Eliminar!',
			cancelButtonText:'Cancelar'
		}).then((result) => {
			if (result.value) {
				$.ajax({
					type:'POST',
					data:{
						'id':id,
						'registro':'eliminar'
					},
					url:`modelo-${tipo}.php`,
					dataType:'json',
					success:function(data){
						console.log(data);
						if(data.respuesta=='exito'){
							jQuery(`[data-id=${data.id_eliminado}]`).parents('tr').remove();
							Swal.fire(
								'Eliminado!',
								'Registro Eliminado.',
								'success'
								);
						}else{
							Swal.fire(
								'Error!',
								'Ocurrio un error al eliminar el registro',
								'error'
								);
						}
						
					},
					error:function(err){
						console.log(err.responseText);
					}
				});

				
			}
		})
	});

	// se ejecuta cuando hay un archivo
	$('#guardar-registro-archivo').on('submit',function(e){
		e.preventDefault();

		var datos = new FormData(this);
		$.ajax({
			type:$(this).attr('method'),
			data: datos,
			url:$(this).attr('action'),
			dataType:'json',
			// necesario para imagenes
			contentType:false,
			processData:false,
			async:true,
			cache:false,
			success:function(data){
				var resultado = data;
				console.log(resultado);
				if(resultado.respuesta==='exito'){
					Swal.fire(
						'Correcto',
						'Se guardo correctamente',
						'success'
						);
					
				}else{
					Swal.fire(
						'Error!',
						'Hubo un error',
						'error'
						);
				}
			},
			error:function(e){
				console.log(e.responseText);
			} 
		});
	});
});
