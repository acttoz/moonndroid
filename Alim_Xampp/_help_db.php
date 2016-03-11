<?php
include_once ('./config.php');

extract($_POST);
///////////////////////////////////////
$groupname = htmlspecialchars($reply, ENT_QUOTES);
$sql = "UPDATE help SET reply='${groupname}' WHERE id LIKE '${id}'";
mysql_query($sql, $connect);

///////////////////////////////////

mysql_close($connect);
header('Location: ./_help.php');
///////////////////////////////////
?>