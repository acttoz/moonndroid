<?php
   session_start();
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
      <link href="css/mobile.css" rel="stylesheet" type="text/css">
      <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
      <script src="framework/js/placeholder.js"></script>
      <style>
         a {
         text-align: center;
         }
      </style>
   </head>
   <body id="home">
      <div id="wrapper">
         <br>
         <div id='content'>
            <form class="form-horizontal" id="margin" name="select_school" method="post">
               <div class="form-group">
                  <label class="col-sm-2 control-label" >학생이름</label>
                  <div class="col-sm-10">
                     <input type="text" id="nick" class="form-control" >
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
                  <label class="col-sm-2 control-label" >학교명</label>
                  <div class="col-sm-8">
                     <input type="text" id="search_input" class="form-control" name="school_word" placeholder="대한초등학교의 경우 '대한'으로 검색">
                  </div>
                  <div class="col-sm-2">
                     <button type="button" id="search_button" class="btn btn-info form-control" onclick=fnSchool()>
                     검색하기
                     </button>
                  </div>
               </div>
               <div  class="school_list" style="display:none">
                  <label>학교를 고르시오.</label>
                  <div class="list-group" id="school_list">
                     <a href="#" class="list-group-item">검색 결과 없음</a>
                  </div>
               </div>
               <div  class="class_list" style="display:none">
                  <label>우리반을 선택하세요.</label>
                  <div class="list-group" id="class_list">
                     <a href="#" class="list-group-item">검색 결과 없음</a>
                  </div>
               </div>
               <div class="form-group" id="password" style="display:none" class_key="1" class_id="">
                  <label class="col-sm-2 control-label" >학급코드</label>
                  <div class="col-sm-8">
                     <input  id="class_pass" class="form-control" placeholder="선생님이 알려주신 코드">
                  </div>
                  <div class="col-sm-2">
                     <button type="button" id="next_button" class="btn btn-info form-control" onclick=toNext()>
                     저장하기
                     </button>
                  </div>
               </div>
         </div>
         </form>
      </div>
      <script src="mobile_class.js"></script>
   </body>
</html>
