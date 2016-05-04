<?php
include_once ('./config.php');

///////////////////////////////////////

	$sql = "DELETE FROM member WHERE id='${_SESSION['id']}'";
	mysql_query($sql, $connect);
	
///////////////////////////////////


Header("Location:./logout.php"); 
///////////////////////////////////
?>