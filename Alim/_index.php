<?
session_start();
// 세션시작입니다. 항상젤위에 있어야합니다,,
?>
<!DOCTYPE html>
<html lang="ko">
	<head><?
		include_once ('./framework.php');
		?></head>
	<body>
		<script type="text/javascript">
			var mUserid = localStorage.getItem("ID");
			var mUserPass = localStorage.getItem("PASS");
			if (mUserid != null && mUserPass != null) {
				fnSign();
			} else {
				location.replace("http://alim.dothome.co.kr/login.php");
			}

			function fnSign() {

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
							document.location.href = "today.php";
						} else {
							if (window.confirm("로그인을 다시 해주세요.")) {
								document.location.href = "login.php";
							}

						}
					}
				});

			}// end function fnLogin()
		</script>
	</body>
</html>