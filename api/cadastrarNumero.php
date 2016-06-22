<?php		
	include "cfg/conexao.php";
	$idPhone = $_POST['idPhone'];
	$phoneNumber = $_POST['phoneNumber'];
	$idcontact = $_POST['idContact'];
	$sql="insert into phone (phoneNumber,Contact_id) values ('$phoneNumber','$idcontact');";
	if (mysql_query($sql)) {
		echo "cadastrada com sucesso #25";
	}
	else {
		echo "Erro ao inserir dados #0".mysql_error();
	}	
?>