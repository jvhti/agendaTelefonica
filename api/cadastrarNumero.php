<?php		
	include "cfg/conexao.php";
	$idPhone = $_POST['idPhone'];
	$phoneNumber = $_POST['phoneNumber'];
	$idcontact = $_POST['idContact'];
	$sql="insert into phone (phoneNumber,idPhone,Contact_idContact) values ('$phoneNumber','$idPhone','$idcontact');";
	if (mysql_query($sql)) {
		echo "cadastrada com sucesso #25";
	}
	else {
		echo "Erro ao inserir dados #0".mysql_error();
	}	
?>