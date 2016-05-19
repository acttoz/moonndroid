<?php
if (PHP_VERSION >= '5.1.0') {
    //if (function_exists("date_default_timezone_set")) date_default_timezone_set("Asia/Seoul");
    date_default_timezone_set("Asia/Seoul");
}


//==============================================================================
// SESSION 설정
//------------------------------------------------------------------------------
// ini_set("session.use_trans_sid", 0);    // PHPSESSID를 자동으로 넘기지 않음
// ini_set("url_rewriter.tags",""); // 링크에 PHPSESSID가 따라다니는것을 무력화함 (해뜰녘님께서 알려주셨습니다.)
// ini_set("session.cache_expire", 600); // 세션 캐쉬 보관시간 (분)
// ini_set("session.gc_maxlifetime", 36000); // session data의 garbage collection 존재 기간을 지정 (초)
// ini_set("session.gc_probability", 1); // session.gc_probability는 session.gc_divisor와 연계하여 gc(쓰레기 수거) 루틴의 시작 확률을 관리합니다. 기본값은 1입니다. 자세한 내용은 session.gc_divisor를 참고하십시오.
// ini_set("session.gc_divisor", 100); // session.gc_divisor는 session.gc_probability와 결합하여 각 세션 초기화 시에 gc(쓰레기 수거) 프로세스를 시작할 확률을 정의합니다. 확률은 gc_probability/gc_divisor를 사용하여 계산합니다. 즉, 1/100은 각 요청시에 GC 프로세스를 시작할 확률이 1%입니다. session.gc_divisor의 기본값은 100입니다.
// session_save_path("./tmp"); // 계정의 홈디렉토리부터 시작합니다. 
// session_set_cookie_params(0, '/');
session_start();
//==============================================================================


 



error_reporting(0);

$DB['host'] = 'localhost';
$DB['db'] = 'alim';
$DB['id'] = 'alim';
$DB['pw'] = '0453acac';

header("Content-Type: text/html; charset=UTF-8");

$connect = mysql_connect("localhost", $DB['id'], $DB['pw']) or die("DB Connect Error!!");

mysql_query("SET NAMES 'utf8'");

$db = mysql_select_db($DB['db'], $connect) or die("DB Select Error!!");



?>
