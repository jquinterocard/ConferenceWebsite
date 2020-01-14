<?php 

require_once 'funciones/funciones.php'; 
$nombre_evento = isset($_POST['nombre_evento'])?$_POST['nombre_evento']:false;
$categoria_evento = isset($_POST['categoria_evento'])?$_POST['categoria_evento']:false;
$fecha_evento = isset($_POST['fecha_evento'])?$_POST['fecha_evento']:false;
$hora_evento = isset($_POST['hora_evento'])?$_POST['hora_evento']:false;
$invitado_evento = isset($_POST['invitado_evento'])?(int) $_POST['invitado_evento']:false;
$id_registro = isset($_POST['id_registro'])?$_POST['id_registro']:false;
$fecha_formateada = date('Y-m-d',strtotime($fecha_evento));
$hora_formateada = date('H:i',strtotime($hora_evento));



if(isset($_POST['registro']) && $_POST['registro']=='nuevo'){
	
	try {
		$stmt = $conn->prepare("INSERT INTO eventos (nombre_evento,fecha_evento,hora_evento,id_categoria,id_invitado) VALUES(?,?,?,?,?)");
		$stmt->bind_param("sssii",$nombre_evento,$fecha_formateada,$hora_formateada,$categoria_evento,$invitado_evento);
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
	
	try {
		$stmt = $conn->prepare("UPDATE eventos SET nombre_evento=?,fecha_evento=?,hora_evento=?,id_categoria=?,id_invitado=?,editado=NOW() WHERE id_evento=?");
		$stmt->bind_param('sssiii',$nombre_evento,$fecha_formateada,$hora_formateada,$categoria_evento,$invitado_evento,$id_registro);
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
	$id_borrar = $_POST['id'];
	
	try {
		
		$stmt = $conn->prepare('DELETE FROM eventos WHERE id_evento=?');
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



