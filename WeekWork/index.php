<!DOCTYPE html>
<html lang="ko">
    <head>
        <?
        include_once ('./framework.php');
        ?>
    </head>
    <body id="home">
        <?php
        include_once ('./header_login.php');
        ?>
        <div id="wrapper">
            <div id="content">
                
                <br>
                
                <!-- <IMG class="displayed" src=" " style="width:70%; display: block; margin-left: auto; margin-right: auto"> -->
                <IMG class="displayed" src="./img/tutorial.png" style="width:800px; display: block; margin-left: auto; margin-right: auto">
                <br>
            </div>
            <footer>
                <?php
                include_once ('./footer.php');
                ?>
            </footer>
            <div id="dialog-confirm" title="알림" style="display:none;">
                <?php
                include_once ('./index_notice.php');
                ?>
            </div>
        </div>
        <script type="text/javascript">
            if (localStorage.getItem("W_ID") != null) {
                $('#user_id').val(localStorage.getItem("ID"));
                $('#user_pass').val(localStorage.getItem("PASS"));
                document.getElementById("login_save").checked = true;
            }
            /*****
             *    로그인 함수 예제
             *****/

            function fnSign() {

                var mUserid = $("#user_id").val();
                var mUserPass = $("#user_pass").val();

                if (!mUserid) {
                    alert("이메일을 입력하세요..!!");
                    return;
                } else if (!validateEmail(mUserid)) {
                    alert("올바른 이메일을 입력하세요..!!");
                    return;
                } else if (!mUserPass) {
                    alert("비밀번호를 입력하세요..!!");
                    return;
                } else {

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

                                if (document.getElementById("login_save").checked) {
                                    localStorage.setItem("ID", mUserid);
                                    localStorage.setItem("PASS", mUserPass);
                                } else {

                                    localStorage.clear();
                                }

                                document.location.href = "week.php";
                            } else {
                                alert("아이디나 비밀번호가 맞지 않습니다.");

                            }
                        }
                    });

                }

            }// end function fnLogin()

            function validateEmail(email) {
                // var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
                // return re.test(email);
                return true;
            }


            $("#user_pass").keyup(function(event) {
                if (event.keyCode == 13) {
                    fnSign();
                }
            });

        </script>
    </body>
</html>
