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
			var class_id = localStorage.getItem("ID");
			var class_key = localStorage.getItem("KEY");
			if (class_id != null && class_key != null) {
				 $('<form action="mobile_today.php" method="POST">' + 
    '<input type="hidden" name="platform" value=1>' +
    '<input type="hidden" name="post_id" value="'+class_id+'">' +
    '<input type="hidden" name="post_key" value="'+class_key+'">' +
    '</form>').submit();
			} else {
				location.replace("http://alim.dothome.co.kr/mobile_login.php");
			}

		</script>
	</body>
</html>
