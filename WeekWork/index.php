<!DOCTYPE html>
<html lang="ko">
    <head>
        <meta http-equiv='Content-Type' content='text/html' charset='utf-8'>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name= "viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0,maximum-scale=1.0, user-scalable=no" />
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
