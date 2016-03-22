<?
session_start();
error_reporting(0);
// 세션시작입니다. 항상젤위에 있어야합니다,,
?>
<!DOCTYPE html>
<html lang="ko">
	<head>
		<title>스피드 알림장 3</title >
		<meta http-equiv='Content-Type' content='text/html' charset='utf-8'>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name= "viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0,maximum-scale=1.0, user-scalable=no" />
		<link rel="stylesheet" href="framework/css/bootstrap.css">
		<link href="css/index.css" rel="stylesheet" type="text/css">
		<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	</head>

	<body id="home">
		<div id="wrapper">
			<?php
			include_once ('./header.php');
			?>

			<br/>
			<form class="form-horizontal" id="margin" name="signup_form" method="post" action="../signup_check.php">
				<div class="form-group">
					<label for="inputEmail3" class="col-sm-2 control-label"></label>
					<div class="col-sm-10">
						<label >회원가입</label>
					</div>
				</div>
				<div class="form-group">
					<label for="inputEmail3" class="col-sm-2 control-label">이메일</label>
					<div class="col-sm-10">
						<input type="email" class="form-control" name="user_id" placeholder="비밀번호 재발급에 이용되므로 사용중인 이메일을 입력하세요.">
					</div>
				</div>

				<div class="form-group">
					<label for="inputPassword3" class="col-sm-2 control-label">Password</label>
					<div class="col-sm-10">
						<input type="password" class="form-control" name="user_pass" placeholder="Password">
					</div>
				</div>
				<div class="form-group">
					<label for="inputPassword3" class="col-sm-2 control-label">re_Password</label>
					<div class="col-sm-10">
						<input type="password" class="form-control pass2" name="user_pass2" placeholder="Password">
					</div>
				</div>

				
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<button type="button" class="btn btn-info" id="submit_btn" onclick=fnSign()>
							가입하기
						</button>
					</div>
				</div>
			</form>
			<footer>
				<p>
					<br/>
					<br/>
					&copy; Copyright  by Administrator
				</p>
			</footer>
		</div>
		<script type="text/javascript">
			/*****
			 *    로그인 함수 예제
			 *****/

			function fnSign() {

				var mUserid = signup_form.user_id.value;
				var mUserPass = signup_form.user_pass.value;
				var mUserPass2 = signup_form.user_pass2.value;

				if (!mUserid) {
					alert("이메일을 입력하세요..!!");
					return;
				} else if (!validateEmail(mUserid)) {
					alert("올바른 이메일을 입력하세요..!!");
					return;
				} else if (!mUserPass) {
					alert("비밀번호를 입력하세요..!!");
					return;
				} else if (!mUserPass2) {
					alert("비밀번호 확인을 입력하세요..!!");
					return;
				} else if (mUserPass != mUserPass2) {
					alert("비밀번호가 일치하지 않습니다.");
					signup_form.user_pass2.focus();
					return;
				} else {

					$.ajax({
						url : "signup_check.php",
						type : 'POST',
						cache : false,
						data : {
							user_id : mUserid,
							user_pass : mUserPass
						},
						success : function(args) {
							
							if (trim(args) == "success") {
								alert("회원 가입이 완료되었습니다. 학급 생성으로 넘어 갑니다.");
								document.location.href = "sign_class.php";
							} else {
								alert("이미 사용" + args + "중인 이메일입니다.");
								signup_form.user_id.focus();
							}
						}
					});

				}

			}// end function fnLogin()

			function trim(str) {
				return str.replace(/(^\s*)|(\s*$)/g, "");
			}

			function validateEmail(email) {
				// var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
				// return re.test(email);
				return true;
			}


			$(".pass2").keyup(function(event) {
				if (event.keyCode == 13) {
					$("#submit_btn").click();
				}
			});
		</script>
	</body>
</html>
