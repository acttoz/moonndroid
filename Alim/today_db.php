<?php
include_once ('./config.php');

extract($_POST);
///////////////////////////////////////

if ($select == "save") {

	$sql = "UPDATE member SET d5='${d5}' WHERE id='${_SESSION['id']}'";
	mysql_query($sql, $connect);
}


if ($select == "send") {
	$day = (int)$day + 1;
$groupname = htmlspecialchars($d5, ENT_QUOTES);
	$sql = "UPDATE member SET d5='${groupname}',day=${day} WHERE id='${_SESSION['id']}'";
	mysql_query($sql, $connect);
}
///////////////////////////////////

mysql_close($connect);

///////////////////////////////////
?>