<?php 

function validar(){
	if($_SESSION['nivel']==0){
		header('Location:admin-area.php');
	}
}


validar();

