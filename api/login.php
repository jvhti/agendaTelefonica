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
	
	$login = $_POST['login'];
	$senha = $_POST['senha'];
	
	$sql = "select * from User where email = '$login' and password = '$senha'";
	$resultado = mysql_query($sql);
	$linha = mysql_fetch_array($resultado);
	
	if (mysql_query($sql)){
		$ret['return_code'] = 0;
		
		$_SESSION['email'] = $email;
	}else {
		$ret["error"] = mysql_error();
		$ret["error_cod"] = mysql_errno();
		$ret['return_code'] = 1;
	}
	echo json_encode($ret);	
?>