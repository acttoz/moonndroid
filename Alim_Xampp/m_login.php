<?
session_start();
// 세션시작입니다. 항상젤위에 있어야합니다,,
?>
<!DOCTYPE html>
<html lang="ko">
	<head>
		<?
		include_once ('./framework.php');
		?>
		  <link href="css/mobile.css" rel="stylesheet" type="text/css">
		  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
      <script src="//code.jquery.com/jquery-1.10.2.js"></script>
      <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
	</head>

	<body id="home">
		  <header id="header">
         <logo style="left:0px" >
            <img style="height:18px;width:121px;" src="./img/logo.png"> 
         </logo>
         </div>
      </header>
		<div id="wrapper">
			 
			<br/>
			<div id="content">
				<form class="form-horizontal" id="margin" name="select_school" method="post">
				 
				<div class="form-group">
					<label for="inputEmail3" class="col-sm-2 control-label">아이디</label>
					<div class="col-sm-10">
						<input type="email" class="form-control" name="user_id" id="user_id" checked="0" placeholder="비밀번호 재발급에 이용되므로 사용중인 이메일을 입력하세요.">
					</div>
					 
				</div>

				<div class="form-group">
					<label for="inputPassword3" class="col-sm-2 control-label">비밀번호</label>
					<div class="col-sm-10">
						<input type="password" class="form-control" id="user_pass" placeholder="비밀번호">
					</div>
				</div>
			 
				<div class="form-group">
					<div class="col-sm-2">
				  <input type="checkbox" id="login_save">
                     자동 로그인 
                     </div>
					<div class="col-sm-2">
						<button type="button" id="search_button" class="btn btn-info form-control" onclick="fnSign();return false;">
							로그인
						</button>
					</div>
				</div>
				<div class="form-group">
					 
					<div class="col-sm-2">
						<a href="sign_class.php" class="btn btn-success form-control">회원가입</a>
					</div>
			</form>
			</div>
			<footer><?php
			include_once ('./footer.php');
		?></footer>
		<div id="dialog-confirm" title="알림" style="display:none;"><?php
		include_once ('./index_notice.php');
            ?></div>
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
