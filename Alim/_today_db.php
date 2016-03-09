<?php
include_once ('./config.php');

///////////////////////////////////////

if ($select == "save") {

	$sql = "UPDATE member SET d5='${d5}' WHERE id='${_SESSION['id']}'";
	mysql_query($sql, $connect);
}

if ($_REQUEST['select'] == "send") {
	$groupname = htmlspecialchars($_REQUEST['d5'], ENT_QUOTES);
	$sql = "UPDATE member SET time='".date("Y-m-d H:i:s",time())."',d5='".$groupname."',day=".$_REQUEST['day']." WHERE id='".$_SESSION['id']."'";
	mysql_query($sql, $connect);
	$log="INSERT INTO log ( id,day,school,name,grade,ban,class_key,time,field,d5 ) VALUES ( ";
		$log=$log ."'" .$_SESSION['id']."',"; 
		$log=$log ."'" .$day2."',"; 
		$log=$log ."'" .$_SESSION['school']."',"; 
		$log=$log ."'" .$_SESSION['name']."',"; 
		$log=$log ."'" .$_SESSION['grade']."',"; 
		$log=$log ."'" .$_SESSION['ban']."',"; 
		$log=$log ."'" .$_SESSION['class_key']."',"; 
		$log=$log ."'" .date("Y-m-d H:i:s",time())."',"; 
		$log=$log ."'" ."today"."',"; 
		$log=$log ."'" .$groupname."' "; 
		$log=$log . ")";
		mysql_query($log, $connect);
	
	
    echo "<script>
    
    
    if (confirm('ok')) {
					 location.replace('_today.php'); 
				};
    
    
    </script>";

	
}
///////////////////////////////////

mysql_close($connect);

///////////////////////////////////
?>