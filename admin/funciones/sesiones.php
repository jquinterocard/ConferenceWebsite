<?php 

// para que una redireccion en php pueda funcionar no tiene que haber nada antes de esa redireccion

function usuario_autenticado(){
	if(!revisar_usuario()){
		header('Location:login.php');
		exit();
	}
}

function revisar_usuario(){
	return isset($_SESSION['usuario']);
}

session_start();
usuario_autenticado();
