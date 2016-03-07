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
	<form action="mobile_today.php" method="POST"> 
    <input type="hidden" name="platform" value=1>
    <?$class_id = hex2bin($_REQUEST['aa']); ?>
    <?echo '<input type="hidden" name="post_id" value="'.$class_id.'">'?>
    <?echo '<input type="hidden" name="post_key" value="'.$_REQUEST['aaa'].'">'?>
    </form>
		<script type="text/javascript">
			$('form').submit();

		</script>
	</body>
</html>
