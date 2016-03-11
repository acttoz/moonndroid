<?php
include_once ('./config.php');

///////////////////////////////////////

	$sql = "DELETE FROM member WHERE id='${_SESSION['id']}'";
	mysql_query($sql, $connect);
	
///////////////////////////////////

mysql_close($connect);

Header("Location:./index.php"); 
///////////////////////////////////
?>