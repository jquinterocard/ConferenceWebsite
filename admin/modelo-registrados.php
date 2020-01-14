<?php 

require_once 'funciones/funciones.php';

$nombre = isset($_POST['nombre'])?$_POST['nombre']:false;
$apellido = isset($_POST['apellido'])?$_POST['apellido']:false;
$email = isset($_POST['email'])?$_POST['email']:false;



// boletos
$boletos_adquiridos = isset($_POST['boletos'])?$_POST['boletos']:false; 
// Camisas y etiquetas
$camisas =  isset($_POST['pedido_extra']['camisas']['cantidad'])?$_POST['pedido_extra']['camisas']['cantidad']:false;
$etiquetas= isset($_POST['pedido_extra']['etiquetas']['cantidad'])?$_POST['pedido_extra']['etiquetas']['cantidad']:false;


$total = isset($_POST['total_pedido'])?$_POST['total_pedido']:false;
$regalo = isset($_POST['regalo'])?$_POST['regalo']:false;


$eventos = isset($_POST['registro_eventos'])?$_POST['registro_eventos']:false;


$fecha_registro = isset($_POST['fecha_registro'])?$_POST['fecha_registro']:false;
$id_registro = isset($_POST['id_registro'])?$_POST['id_registro']:false;



if(isset($_POST['registro']) && $_POST['registro']=='nuevo'){
	$pedido = productos_json($boletos_adquiridos,$camisas,$etiquetas);
	$registro_eventos = eventos_json($eventos);
	try {
		$stmt = $conn->prepare("INSERT INTO registrados (nombre_registrado,apellido_registrado,email_registrado,fecha_registro,pases_articulos,talleres_registrados,regalo,total_pagado,pagado) VALUES(?,?,?,NOW(),?,?,?,?,1)");
		// die($conn->error);
		$stmt->bind_param("sssssis",$nombre,$apellido,$email,$pedido,$registro_eventos,$regalo,$total);
		
		$stmt->execute();
		$id_insertado = $stmt->insert_id;
		if($stmt->affected_rows){
			$respuesta = array(
				'respuesta'=>'exito',
				'id_insertado'=>$id_insertado
			);
			
		}else{
			$respuesta = array(
				'respuesta'=>'error'
			);
		}
		$stmt->close();
		$conn->close();
	} catch (Exception $e) {
		$respuesta = array(
			'respuesta'=>$e->getMessage()
		);
	}
	echo json_encode($respuesta);
}

if(isset($_POST['registro']) && $_POST['registro']=='actualizar'){
	$pedido = productos_json($boletos_adquiridos,$camisas,$etiquetas);
	$registro_eventos = eventos_json($eventos);
	try {
		$stmt = $conn->prepare("UPDATE registrados SET nombre_registrado=?,apellido_registrado=?,email_registrado=?,fecha_registro=?,pases_articulos=?,talleres_registrados=?,regalo=?,total_pagado=?,pagado=1 WHERE id_registrado=?");
		$stmt->bind_param('ssssssisi',$nombre,$apellido,$email,$fecha_registro,$pedido,$registro_eventos,$regalo,$total,$id_registro);
		$stmt->execute();
		if($stmt->affected_rows){
			$respuesta = array(
				'respuesta'=>'exito',
				'id_actualizado'=>$id_registro
			);
		}else{
			$respuesta = array(
				'respuesta'=>'error'
			);
		}
		$stmt->close();
		$conn->close();
	} catch (Exception $e) {
		$respuesta = array(
			'respuesta'=>$e->getMessage()
		);
	}
	die(json_encode($respuesta));
}


if(isset($_POST['registro']) && $_POST['registro']=='eliminar'){
	die(json_encode($_POST));
	$id_borrar = $_POST['id'];
	try {
		
		$stmt = $conn->prepare('DELETE FROM categoria_evento WHERE id_categoria=?');
		$stmt->bind_param('i',$id_borrar);
		$stmt->execute();
		if($stmt->affected_rows){
			$respuesta = array(
				'respuesta'=>'exito',
				'id_eliminado'=>$id_borrar
			);
		}else{
			$respuesta = array(
				'respuesta'=>'error'
			);
		}
		$stmt->close();
		$conn->close();
	} catch (Exception $e) {
		$respuesta = array(
			'respuesta'=>$e->getMessage()
		);
	}
	die(json_encode($respuesta));
}



