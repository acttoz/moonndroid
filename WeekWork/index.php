<!DOCTYPE html>
<html lang="ko">

	<?php
	include_once ('./config.php');
	?>

	<head>

		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">

		<title>WeekWork</title>

		<?php
		include_once ('./framework.php');
		?>

		
	</head>

	<body>
		<?php
		// include_once ('./header.php');
		?>
		<div id="wrapper">

			<!-- Sidebar -->
			<div id="sidebar-wrapper">
				<ul class="sidebar-nav">
					<li class="sidebar-brand">
						<a >계정 </a>
					</li>
					<li >
						<a href="#">수정 </a>
					</li>
					<li >
						<a href="#">로그아웃 </a>
					</li>
					<hr>
					<li class="sidebar-brand">
						<a >채널 </a>
					</li>
					<li>
						<a href="#">전체보기</a>
					</li>
					<li>
						<a href="#">학교</a>
					</li>
					<li>
						<a href="#">4학년</a>
					</li>
					<li>
						<a href="#">정보부</a>
					</li>
					<li>
						<a href="#">채널+</a>
					</li>
					<hr>
					<li>
						<a href="#">초대</a>
					</li>

				</ul>
			</div>
			<!-- /#sidebar-wrapper -->
			<a href="#menu-toggle" class="btn btn-default" id="menu-toggle">Toggle Menu</a>
			<!-- Page Content -->

			<div id="page-content-wrapper">
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-12">
							<div  id='content'  >
								<table class="time_table" align="center"  >
									<tr class="row1" style="border-radius: 10px 0 0 0; ">
										<td class="cell1" style="border-top-style:none;border-left-style:none; border-radius: 10px 0 0 0; "></td>
										<td style="border-top-style:none;">월</td>
										<td style="border-top-style:none;">화</td>
										<td style="border-top-style:none;">수</td>
										<td style="border-top-style:none;">목</td>
										<td class="cell2" style="border-top-style:none;border-right-style:none; border-radius: 0 10px 0 0;">금</td>
									</tr>
									<?php
									// test 변수들
									$channels = array("학교", "4학년", "정보부");
									$id = "acttoz";
									$$result1 = mysql_query("SELECT * FROM w_1 WHERE id='" . $_SESSION[id] . "'");
									$result2 = mysql_query("SELECT * FROM w_2 WHERE id='" . $_SESSION[id] . "'");
									$result3 = mysql_query("SELECT * FROM w_3 WHERE id='" . $_SESSION[id] . "'");
									$result4 = mysql_query("SELECT * FROM w_4 WHERE id='" . $_SESSION[id] . "'");
									$result5 = mysql_query("SELECT * FROM w_5 WHERE id='" . $_SESSION[id] . "'");
									$table = array(mysql_fetch_array($result1), mysql_fetch_array($result2), mysql_fetch_array($result3), mysql_fetch_array($result4), mysql_fetch_array($result5));

									for ($i = 0; $i < count($channels); $i++) {
										echo "<tr>";
										echo "<td style='border-left-style:none;width: 100px;background-color:#e3f3f7;'>" . $channels[$i] . "</td>";
										for ($j = 0; $j < 5; $j++) {
											echo "<td><input w='$j' t='$i' value='" . $table[$j][$i] . "'></td>";
										}
										echo "</tr>";
									}
									?>
								</table>
								<br/>
								<br/>
								<div id="margin" align="center">
									<!-- <div class="btn-group inline"> -->
									<button type="button" class="btn btn-info" style="font-size: 40px" onclick=upload()>
										저장
									</button>
								</div>
							</div>

						</div>
					</div>
				</div>
			</div>
			<!-- /#page-content-wrapper -->

		</div>
		<!-- /#wrapper -->

		<!-- Menu Toggle Script -->
		<script>
			$("#menu-toggle").click(function(e) {
				e.preventDefault();
				$("#wrapper").toggleClass("toggled");
			});
		</script>
		<?php
		include_once ("./tail.php");
		?>
	</body>

</html>
