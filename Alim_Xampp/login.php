<?php  
session_start();
// 세션시작입니다. 항상젤위에 있어야합니다,,
   ?>
<!DOCTYPE html>
<html lang="ko">
<head>
<?
	include_once ('./framework.php');
         ?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
</head>
<body id="home">
<div id="wrapper">
  <header id="header">
    <logo> <a href="" title="스피드알림장">스피드알림장</a> </logo>
    <nav id="mainMenu">
      <ul style="top:11px;height:100%">
        <li >
          <input style="" type="email" class="form-control" id="user_id" placeholder="이메일">
        </li>
        <li >
          <input type="password" class="form-control" id="user_pass" placeholder="Password">
        </li>
        <li style="padding-top: 5px">
          <input type="checkbox" id="login_save">
          자동 로그인 </li>
        <li  style="padding-top: 7px"> <a href="#" onclick="fnSign();return false;">로그인</a> </li>
        <li style="padding-top: 7px"> <a href="sign_class.php">회원가입</a> </li>
      </ul>
    </nav>
  </header>
  <br>
  <div id="content">
      <br>
      <IMG class="displayed" src="./img/teaser.png" style="width:800px; display: block; margin-left: auto; margin-right: auto">  </biglogo>
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
		if (localStorage.getItem("ID") != null) {
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
					url : "login_check.php",
					type : 'POST',
					cache : false,
					data : {
						user_id : mUserid,
						user_pass : mUserPass
					},
					success : function(args) {
						if (args == "success ") {

							if (document.getElementById("login_save").checked) {
								localStorage.setItem("ID", mUserid);
								localStorage.setItem("PASS", mUserPass);
							} else {

								localStorage.clear();
							}

							document.location.href = "today.php";
						} else {
							alert("이메일이나 비밀번호가 맞지 않습니다.");

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

		// $(function() {
		// $("#dialog-confirm").css("display", "block");
		// $("#dialog-confirm").scrollTop("0");
		//
		// $("#dialog-confirm").dialog({
		// resizable : false,
		// width : 800,
		// height : 540,
		// modal : true,
		//
		// buttons : {
		// "확인" : function() {
		// $(this).dialog("close");
		// }
		// },
		// open : function() {
		// $(this).scrollTop(0);
		// }
		// });
		// });
      </script>
</body>
</html>
