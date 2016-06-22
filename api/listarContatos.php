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
	$sql = "SElECT Contact.name,Contact.email FROM Contact where  Contact.User_email = '$user_email' group by Contact.id";
	if ($result = mysql_query($sql)){
		$ret['return_code'] = 0;
		 
		$id = 0;
		while($r = mysql_fetch_assoc($result)){
			$linha[$id] = $r;
			++$id;
		}
		$ret["values"] = $linha;
	}else {
		$ret["error"] = mysql_error();
		$ret["error_cod"] = mysql_errno();
		$ret['return_code'] = 1;
	}
		
	echo json_encode($ret);	
?>	
