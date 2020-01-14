<?php 

require_once 'funciones/funciones.php'; 

$nombre_invitado = isset($_POST['nombre_invitado'])?$_POST['nombre_invitado']:false;
$apellido_invitado = isset($_POST['apellido_invitado'])?$_POST['apellido_invitado']:false;
$biografia_invitado = isset($_POST['biografia_invitado'])?$_POST['biografia_invitado']:false;
$id_registro = isset($_POST['id_registro'])?$_POST['id_registro']:false;



if(isset($_POST['registro']) && $_POST['registro']=='nuevo'){
	// $respuesta = array(
	// 	'post'=>$_POST,
	// 	'file'=>$_FILES acceso a files desde php
	// );
	// die(json_encode($respuesta));

	$directorio = '../img/invitados/';
	if(!is_dir($directorio)){
		mkdir($directorio,0755,true);
	}

	if(move_uploaded_file($_FILES['imagen_invitado']['tmp_name'],$directorio.$_FILES['imagen_invitado']['name'])){
		$imagen_url = $_FILES['imagen_invitado']['name'];
		$imagen_resultado =  " Se subio correctamente";
	}else{
		$respuesta = array(
			'respuesta'=>error_get_last()
		);
	}

	try {
		$stmt = $conn->prepare("INSERT INTO invitados (nombre_invitado,apellido_invitado,descripcion,url_imagen) VALUES(?,?,?,?)");
		$stmt->bind_param("ssss",$nombre_invitado,$apellido_invitado,$biografia_invitado,$imagen_url);
		$stmt->execute();
		$id_insertado = $stmt->insert_id;
		if($stmt->affected_rows){
			$respuesta = array(
				'respuesta'=>'exito',
				'id_insertado'=>$id_insertado,
				'resultado_imagen'=>$imagen_resultado
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

	$directorio = '../img/invitados/';
	if(!is_dir($directorio)){
		mkdir($directorio,0755,true);
	}

	if(move_uploaded_file($_FILES['imagen_invitado']['tmp_name'],$directorio.$_FILES['imagen_invitado']['name'])){
		$imagen_url = $_FILES['imagen_invitado']['name'];
		$imagen_resultado =  " Se subio correctamente";
	}else{
		$respuesta = array(
			'respuesta'=>error_get_last()
		);
	}

	try {

		if($_FILES['imagen_invitado']['size']>0){
			$stmt=$conn->prepare("UPDATE invitados SET nombre_invitado=?,apellido_invitado=?,descripcion=?,url_imagen=?,editado=NOW() WHERE id_invitado=?");
			$stmt->bind_param('ssssi',$nombre_invitado,$apellido_invitado,$biografia_invitado,$imagen_url,$id_registro);
		}else{
			$stmt=$conn->prepare("UPDATE invitados SET nombre_invitado=?,apellido_invitado=?,descripcion=?,editado=NOW() WHERE id_invitado=?");
			$stmt->bind_param('sssi',$nombre_invitado,$apellido_invitado,$biografia_invitado,$id_registro);
		}
		$estado= $stmt->execute();
		if($estado==true){
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
		$stmt = $conn->prepare('DELETE FROM invitados WHERE id_invitado=?');
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



