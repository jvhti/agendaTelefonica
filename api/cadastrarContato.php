<?php		
	include "cfg/conexao.php";
	$nome = $_POST['name'];
	$sexo = $_POST['gender'];
	$email = $_POST['email'];
	$senha = $_POST['senha'];
	$photo = $_POST['photo'];
	$sql="insert into user (name,email,gender,photo,password) values ('$nome','$email','$sexo','$photo','$senha');";
	if (mysql_query($sql)) {
		echo "25";
	}
	else {
		echo "0".mysql_error();
	}
		
?>