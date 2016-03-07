<?php
include_once ('./config.php');
header("Content-Type: text/html; charset=UTF-8");

$connect = mysql_connect("localhost", $DB['id'], $DB['pw']) or die("DB Connect Error!!");

mysql_query("SET NAMES 'utf8'");

$db = mysql_select_db($DB['db'], $connect) or die("DB Select Error!!");

extract($_POST);

$result = mysql_query("SELECT * FROM member WHERE id ='$user_id' AND pass='$user_pass'",$connect);

if (mysql_num_rows($result) == 1) {
		$row = mysql_fetch_assoc($result);
		$_SESSION['is_logged'] = TRUE;
		$_SESSION['id'] = $user_id;
		$_SESSION['name']=$row['name']; 
		$_SESSION['school']=$row['school'];
		$_SESSION['school_id']=$row['school_id'];
		$_SESSION['class_key']=$row['class_key'];
		$_SESSION['grade']=$row['grade'];
		$_SESSION['ban']=$row['ban'];
		echo "success";

} else {
		echo "fail"; 
}

mysql_close($connect);

?> 