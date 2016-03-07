<?php
include_once ('./config.php');
 
extract($_POST);
///////////////////////////////////////
if($_REQUEST[select]=="delete"){
$sql = "DELETE FROM help WHERE id LIKE '${_REQUEST[id]}';";
mysql_query($sql, $connect);
}
///////////////////////////////////
///////////////////////////////////////
if($select=="commit"){
 $time=date("Y-m-d"); 
$sql = "Insert Into help (mail,content,date) VALUES ('${_SESSION['id']}','$content','".$time."')";
mysql_query($sql, $connect);
}
///////////////////////////////////

mysql_close($connect);
Header("Location:./help.php"); 
///////////////////////////////////
?>