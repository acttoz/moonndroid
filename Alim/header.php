<LINK REL="SHORTCUT ICON" HREF="./favicon.ico" />
<header id="header">
	<?
				if ($_SESSION['is_logged']) {
				} else {
					Header("Location:index.php"); 
				}
				?> 
	<logo>
		<a href="" title="스피드알림장3">스피드알림장3</a>
	</logo>
	<nav id="mainMenu">
		<ul>
			 
			<li >
					<a href="timetable.php">기초 시간표</a>
			</li>
			<li >
				<a href="today.php">알림장</a>
			</li>
			<li >
				<a href="help.php">고객지원</a>
			</li>
			 
			<li>
				<?
					echo '<a href="edit_class.php"> '.$_SESSION['name'].'님(관리)</a>';
				?>
			</li>
		</ul>
	</nav>
</header>