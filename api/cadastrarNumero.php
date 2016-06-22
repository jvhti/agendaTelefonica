<?php
	header('Content-Type: application/json');
	include "cfg/conexao.php";
	
	$ret = array("error"=>null, "error_cod"=>null, "return_code"=>null);
	session_start();
	if(!(isset($_SESSION['email']) && $_SESSION['email'] != "")){
		$ret['return_code'] = 2;
		echo json_encode($ret);	
		return;
	}
	
	$user_email = $_SESSION['email'];
	
	$numeros = json_decode($_GET['numeros']);
	$id = $_GET['id'];

	foreach ($numeros as $numero) {
		$sql="insert into phone(phoneNumber, Contact_id) value('$numero', $id);";
		if (!mysql_query($sql)){
			$ret["error"] = mysql_error();
			$ret["error_cod"] = mysql_errno();
			$ret['return_code'] = 1;
			echo json_encode($ret);
			die();
		}
	}
	
/*	$sql="insert into Contact(name, lastName, email, photo, city, state, address, neighborhood, notes, User_email) value('$nome', '$sobrenome', '$email', '$foto', '$cidade', '$estado', '$endereco', '$bairro', '$notas', '$user_email');";
	if (mysql_query($sql)){
		$ret['return_code'] = 0;
		$ret['insert_id'] = mysql_insert_id();
	}else {
		$ret["error"] = mysql_error();
		$ret["error_cod"] = mysql_errno();
		$ret['return_code'] = 1;
	}
		*/
	echo json_encode($ret);	
?>