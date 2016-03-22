<?
session_start();
error_reporting(0);
// 세션시작입니다. 항상젤위에 있어야합니다,,
?>
<!DOCTYPE html>
<html lang="ko">
	<head>
		<?
		include_once ('./framework.php');
		?>
		  <link rel="stylesheet" href="./css/jquery-ui.css">
      <script src="//code.jquery.com/jquery-1.10.2.js"></script>
      <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
	</head>

	<body id="home">
		<div id="wrapper">

			<?php
			include_once ('./header.php');
			?>

			<br/>
			<div id="content">
			<form class="form-horizontal" id="margin" name="select_school" method="post">
				<div class="form-group">
					<label for="inputEmail3" class="col-sm-2 control-label"></label>
					<div class="col-sm-10">
						<label >정보 수정</label>
					</div>
				</div>
				<div class="form-group">
					<label for="inputEmail3" class="col-sm-2 control-label">이메일</label>
					<div class="col-sm-10">
						<input type="email" class="form-control" name="user_id" id="user_id" readonly checked="0" placeholder="비밀번호 재발급에 이용되므로 사용중인 이메일을 입력하세요." value="<?echo $_SESSION['id'] ?>">
						</input>
					</div>
				</div>

				<div class="form-group">
					<label for="inputPassword3" class="col-sm-2 control-label">비밀번호</label>
					<div class="col-sm-10">
						<input type="password" class="form-control" name="user_pass">
					</div>
				</div>
				<div class="form-group">
					<label for="inputPassword3" class="col-sm-2 control-label">비밀번호 한번더</label>
					<div class="col-sm-10">
						<input type="password" class="form-control pass2" name="user_pass2">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" >학교급</label>
					<div class="col-sm-10">
						<select type="email" class="form-control school_grade" >
							<option value='1' <?php
							if ($_SESSION['school_id'] < 6284)
								echo 'selected';
							?>>초등</option>
							<option value='2' <?php
							if (6283 < $_SESSION['school_id'] && $_SESSION['school_id']  < 9332)
								echo 'selected';
							?>>중등</option>
							<option value='3'<?php
							if (9331<$_SESSION['school_id']&& $_SESSION['school_id']  < 11492)
								echo 'selected';
							?>>고등</option>
							<option value='4'<?php
							if (11491<$_SESSION['school_id'] )
								echo 'selected';
							?>>특수</option>
						</select>
					</div>

				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" >학년</label>
					<div class="col-sm-10">
						<select type="email" class="form-control grade" >
							<option value='1' <?php
							if ($_SESSION['grade'] == 1)
								echo 'selected';
							?>>1학년</option>
							<option value='2' <?php
							if ($_SESSION['grade'] == 2)
								echo 'selected';
							?>>2학년</option>
							<option value='3' <?php
							if ($_SESSION['grade'] == 3)
								echo 'selected';
							?>>3학년</option>
							<option value='4' <?php
							if ($_SESSION['grade'] == 4)
								echo 'selected';
							?>>4학년</option>
							<option value='5' <?php
							if ($_SESSION['grade'] == 5)
								echo 'selected';
							?>>5학년</option>
							<option value='6' <?php
							if ($_SESSION['grade'] == 6)
								echo 'selected';
							?>>6학년</option>
						</select>
					</div>

				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" >학반</label>
					<div class="col-sm-10">
						<select type="email" class="form-control ban" >
							<option value='1' <?php
							if ($_SESSION['ban'] == 1)
								echo 'selected';
							?>>1반</option>
							<option value='2' <?php
							if ($_SESSION['ban'] == 2)
								echo 'selected';
							?>>2반</option>
							<option value='3' <?php
							if ($_SESSION['ban'] == 3)
								echo 'selected';
							?>>3반</option>
							<option value='4' <?php
							if ($_SESSION['ban'] == 4)
								echo 'selected';
							?>>4반</option>
							<option value='5' <?php
							if ($_SESSION['ban'] == 5)
								echo 'selected';
							?>>5반</option>
							<option value='6' <?php
							if ($_SESSION['ban'] == 6)
								echo 'selected';
							?>>6반</option>
							<option value='7' <?php
							if ($_SESSION['ban'] == 7)
								echo 'selected';
							?>>7반</option>
							<option value='8' <?php
							if ($_SESSION['ban'] == 8)
								echo 'selected';
							?>>8반</option>
							<option value='9' <?php
							if ($_SESSION['ban'] == 9)
								echo 'selected';
							?>>9반</option>
							<option value='10' <?php
							if ($_SESSION['ban'] == 10)
								echo 'selected';
							?>>10반</option>
							<option value='11' <?php
							if ($_SESSION['ban'] == 11)
								echo 'selected';
							?>>11반</option>
							<option value='12' <?php
							if ($_SESSION['ban'] == 12)
								echo 'selected';
							?>>12반</option>
							<option value='13' <?php
							if ($_SESSION['ban'] == 13)
								echo 'selected';
							?>>13반</option>
							<option value='14' <?php
							if ($_SESSION['ban'] == 14)
								echo 'selected';
							?>>14반</option>
							<option value='15' <?php
							if ($_SESSION['ban'] == 15)
								echo 'selected';
							?>>15반</option>
							<option value='16' <?php
							if ($_SESSION['ban'] == 16)
								echo 'selected';
							?>>16반</option>
							<option value='17' <?php
							if ($_SESSION['ban'] == 17)
								echo 'selected';
							?>>17반</option>
						</select>
					</div>

				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" >담임 성명</label>
					<div class="col-sm-10">
						<input type="text" id="teacher_name" class="form-control" name="teacher_name" placeholder="학부모와 학생에게 표시되는 이름이므로 정확히 입력해주세요." value="<?echo $_SESSION['name'] ?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" >학급 코드</label>
					<div class="col-sm-10">
						<input type="number" maxlength="4" oninput="maxLengthCheck(this)" id="class_pass" class="form-control" value="<?echo $_SESSION['class_key']; ?>">
						</input>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" >학교명</label>
					<div class="col-sm-8">
						<input type="text" id="search_input" class="form-control" name="school_word" placeholder="검색할 학교 이름을 입력하세요.">
					</div>
					<div class="col-sm-2">
						<button type="button" id="search_button" class="btn btn-info form-control" onclick=fnSchool()>
							검색하기
						</button>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" >선택한 학교</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" id="selected_school" school_name="<?echo $_SESSION['school'] ?>" school_id="<?echo $_SESSION['school_id'] ?>" placeholder="선택한 학교 이름이 표시됩니다." readonly value="<?echo $_SESSION['school'] ?>">
						</input>
					</div>
					<div class="col-sm-2">
						<button type="button" class="btn btn-success form-control" onclick=toNext()>
							저    장
						</button>
					</div>
			</form>
			<br/>
			<br/>
			<br/>
			<br/>
			<div id="margin">
				<label>학교 검색 목록</label>
				<br/>
				<br/>
				<div class="list-group" id="school_list">
					<a href="#" class="list-group-item">검색 결과 없음</a>
				</div>
			</div>
			<div id="margin">
			<button type="button" style="width:100%;" class="btn btn-info" onclick=logOut()>
							로그아웃
						</button>
						</div>
			</div>
			<div id="margin">
			<button type="button" style="width:100%;" class="btn btn-danger" onclick=signOut()>
							회원탈퇴
						</button>
						</div>
			</div>
			<footer><?php
			include_once ('./footer.php');
		?></footer>
		 <div id="dialog-confirm" title="알림" style="display:none;"><?php
		include_once ('./today_notice.php');
            ?></div>
		</div>
		<script src="edit_class.js"></script>
	</body>
</html>
