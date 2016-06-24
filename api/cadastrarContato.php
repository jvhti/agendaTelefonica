<?php
	header('Content-Type: application/json');
	include "cfg/conexao.php";
	include "cfg/upload.php";
	
	$ret = array("error"=>null, "error_cod"=>null, "return_code"=>null);
	session_start();
	if(!(isset($_SESSION['email']) && $_SESSION['email'] != "")){
		$ret['return_code'] = 2;
		echo json_encode($ret);	
		return;
	}
	$user_email = $_SESSION['email'];
	
	$func = $_POST['function'];
	$nome = $_POST['name'];
	$sobrenome = $_POST['sobrenome'];
	$email = $_POST['email'];
	$estado = $_POST['estado'];
	$cidade = $_POST['cidade'];
	$endereco = $_POST['endereco'];
	$bairro = $_POST['bairro'];
	$notas = $_POST['notas'];
	$telefones = $_POST['telefones'];
	$foto = $_FILES['foto']['name'];
	
	$id = isset($_POST['id']) ? $_POST['id'] : -1;
	if($func == "updateContact" && $id != -1){
		$sql = "SELECT photo FROM Contact where id = $id and User_email = '$user_email';";
		$r = mysql_query($sql);
		if(!$r){
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
		
		$r = mysql_fetch_array($r);
		if( !isset( $_FILES[ 'foto' ][ 'name' ] ) || $_FILES[ 'foto' ][ 'error' ] != 0 ){
			$photo = $r['photo' ];
		}
	}else if($func == "updateContact" && $id == -1){
		$ret['return_code'] = 3;	
		echo json_encode($ret);	
		die();
	}
	
	if ( isset( $_FILES[ 'foto' ][ 'name' ] ) && $_FILES[ 'foto' ][ 'error' ] == 0 ) {
		$arquivo_tmp = $_FILES[ 'foto' ][ 'tmp_name' ];
	    $arquivo_nome = $_FILES[ 'foto' ][ 'name' ];
	    
	    $extensao = pathinfo ( $arquivo_nome, PATHINFO_EXTENSION );
	 
	    $extensao = strtolower ( $extensao );
	 
	    if ( strstr ( $profile_formats , $extensao ) ) {
	        $novoNome = uniqid ( time () ).'.'.$extensao;
	        $destino = $_SERVER['DOCUMENT_ROOT'] . $profile_path . basename($novoNome);
	 
	        if ( @move_uploaded_file ( $arquivo_tmp, $destino ) ) {
	        	$foto = $novoNome;
	        }
	        else{
	        	$ret["error"] = 5;
	        	$foto = "";
	        }
	            
	    }
	    else{
	        $ret["error"] = 4;
	        $foto = "";
	    }
	}
	
	if($func == "saveContact"){
		$sql="insert into Contact(name, lastName, email, photo, city, state, address, neighborhood, notes, User_email) value('$nome', '$sobrenome', '$email', '$foto', '$cidade', '$estado', '$endereco', '$bairro', '$notas', '$user_email');";
	}else if($func == "updateContact"){
		$sql = "update Contact set name = '$nome', lastName = '$sobrenome', email = '$email', photo = '$foto', city = '$cidade', state = '$estado', address = '$endereco', neighborhood= '$bairro', notes = '$notas' where id = $id";
	}
	if (mysql_query($sql)){
		$ret['return_code'] = 0;
		$ret['insert_id'] = $func == "saveContact" ? mysql_insert_id() : $id;
	}else {
		$ret['sql'] = $sql;
		$ret["error"] = mysql_error();
		$ret["error_cod"] = mysql_errno();
		$ret['return_code'] = 1;
	}
	
	
		
	echo json_encode($ret);	
?>