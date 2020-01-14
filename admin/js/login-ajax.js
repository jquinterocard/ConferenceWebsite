$(document).ready(function(){
	$('#login-admin').on('submit',function(e){
		e.preventDefault();

		var datos = $(this).serializeArray();

		$.ajax({
			type:$(this).attr('method'),
			data: datos,
			url:$(this).attr('action'),
			dataType:'json',
			success:function(data){
				var resultado = data;
				if(resultado.respuesta==='exitoso'){
					Swal.fire(
						'Login Correcto',
						`Bienvenido(a) ${resultado.usuario}`,
						'success'
						);
					setTimeout(function() {
						window.location.href='admin-area.php';
					}, 2000);
				}else{
					Swal.fire(
						'Error!',
						'Usuario o password incorrectos',
						'error'
						);
				}
			},
			error:function(err){
				console.log(err.responseText);
			}
		});
	});

});
