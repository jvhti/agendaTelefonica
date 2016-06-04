<?php
    session_start();
    session_destroy();

	$ret = array("return_code"=>0);
	echo json_encode($ret);	
?>