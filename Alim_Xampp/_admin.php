 
<!DOCTYPE html>
<html lang="ko">
	<head>
		<title>스피드 알림장</title >
		<meta http-equiv='Content-Type' content='text/html' charset='utf-8'>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name= "viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0,maximum-scale=1.0, user-scalable=no" />
		<link rel="stylesheet" href="framework/css/bootstrap.css">
		<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
		<script src="framework/js/placeholder.js"></script>
		<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
		<script src="//code.jquery.com/jquery-1.10.2.js"></script>
		<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
		<!-- Link Swiper's CSS -->
		<link rel="stylesheet" href="./framework/css/swiper.min.css">
	</head>
	<body id="home">
		<div id="wrapper">
			<div id="content">
				<div id="margin" >
					<?php
					include_once ('./config.php');

					$result = mysql_query("SELECT * FROM help WHERE checked LIKE 0;");
					while ($row = mysql_fetch_array($result)) {
					echo '<form action="_admin_db.php" method="POST">' ;
						echo '<div class="form-group">
						<input class="col-sm-1 control-label" readonly name="id" value="'.$row[id].'">
						<label class="col-sm-2 control-label">'.$row[mail].'</label>
						<p class="col-sm-7"  value="">'.$row[content].'('.$row[date].')</p>'
					.' 
					<div class="col-sm-2">
						<input style="width:100%;" type="submit" class="btn btn-info " value="삭제">
						
					</div>
				</div><br/><br/><br/><br/><br/></form>';

				}
					mysql_close($connect);
					?>
				</div>
			</div>
		</div>
		<!-- Swiper JS -->

		<!-- Initialize Swiper -->
		<script></script>
	</body>
</html>