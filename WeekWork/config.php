<?php
if (PHP_VERSION >= '5.1.0') {
    //if (function_exists("date_default_timezone_set")) date_default_timezone_set("Asia/Seoul");
    date_default_timezone_set("Asia/Seoul");
}

define('IMG-DIR',      'img');
define('FRAME-DIR',      'framework');


session_start();
// error_reporting(0);
$_SESSION['is_logged'] = TRUE;
$_SESSION['id'] = "acttoz";
$_SESSION['school'] = 1;
$_SESSION['name'] = "문병무";
$_SESSION['ch1'] = 1;
$_SESSION['ch2'] = 2;
$_SESSION['ch3'] = null;
$_SESSION['ch4'] = null;
$_SESSION['ch5'] = null;
// 세션시작입니다. 항상젤위에 있어야합니다,,
$DB['host'] = 'localhost';
$DB['db'] = 'weekwork';
$DB['id'] = 'weekwork';
$DB['pw'] = '0453acac';

header("Content-Type: text/html; charset=UTF-8");

$connect = mysql_connect("localhost", $DB['id'], $DB['pw']) or die("DB Connect Error!!");

mysql_query("SET NAMES 'utf8'");

$db = mysql_select_db($DB['db'], $connect) or die("DB Select Error!!");

$result1 = mysql_query("SELECT user_id FROM account");

$row = mysql_fetch_array($result1);
echo($row[0]);
mysql_close($connect);
// $_SESSION['id'] = 'aa';
?>
