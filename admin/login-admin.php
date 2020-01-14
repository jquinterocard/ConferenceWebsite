<?php 



if(isset($_POST['login-admin'])){

	$usuario = $_POST['usuario'];
	$password = $_POST['password'];
	try {
		require_once 'funciones/funciones.php'; 
		$stmt = $conn->prepare("SELECT * FROM admins WHERE usuario=?");
		$stmt->bind_param("s",$usuario);
		$stmt->execute();
		$stmt->bind_result($id_admin,$usuario_admin,$nombre_admin,$password_admin,$editado,$nivel);	
		if($stmt->affected_rows){
			$existe = $stmt->fetch();
			if($existe){
				if(password_verify($password,$password_admin)){
					session_start();
					$_SESSION['id'] = $id_admin;
					$_SESSION['usuario']=$usuario_admin;
					$_SESSION['nombre']=$nombre_admin;
					// manejar rol de usuario solo el nivel 1 puede editar otros administradores
					$_SESSION['nivel'] = $nivel; 
					$respuesta=array(
						'respuesta'=>'exitoso',
						'usuario'=>$nombre_admin
					);
				}else{
					$respuesta=array(
						'respuesta'=>'error'
					);
				}
			}else{
				$respuesta=array(
					'respuesta'=>'error'
				);
			}
		}
		$stmt->close();
		$conn->close();
	} catch (Exception $e) {
		echo "Error: ".$e->getMessage();
	}
	echo json_encode($respuesta);
}
