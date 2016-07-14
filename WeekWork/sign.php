<!DOCTYPE html>
<html lang="ko" >

    <?php
    include_once ('./config.php');
    ?>

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>WeekWork</title>
        <link href="framework/css/sign.css" rel="stylesheet" type="text/css">
        <?php
        include_once ('./framework.php');
        ?>
    </head>

    <body >
        <LINK REL="SHORTCUT ICON" HREF="./favicon.ico" />
<header id="header">
    <logo> <a href="index.php" title="WeekWork"></a> </logo>
    <nav id="mainMenu">
      <ul style="top:11px;height:100%">
       
      </ul>
    </nav>
  </header>
        <div id="wrapper">
            <div  id='content'  >
                <form class="form-horizontal" id="margin" name="select_school" method="post" style="">
                   <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">이메일</label>
                    <div class="col-sm-8">
                        <input type="email" class="form-control" name="user_id" id="user_id" checked="0" placeholder="비밀번호 재발급에 이용되므로 사용중인 이메일을 입력하세요.">
                    </div>
                    <div class="col-sm-2">
                        <button type="button" class="btn btn-info form-control" id="submit_btn" onclick="id_check()">
                            중복확인
                        </button>
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">비밀번호</label>
                    <div class="col-sm-4">
                        <input type="password" class="form-control" name="user_pass" placeholder="비밀번호">
                    </div>
                    <label for="inputPassword3" class="col-sm-2 control-label">비밀번호 확인</label>
                    <div class="col-sm-4">
                        <input type="password" class="form-control pass2" name="user_pass2" placeholder="비밀번호 확인">
                    </div>
                </div>
             <div class="form-group">
                    <label class="col-sm-2 control-label" >성 명</label>
                    <div class="col-sm-4">
                        <input type="text" id="teacher_name" class="form-control" name="teacher_name" placeholder="선생님의 이름을 입력해주세요.">
                    </div>
                </div>
                <br>
                <br>
                <div class="form-group">
                    <label class="col-sm-2 control-label" >학년</label>
                    <div class="col-sm-4">
                        <select  class="form-control grade" >
                            <option value='1' >1학년</option>
                            <option value='2' >2학년</option>
                            <option value='3' >3학년</option>
                            <option value='4' >4학년</option>
                            <option value='5' >5학년</option>
                            <option value='6' >6학년</option>
                            <option value='10' >교무실</option>
                            <option value='100' >행정실</option>
                        </select>
                    </div>
                    
                    <div   id="select_ban">
                    <label class="col-sm-2 control-label" >학반</label>
                    <div class="col-sm-4">
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
                            <option value='0' >전담</option>
                        </select>
                    </div>
                </div>
                <div  id="select_position" style="display:none;">
                    <label class="col-sm-2 control-label" >직책</label>
                    <div class="col-sm-4">
                        <select class="form-control position" >
                            <option value='21' >교장</option>
                            <option value='22' >교감</option>
                            <option value='23' >교무</option>
                            <option value='24' >보조교사</option>
                            <option value='25' >행정실장</option>
                            <option value='26' >행정차장</option>
                            <option value='27' >주무관</option>
                            <option value='28' >영양사</option>
                            <option value='29' >조리사</option>
                            <option value='30' >교직원</option>
                        </select>
                    </div>

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
             <div class="form-group">
                    <label class="col-sm-2 control-label" >학교 검색 목록</label>
                    <div class="col-sm-10">
                  <div class="list-group" id="school_list">
                    <a href="#" class="list-group-item">검색 결과 없음</a>
                </div>
                
                 </div>
            </div>
            </form>
                    
                   
 
                  
            </div>

            <!-- /#page-content-wrapper -->

        </div>
        <!-- /#wrapper -->
        <!-- Menu Toggle Script -->
        <script src="./sign.js"></script>

        <?php
        include_once ("./tail.php");
        ?>
    </body>

</html>
