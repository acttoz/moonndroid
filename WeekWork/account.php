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
        <?php
        include_once ('./header.php');
        ?>
        <div id="wrapper">
            <div  id='content'  >
                <form class="form-horizontal" id="margin" name="select_school" method="post" style="">
                    <div class="form-group">
                        <label class="col-sm-2 control-label" >이     름</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="teacher_name" placeholder="작성자 항목에 표시되는 이름이므로 정확히 입력해 주세요." value="<?PHP echo $_SESSION['w_name'] ?>">
                        </div>
                    </div>
                    
                    <div class="form-group" style="">
                        <label  class="col-sm-2 control-label" >아이디</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" name="user_id" id="user_id" checked="0" placeholder="비밀번호 재발급에 이용되므로 사용중인 이메일을 입력하세요." value="<?PHP echo $_SESSION['w_id'] ?>" readonly>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label">비밀번호</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" id="user_pass" placeholder="비밀번호">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label">비밀번호 확인</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control pass2" id="user_pass2" placeholder="비밀번호 확인">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-2 control-label" >이메일</label>
                        <div class="col-sm-10">
                            <input type="text" id="email" class="form-control" name="teacher_name" placeholder="비밀번호 재발급에 이용되므로 사용중인 이메일을 입력하세요." value="<?PHP echo $_SESSION['w_email'] ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" ></label>
                        <div class="col-sm-10">
                            <button type="button" class="btn btn-success form-control" id="submit_btn" onclick=signUp()>
                                변경하기
                            </button>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" ></label>
                        <div class="col-sm-10">
                            <button type="button" class="btn btn-warning form-control" id="submit_btn" onclick=logout()>
                                로그아웃
                            </button>
                        </div>
                    </div>
                    
                   
 
                  
                </form>
            </div>

            <!-- /#page-content-wrapper -->

        </div>
        <!-- /#wrapper -->
        <!-- Menu Toggle Script -->
        <script src="/js/account.js"></script>

        <?php
        include_once ("./tail.php");
        ?>
    </body>

</html>
