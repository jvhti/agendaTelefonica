 <?php
	/**	Codigos de retorno
	 *	0 - Logado com exito
	 *  1 - Senha ou endereço invalido
	 *	2 - Já estava logado
	 */
	header('Content-Type: application/json');
	include "cfg/conexao.php";
	
	$ret = array("error"=>null, "error_cod"=>null, "return_code"=>null);
	
	session_start();
	if(isset($_SESSION['email']) && $_SESSION['email'] != ""){
		//Já está logado
		$ret['return_code'] = 2;
	}
	
	$email = $_POST['email_in'];
	$senha = $_POST['password_in'];
	
	$sql = "select * from User where email = '$email' and password = '$senha'";
	$resultado = mysql_query($sql);
	$linha = mysql_fetch_array($resultado);
	
//	$ret['comando'] = $sql;
	if ($r = mysql_query($sql)){
		if(mysql_num_rows($r) == 1){
			$ret['return_code'] = 0;
			$_SESSION['email'] = $email;
		}else{
			$ret['return_code'] = 3;
		}
	}else {
		$ret["error"] = mysql_error();
		$ret["error_cod"] = mysql_errno();
		$ret['return_code'] = 1;
	}
	echo json_encode($ret);	
?>