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
    
    
    if (!alert('보내기 완료.(수정할 내용이 있는 경우, 내용을 수정하고 보내기버튼을 누르면 재전송이 가능합니다.)')) {
					 location.replace('today.php'); 
				};
    
    
    </script>";

	
}
///////////////////////////////////

mysql_close($connect);

///////////////////////////////////
?>