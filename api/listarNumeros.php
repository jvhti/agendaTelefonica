<?php
	header('Content-Type: application/json');
	include "cfg/conexao.php";
	
	$ret = array("error"=>null, "error_cod"=>null, "return_code"=>null);
	session_start();
	if(!(isset($_SESSION['email']) && $_SESSION['email'] != "")){
		$ret['return_code'] = 2;
		echo json_encode($ret);	
	}
	if(isset($_GET["idContact"])){

	$sql="select * from phone where Contact_id = $idContact;";
				
		if ($result = mysql_query($sql)){
			$ret['return_code'] = 0;
			while ($line = mysql_fetch_assoc($result)) {
				$ret[] = $line;
			}
		}else {
			$ret["error"] = mysql_error();
			$ret["error_cod"] = mysql_errno();
			$ret['return_code'] = 1;
		}
		echo json_encode($ret);
	}else{
		echo json_encode($ret);
	}
?>	