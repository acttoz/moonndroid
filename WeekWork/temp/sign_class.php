<?php
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
 <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
      <script src="//code.jquery.com/jquery-1.10.2.js"></script>
      <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
	</head>
 
	<body id="home">
		<div id="wrapper">
<header id="header">
	 
	<logo>
		<a href="" title="스피드알림장">스피드알림장</a>
	</logo>
	 
</header>
			 
<br>
<div id='content'>
	<div style="">
					 
					
				</div>
			<form class="form-horizontal" id="margin" name="select_school" method="post">
				<div class="form-group">
					<label   class="col-sm-2 control-label"></label>
					<label   class="col-sm-2 control-label" style="text-align: left">회원가입</label>
					<div class="col-sm-2">
						<button type="button" class="btn btn-warning form-control" id="submit_btn" onclick=sign_help()>
							잘안되요!!
						</button>
					</div>
					<label   class="col-sm-6 control-label"></label>
				</div>
				<div class="form-group">
					<label for="inputEmail3" class="col-sm-2 control-label">이메일</label>
					<div class="col-sm-8">
						<input type="email" class="form-control" name="user_id" id="user_id" checked="0" placeholder="비밀번호 재발급에 이용되므로 사용중인 이메일을 입력하세요.">
					</div>
					<div class="col-sm-2">
						<button type="button" class="btn btn-info form-control" id="submit_btn" onclick=fnSign()>
							중복확인
						</button>
					</div>
				</div>

				<div class="form-group">
					<label for="inputPassword3" class="col-sm-2 control-label">비밀번호</label>
					<div class="col-sm-10">
						<input type="password" class="form-control" name="user_pass" placeholder="비밀번호">
					</div>
				</div>
				<div class="form-group">
					<label for="inputPassword3" class="col-sm-2 control-label">비밀번호 확인</label>
					<div class="col-sm-10">
						<input type="password" class="form-control pass2" name="user_pass2" placeholder="비밀번호 확인">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" >학교급</label>
					<div class="col-sm-10">
						<select type="email" class="form-control school_grade" >
							<option value='1' >초등</option>
							<option value='2' >중등</option>
							<option value='3'>고등</option>
							<option value='4'>특수</option>
						</select>
					</div>

				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" >학년</label>
					<div class="col-sm-10">
						<select type="email" class="form-control grade" >
							<option value='1' >1학년</option>
							<option value='2' >2학년</option>
							<option value='3' >3학년</option>
							<option value='4' >4학년</option>
							<option value='5' >5학년</option>
							<option value='6' >6학년</option>
						</select>
					</div>

				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" >학반</label>
					<div class="col-sm-10">
						<select type="email" class="form-control ban" >
							<option value='1' >1반</option>
							<option value='2' >2반</option>
							<option value='3' >3반</option>
							<option value='4' >4반</option>
							<option value='5' >5반</option>
							<option value='6' >6반</option>
							<option value='7' >7반</option>
							<option value='8' >8반</option>
							<option value='9' >9반</option>
							<option value='10' >10반</option>
							<option value='11' >11반</option>
							<option value='12' >12반</option>
							<option value='13' >13반</option>
							<option value='14' >14반</option>
							<option value='15' >15반</option>
							<option value='16' >16반</option>
							<option value='17' >17반</option>
						</select>
					</div>

				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" >담임 성명</label>
					<div class="col-sm-10">
						<input type="text" id="teacher_name" class="form-control" name="teacher_name" placeholder="학부모와 학생에게 표시되는 이름이므로 정확히 입력해주세요.">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" style="font-size: 13px;" >학급코드(<red style="color: red; font-size: 12px;">숫자4자리</red>)</label>
					<div class="col-sm-10">
						<input type="number" maxlength="4" oninput="maxLengthCheck(this)" id="class_pass" class="form-control" placeholder="우리반의 알림장을 받기 위해서는 이 비밀번호를 알아야 합니다.학부모와 학생들에게 알려주세요.">
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-2 control-label" style="font-size: 13px;" >학급코드 한번더</label>
					<div class="col-sm-10">
						<input type="number" maxlength="4" oninput="maxLengthCheck(this)" id="class_pass2" class="form-control" placeholder="학급코드를 한번더 정확히 입력해주세요.">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" >학교명</label>
					<div class="col-sm-8">
						<input type="text" id="search_input" class="form-control" name="school_word" placeholder="검색할 학교 이름을 입력하세요. 예> 대한초등학교의 경우 '대한'으로 검색">
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
						<input type="text" class="form-control" id="selected_school" school_name="null" school_id="null" placeholder="선택한 학교 이름이 표시됩니다." readonly>
					</div>
					<div class="col-sm-2">
						<button type="button" class="btn btn-success form-control" onclick=toNext()>
							회원가입
						</button>
					</div>
					</div>
			</form>
			<div id="margin">
				<label>학교 검색 목록</label>
				<div class="list-group" id="school_list">
					<a href="#" class="list-group-item">검색 결과 없음</a>
				</div>
			</div>
			</div>
			<footer><?php
			include_once ('./footer.php');
		?></footer>
		<div id="dialog-confirm" title="알림" style="display:none;"> 
			<IMG class="displayed" src="./img/sign_class_help.png" style="width:800px; display: block; margin-left: auto; margin-right: auto">
				<br/>
				<p style="text-align: left">
					위 순서대로 차근차근 따라 해보셔요~.<br/> 
					그래도 잘안되시는 분은 다음 양식에 맞게 입력하셔서 이메일로 보내주시면 학급 개설을 대행해드리겠습니다.<br/>이메일:<br/>비밀번호:<br/>담임성명:<br/>학급코드(숫자4자리):<br/>학교지역과이름:<br/>이메일 : acttoz@naver.com 
				</p>
			</div>
		</div>
		</div>
		<script src="sign_class.js"></script>
	</body>
</html>
