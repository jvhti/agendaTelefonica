 <?php
	include "cfg/conexao.php";
	$id = $_GET['idContact'];
	$delete = "delete from contact where idContact = $id";
	mysql_query($delete) or die(mysql_error());
?>