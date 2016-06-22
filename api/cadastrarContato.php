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
	
	$nome = $_POST['nome'];
	$sobrenome = $_POST['sobrenome'];
	$email = $_POST['email'];
	$estado = $_POST['estado'];
	$cidade = $_POST['cidade'];
	$endereco = $_POST['endereco'];
	$bairro = $_POST['bairro'];
	$notas = $_POST['notas'];
	$telefones = $_POST['telefones'];
	$foto = $_FILES['foto']['name'];
	
	if ( isset( $_FILES[ 'foto' ][ 'name' ] ) && $_FILES[ 'foto' ][ 'error' ] == 0 ) {
		$arquivo_tmp = $_FILES[ 'foto' ][ 'tmp_name' ];
	    $arquivo_nome = $_FILES[ 'foto' ][ 'name' ];
	    
	    $extensao = pathinfo ( $arquivo_nome, PATHINFO_EXTENSION );
	 
	    $extensao = strtolower ( $extensao );
	 
	    if ( strstr ( '.jpg;.jpeg;.gif;.png', $extensao ) ) {
	        $novoNome = uniqid ( time () );
	        $destino = $_SERVER['DOCUMENT_ROOT'] . '/imagens/' . basename($novoNome);
	 
	        if ( @move_uploaded_file ( $arquivo_tmp, $destino ) ) {
	        	$foto = $novoNome;
	        }
	        else{
	        	$ret["error"] = 5;
	        	$ret["image_error"] ="Não foi possivel mover $arquivo_tmp para $destino";
	        	$foto = "";
	        }
	            
	    }
	    else{
	        $ret["error"] = 4;
	        $foto = "";
	    }
	}
	
	$sql="insert into Contact(name, lastName, email, photo, city, state, address, neighborhood, notes, User_email) value('$nome', '$sobrenome', '$email', '$foto', '$cidade', '$estado', '$endereco', '$bairro', '$notas', '$user_email');";
	if (mysql_query($sql)){
		$ret['return_code'] = 0;
		$ret['insert_id'] = mysql_insert_id();
	}else {
		$ret["error"] = mysql_error();
		$ret["error_cod"] = mysql_errno();
		$ret['return_code'] = 1;
	}
	
	
		
	echo json_encode($ret);	
?>