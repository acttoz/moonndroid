<?php
include_once ('./config.php');

extract($_POST);
///////////////////////////////////////

if ($select == "save") {

	$sql = "UPDATE member SET d5='${d5}' WHERE id='${_SESSION['id']}'";
	mysql_query($sql, $connect);
}

if ($select == "send") {
	$day2 = (int)$day + 1;
	$groupname = htmlspecialchars($d5, ENT_QUOTES);
	$sql = "UPDATE member SET time='".date("Y-m-d H:i:s",time())."',d5='".$groupname."',day=".$day2." WHERE id='".$_SESSION['id']."'";
	mysql_query($sql, $connect);
	
	$log="INSERT INTO log ( id,school,name,grade,ban,class_key,time,field,d5 ) VALUES ( ";
		$log=$log ."'" .$_SESSION['id']."',"; 
		$log=$log ."'" .$_SESSION['school']."',"; 
		$log=$log ."'" .$_SESSION['name']."',"; 
		$log=$log ."'" .$_SESSION['grade']."',"; 
		$log=$log ."'" .$_SESSION['ban']."',"; 
		$log=$log ."'" .$_SESSION['class_key']."',"; 
		$log=$log ."'" .date("Y-m-d H:i:s",time())."',"; 
		$log=$log ."'" ."today"."',"; 
		$log=$log ."'" .$d5."' "; 
		$log=$log . ")";
		mysql_query($log, $connect);
	
	
}
///////////////////////////////////

mysql_close($connect);

///////////////////////////////////
?>