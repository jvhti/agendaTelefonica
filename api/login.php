 <?php
	include "cfg/conexao.php";
	
	$login = $_POST['login'];
	$senha = $_POST['senha'];
	
	$sql = "select * from user where email = '$login'";
	$resultado = mysql_query($sql);
	$linha = mysql_fetch_array($resultado);
	
	if ($senha == $linha['password']) {
		session_start();
		$_SESSION['nome'] = $linha['nome'];
		$_SESSION['login'] = $linha['login']; 
	}
	else {
	}
?>
