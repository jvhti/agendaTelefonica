<?php		
	header('Content-Type: application/json');
	include "cfg/conexao.php";
	
	$ret = array("error"=>null, "error_cod"=>null, "return_code"=>null);

	$nome = $_POST['name_cad'];
	$email = $_POST['email_cad'];
	$gender = $_POST['gender_cad'];
	$password = $_POST['password_cad'];
	$password_conf = $_POST['password_cad_conf'];

	if($password != $password_conf){
		$ret['return_code'] = 2;
		$ret['error'] = "Password confirmation is different from password.";
	}else{
		$sql="insert into User (name, email, gender, password) values ('$nome', '$email', '$gender', '$password');";
		if (mysql_query($sql)){
			$ret['return_code'] = 1;
		}else {
			$ret["error"] = mysql_error();
			$ret["error_cod"] = mysql_errno();
			$ret['return_code'] = 0;
		}
	}

	echo json_encode($ret);	
?>