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
        <? include_once ('./header2.php'); ?>
       <div id="wrapper">
           <div id='content'>
                <form class="form-horizontal" id="margin" name="select_school" method="post" style="">
                   <div class="form-group">
                    <label  class="col-sm-2 control-label"></label>
                    <div class="col-sm-4">
                        <input type="button" class="form-control btn-info" id="channel" value="코드 확인" onclick="channel2()"/>
                    </div>
                    
                </div>
                   <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">이메일</label>
                    <div class="col-sm-10">
                        <input type="hidden" id="isaccount" value=1>
                        <input readonly type="email" class="form-control" name="user_id" id="user_id" checked="1" placeholder="비밀번호 재발급에 이용되므로 사용중인 이메일을 입력하세요." value="<? echo $_SESSION['id']; ?>"/>
                    </div>
                    
                </div>

                <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">비밀번호</label>
                    <div class="col-sm-4">
                        <input type="password" class="form-control" name="user_pass" placeholder="변경할 비밀번호"/>
                    </div>
                    <label for="inputPassword3" class="col-sm-2 control-label">비밀번호 확인</label>
                    <div class="col-sm-4">
                        <input type="password" class="form-control pass2" name="user_pass2" placeholder="비밀번호 확인"/>
                    </div>
                </div>
             
               <div class="form-group">
                    <label class="col-sm-2 control-label" >성 명</label>
                    <div class="col-sm-4">
                        <input type="text" id="teacher_name" class="form-control" name="teacher_name" placeholder="학부모와 학생에게 표시되는 이름이므로 정확히 입력해주세요." value="<?echo $_SESSION['name'] ?>"/>
                    </div>
                </div>
             <br>
             <br>
                <div class="form-group">
                    <label class="col-sm-2 control-label" >학년</label>
                    <div class="col-sm-4">
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
                            <option value='10' <?php
                            if ($_SESSION['grade'] == 10)
                                echo 'selected';
                            ?>>교무실</option>
                            <option value='100' <?php
                            if ($_SESSION['grade'] == 100)
                                echo 'selected';
                            ?>>행정실</option>
                        </select>
                    </div>

<div   id="select_ban" style="display:<?
                if($_SESSION['grade']==10||$_SESSION['grade']==100)
                echo "none";
                else
                echo "block";
                ?>">
                    <label class="col-sm-2 control-label" >학반</label>
                    <div class="col-sm-4">
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
                             <option value='0' <?php
                            if ($_SESSION['ban'] == 0)
                                echo 'selected';
                            ?>>전담</option>
                        </select>
                    </div>

                </div>
                
                 <div   id="select_position" style="display:<?
                if($_SESSION['grade']==10||$_SESSION['grade']==100)
                echo "block";
                else
                echo "none";
                ?>">
                    <label class="col-sm-2 control-label" >직책</label>
                    <div class="col-sm-4">
                        <select class="form-control position" >
                            <option value='21' <?php
                            if ($_SESSION['ban'] == 21)
                                echo 'selected';
                            ?>>교장</option>
                            <option value='22' <?php
                            if ($_SESSION['ban'] == 22)
                                echo 'selected';
                            ?>>교감</option>
                            <option value='23' <?php
                            if ($_SESSION['ban'] == 23)
                                echo 'selected';
                            ?>>교무</option>
                            <option value='24' <?php
                            if ($_SESSION['ban'] == 24)
                                echo 'selected';
                            ?>>보조교사</option>
                            <option value='25' <?php
                            if ($_SESSION['ban'] == 25)
                                echo 'selected';
                            ?>>행정실장</option>
                            <option value='26' <?php
                            if ($_SESSION['ban'] == 26)
                                echo 'selected';
                            ?>>행정차장</option>
                            <option value='27' <?php
                            if ($_SESSION['ban'] == 27)
                                echo 'selected';
                            ?>>주무관</option>
                            <option value='28' <?php
                            if ($_SESSION['ban'] == 28)
                                echo 'selected';
                            ?>>영양사</option>
                            <option value='29' <?php
                            if ($_SESSION['ban'] == 29)
                                echo 'selected';
                            ?>>조리사</option>
                            <option value='30' <?php
                            if ($_SESSION['ban'] == 30)
                                echo 'selected';
                            ?>>교직원</option>
                        </select>
                    </div>

                </div>


                </div>
                
                
              
               
                <div class="form-group">
                    <label class="col-sm-2 control-label" >학교명</label>
                    <div class="col-sm-8">
                        <input type="text" id="search_input" class="form-control" name="school_word" placeholder="검색할 학교 이름을 입력하세요. 예> 대한초등학교의 경우 '대한'으로 검색"/>
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
                        <input type="text" class="form-control" id="selected_school" school_name="<?echo $_SESSION['school'] ?>" school_id="<?echo $_SESSION['school_id'] ?>" placeholder="선택한 학교 이름이 표시됩니다." readonly value="<?echo $_SESSION['school'] ?>"/>
                    </div>
                    <div class="col-sm-2">
                        <button type="button" class="btn btn-success form-control" onclick=toNext()>
                            저장하기
                        </button>
                    </div>
                 </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" > </label>
                    <div class="col-sm-10">
                  <div class="list-group" id="school_list">
                </div>
                
                 </div>
            </div>
                    
                <div class="form-group">
                   <div class="col-sm-2">
                    </div>
                   <div class="col-sm-5">
            <button type="button" style="width:100%;" class="btn btn-info" onclick=logOut()>
                            로그아웃
                        </button>
                    </div>
                    <div class="col-sm-5">
            <button type="button" style="width:100%;" class="btn btn-danger" onclick=signOut()>
                            회원탈퇴
                        </button>
                    </div>
                    </div>
            <br/>
 
                  
            </form>
            </div>
        </div>
        <!-- /#wrapper -->
        <!-- Menu Toggle Script -->
         <div id="dialog-confirm" title="알림" style="display:none;">
                <?php
                include_once ('./channel.php');
                ?>
            </div>
        <script type="text/javascript">
        function channel2(){
            $(function() {
                    $("#dialog-confirm").css("display", "block");
                    $("#dialog-confirm").dialog({
                        resizable : false,
                        width : 800,
                        height : 400,
                        modal : true,
                        buttons : {
                            "닫기" : function() {
                                $(this).dialog("close");
                            }
                        },
                        open : function() {
                            $(this).scrollTop(0);
                        }
                    });
            });
        }
        </script>
        <script>var origin_school = '<?= $_SESSION['school_id'] ?>';
    var origin_grade =  '<?= $_SESSION['grade'] ?>';
    </script>
        
        <script src="./account.js"></script>

        <?php
        include_once ("./tail.php");
        ?>
    </body>

</html>
