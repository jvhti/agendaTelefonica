<?php
	header('Content-Type: application/json');
	include "cfg/conexao.php";
	
	$ret = array("error"=>null, "error_cod"=>null, "return_code"=>null);
	session_start();
	if(!(isset($_SESSION['email']) && $_SESSION['email'] != "")){
		$ret['return_code'] = 2;
		echo json_encode($ret);	
		exit('over');
	}
	$user_email = $_SESSION['email'];
	$sql = "SElECT Contact.name,Contact.email, phone.phoneNumber 
	        FROM Contact LEFT JOIN phone ON Contact.id = phone.Contact_id 
	        WHERE Contact.User_email = '$user_email' 
	        GROUP BY Contact.id";
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
?>	
