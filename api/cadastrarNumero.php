<?php
	include "cfg/conexao.php";
	
	$ret = array("error"=>null, "error_cod"=>null, "return_code"=>0);
	session_start();
	if(!(isset($_SESSION['email']) && $_SESSION['email'] != "")){
		$ret['return_code'] = 2;
		echo json_encode($ret);	
		return;
	}
	
	$user_email = $_SESSION['email'];
	
	$numeros = json_decode($_GET['numeros'], true);
	$id = $_GET['id'];
	$editar = isset($_GET['editar']) ? $_GET['editar'] : false;
	
	$sql = "select * from Contact where id = $id and User_email = '$user_email';";
	$r = mysql_query($sql);
	if (!$r){
			$ret["error"] = mysql_error();
			$ret["error_cod"] = mysql_errno();
			$ret['return_code'] = 1;
			echo json_encode($ret);
			die();
	}
	if(mysql_num_rows($r) == 0){
		$ret['return_code'] = 3;
		echo json_encode($ret);
		die();
	}

	$ret['editar'] = $editar;
	foreach ($numeros as $numero) {
		if($editar && $numero['id'] != "-1")
			$sql="update phone set phoneNumber = '".$numero['phone']."' where Contact_id = $id and id = ".$numero['id'].";";
		else
			$sql="insert into phone(phoneNumber, Contact_id) value('".$numero['phone']."', $id);";

		if (!mysql_query($sql)){
			$ret["error"] = mysql_error();
			$ret["error_cod"] = mysql_errno();
			$ret['return_code'] = 1;
			echo json_encode($ret);
			die();
		}
	}
	echo json_encode($ret);	
?>