 <?php
	include "cfg/conexao.php";
	$id = $_GET['idPhone'];
	$delete = "delete from phone where idPhone = $id";
	mysql_query($delete) or die(mysql_error());
?>