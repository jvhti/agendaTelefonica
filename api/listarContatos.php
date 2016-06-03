<?php
	include "cfg/conexao.php";
	$sql="select * from contact where idContact;";
	$resultado = mysql_query($sql);
	echo"<table border='5'>
		<tr>
			<td>Nome</td>
			<td>Sobrenome</td>
			<td>Email</td>
			<td>user Email</td>

		</tr>
		";
				
	while ($linha = mysql_fetch_array($resultado)){	
		echo"<tr>";
		echo "<td>".$linha['name']."</td>";
		echo "<td>".$linha['lastName']."</td>";
		echo "<td>".$linha['email']."</td>";
		echo "<td>".$linha['User_email']."</td>";
	}
	echo"</table>";
?>	
