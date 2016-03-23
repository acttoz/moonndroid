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
		<div id="wrapper">

			<!-- Sidebar -->
			<div id="sidebar-wrapper">
				<ul class="sidebar-nav">
					<li class="sidebar-brand">
						<a href="#">계정 </a>
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

					<?php
					$sql = "SELECT ch_id,ch_name FROM channel WHERE ";
					$sql = $sql . "ch_id='" . $_SESSION['ch1'] . "'";
					$sql = $sql . " OR ch_id='" . $_SESSION['ch2'] . "'";
					$sql = $sql . " OR ch_id='" . $_SESSION['ch3'] . "'";
					$sql = $sql . " OR ch_id='" . $_SESSION['ch4'] . "'";
					$sql = $sql . " OR ch_id='" . $_SESSION['ch5'] . "'";

					$result = mysql_query($sql);
					while ($row = mysql_fetch_array($result)) {
						$ch_ids[] = $row['ch_id'];
						$ch_names[] = $row['ch_name'];
						echo "<li>                                            ";
						echo "    <a href=index.php?ch=" . $row['ch_id'] . ">" . $row['ch_name'] . "</a>";
						echo "</li>       											";
					}
					?>

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
										<td class="cell1" style="border-top-style:none;border-left-style:none; border-radius: 10px 0 0 0; "><?php
										// $monday = strtotime('monday this week');
										$monday = 1458486000;
										echo(int)date("m", $monday) . "월";
										$weeks[] = date("Y-m-d", strtotime('monday this week'));
										$weeks[] = date("Y-m-d", strtotime('tuesday this week'));
										$weeks[] = date("Y-m-d", strtotime('wednesday this week'));
										$weeks[] = date("Y-m-d", strtotime('thursday this week'));
										$weeks[] = date("Y-m-d", strtotime('friday this week'));
										?></td>
										<td style="border-top-style:none;">월(<?php echo(int)date("d", $monday); ?>) </td>
										<td style="border-top-style:none;">화(<?php echo(int)date("d", $monday) + 1; ?>) </td>
										<td style="border-top-style:none;">수(<?php echo(int)date("d", $monday) + 2; ?>) </td>
										<td style="border-top-style:none;">목(<?php echo(int)date("d", $monday) + 3; ?>) </td>
										<td class="cell2" style="border-top-style:none;border-right-style:none; border-radius: 0 10px 0 0;"> 금(<?php echo(int)date("d", $monday) + 4; ?>) </td>
									</tr>
									<?php
									// 한 채널의 work 배치(표 한줄 완성)
									$days = array_fill_keys($weeks, '');
									$result = mysql_query("SELECT * FROM day WHERE ch_id='" . $ch_ids[1] . "'");
									while ($row = mysql_fetch_array($result)) {
										unset($works);
										$works[] = $row['work1_id'];
										$works[] = $row['work2_id'];
										$works[] = $row['work3_id'];
										$works[] = $row['work4_id'];
										$works[] = $row['work5_id'];
										$days[$row['day']] = $works;
									}
									echo "<tr>";
									echo "<td style='border-left-style:none;width: 100px;background-color:#e3f3f7;'>" . $ch_names[1] . "</td>";
									for ($i = 0; $i < 5; $i++) {
										$worksList = "";
										for ($j = 0; $j < 5; $j++) {
											if(isset($days[$weeks[$i]][$j]))
											$worksList .= $days[$weeks[$i]][$j]." ";
										}

										echo "<td><input w='$j' t='$i' value='" . $worksList . "'></td>";

									}
									echo "</tr>";
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
