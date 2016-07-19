<?
session_start();
// 세션시작입니다. 항상젤위에 있어야합니다,,
$mobileKeyWords = array('iPhone', 'iPod', 'BlackBerry', 'Android', 'Windows CE', 'Windows CE;', 'LG', 'MOT', 'SAMSUNG', 'SonyEricsson', 'Mobile', 'Symbian', 'Opera Mobi', 'Opera Mini', 'IEmobile');
for ($i = 0; $i < count($mobileKeyWords); $i++) {
    if (strpos($_SERVER['HTTP_USER_AGENT'], $mobileKeyWords[$i]) == true) {
        header("Location: mobile.php");
        exit ;
    }
}

?>

<!DOCTYPE html>
<html lang="ko">
    <head>
        <meta http-equiv='Content-Type' content='text/html' charset='utf-8'>
        <title>위크워크</title>
        <meta name="description" content="초등학교,동학년,업무처리,교육활동안내,업무추진점검,파일취합,실시간소통,공유,협업">
        <meta property="og:type" content="website">
        <meta property="og:title" content="위크워크">
        <meta property="og:url" content="http://weekwork.net">
        <meta property="og:description" content="초등학교,동학년,업무처리,교육활동안내,업무추진점검,파일취합,실시간소통,공유,협업">
        
        <meta property="og:type" content="website">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name= "viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0,maximum-scale=1.0, user-scalable=no" />
<meta name="naver-site-verification" content="fe88362d34768c8598b16ffe125f2d83afff00c1"/>
<script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>

    </head>
    <body id="home">
        
        
        <script type="text/javascript">
            var mUserid = localStorage.getItem("ID");
            var mUserPass = localStorage.getItem("PASS");
            if (mUserid != null && mUserPass != null) {
                AutoLogin();
            } else {
                document.location.href = "login.php";
            }
            /*****
             *    로그인 함수 예제
             *****/

            function AutoLogin() {
                    $.ajax({
                        url : "db.php",
                        type : 'POST',
                        cache : false,
                        data : {
                            select : "login",
                            user_id : mUserid,
                            user_pass : mUserPass
                        },
                        success : function(args) {
                            if (args == "success") {
                                document.location.href = "week.php";
                            } else {
                                alert("아이디나 비밀번호가 맞지 않습니다.");
                                 document.location.href = "login.php";
                            }
                        }
                    });

            }// end function fnLogin()


           
 

        </script>
    </body>
</html>
