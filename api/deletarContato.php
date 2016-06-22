 <?php
	function errorSQL($ret){
		$ret["error"] = mysql_error();
		$ret["error_cod"] = mysql_errno();
		$ret['return_code'] = 1;
		echo json_encode($ret);
		die();
	}
	
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
	
	if(!isset($_GET['cont_id']) || $_GET['cont_id'] == ""){
		$ret['return_code'] = 4;
		echo json_encode($ret);
		die();
	}
	
	$cont_id = $_GET['cont_id'];
	
	
	$sql = "select * from Contact where id = $cont_id and User_email = '$user_email';";
	$result = mysql_query($sql);
	if(!$result){
		errorSQL($ret);
		die();
	}
	
	if(mysql_num_rows($result) == 0){
		$ret['return_code'] = 3; 
		echo json_encode($ret);	
		die();
	}
	
	$sql="delete from phone where Contact_id = $cont_id;";
	if (!mysql_query($sql)){
		errorSQL($ret);
		die();
	}
	
	$sql="delete from Contact where id = $cont_id;";
	if (!mysql_query($sql)){
		errorSQL($ret);
		die();
	}
	$ret['return_code'] = 0;
	echo json_encode($ret);	
?>