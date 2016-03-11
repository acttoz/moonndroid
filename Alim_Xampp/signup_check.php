<?php
include_once ('./config.php');
header("Content-Type: text/html; charset=UTF-8");

$connect = mysql_connect("localhost", $DB['id'], $DB['pw']) or die("DB Connect Error!!");

mysql_query("SET NAMES 'utf8'");

$db = mysql_select_db($DB['db'], $connect) or die("DB Select Error!!");

extract($_POST);

$query = mysql_query("SELECT * FROM member WHERE id ='" . $user_id . "'", $connect);

if (mysql_num_rows($query) == 0) {
		$sql = "INSERT INTO member ( id ) VALUES ( '".$user_id."')";
		mysql_query($sql, $connect);
		$_SESSION['id'] = $user_id;
		mysql_query("INSERT INTO w_1 ( id ) VALUES ( '".$user_id."')", $connect);
		mysql_query("INSERT INTO w_2 ( id ) VALUES ( '".$user_id."')", $connect);
		mysql_query("INSERT INTO w_3 ( id ) VALUES ( '".$user_id."')", $connect);
		mysql_query("INSERT INTO w_4 ( id ) VALUES ( '".$user_id."')", $connect);
		mysql_query("INSERT INTO w_5 ( id ) VALUES ( '".$user_id."')", $connect);
		echo "success";

} else {
		echo "fail"; 
}

mysql_close($connect);

?>