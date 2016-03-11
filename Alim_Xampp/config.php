<?php
session_start();
error_reporting(0);
// 세션시작입니다. 항상젤위에 있어야합니다,,
$DB['host'] = 'localhost';
$DB['db'] = 'alim';
$DB['id'] = 'alim';
$DB['pw'] = '0453acac';

header("Content-Type: text/html; charset=UTF-8");

$connect = mysql_connect("localhost", $DB['id'], $DB['pw']) or die("DB Connect Error!!");

mysql_query("SET NAMES 'utf8'");

$db = mysql_select_db($DB['db'], $connect) or die("DB Select Error!!");


// $_SESSION['id'] = 'aa';
?>
