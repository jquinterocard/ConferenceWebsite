<?php 

require_once 'funciones/funciones.php'; 
$usuario = isset($_POST['usuario'])?$_POST['usuario']:false;
$nombre = isset($_POST['nombre'])?$_POST['nombre']:false;
$password = isset($_POST['password'])?$_POST['password']:false;
$nivel = isset($_POST['nivel'])?(int) $_POST['nivel']:false;
$id_registro = isset($_POST['id_registro'])?$_POST['id_registro']:false;





if(isset($_POST['registro']) && $_POST['registro']=='nuevo'){
	
	$opciones = array(
		'cost'=>12
	);
	$password_hashed = password_hash($password, PASSWORD_BCRYPT, $opciones);

	try {
		$stmt = $conn->prepare("INSERT INTO admins (usuario,nombre,password) VALUES(?,?,?)");
		$stmt->bind_param("sss",$usuario,$nombre,$password_hashed);
		$stmt->execute();
		$id_registro = $stmt->insert_id;
		if($id_registro>0){
			$respuesta = array(
				'respuesta'=>'exito',
				'id_admin'=>$id_registro
			);
			
		}else{
			$respuesta = array(
				'respuesta'=>'error'
			);
		}
		$stmt->close();
		$conn->close();
	} catch (Exception $e) {
		echo "Error: ".$e->getMessage();
	}
	echo json_encode($respuesta);
}

if(isset($_POST['registro']) && $_POST['registro']=='actualizar'){


	
	try {
		if($password){
			$opciones = array(
				'cost'=>12
			);
			$hash_password = password_hash($password,PASSWORD_BCRYPT,$opciones);
			$stmt = $conn->prepare("UPDATE admins SET usuario=?,nombre=?,password=?,editado=NOW(),nivel=? WHERE id_admin=?");
			$stmt->bind_param('sssis',$usuario,$nombre,$hash_password,$nivel,$id_registro);
		}else{
			$stmt = $conn->prepare("UPDATE admins SET usuario=?,nombre=?,editado=NOW(),nivel=? WHERE id_admin=?");
			$stmt->bind_param('ssis',$usuario,$nombre,$nivel,$id_registro);
		}
		
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
		
		$stmt = $conn->prepare('DELETE FROM admins WHERE id_admin=?');
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



