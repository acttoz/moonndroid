<?php
include_once ('./config.php');

extract($_POST);
///////////////////////////////////////

	$sql = "UPDATE help SET checked=1 WHERE id LIKE '${id}'";
	mysql_query($sql, $connect);
	
///////////////////////////////////

mysql_close($connect);
header('Location: ./_admin.php');
///////////////////////////////////
?>