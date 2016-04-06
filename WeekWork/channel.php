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

        if (empty($_SESSION['ch1'])) {
        } else {

            $sql = "SELECT ch_id,ch_name FROM w_channel WHERE ";
            $sql = $sql . "ch_id='" . $_SESSION['ch1'] . "'";
            $sql = $sql . " OR ch_id='" . $_SESSION['ch2'] . "'";
            $sql = $sql . " OR ch_id='" . $_SESSION['ch3'] . "'";
            $sql = $sql . " OR ch_id='" . $_SESSION['ch4'] . "'";
            $sql = $sql . " OR ch_id='" . $_SESSION['ch5'] . "'";
            $result = mysql_query($sql);
            while ($row = mysql_fetch_array($result)) {
                $ch_ids[] = $row['ch_id'];
                $ch_names[] = $row['ch_name'];
            }
        }
        ?>

        <LINK REL="SHORTCUT ICON" HREF="./favicon.ico" />
        <header id="header">

            <logo>
                <a href="./week.php"></a>
            </logo>
            <nav id="mainMenu">
                <ul>

                    <li >
                        <a href="week.php?week=<?php echo(int)$this_week - 4; ?>" class="glyphicon-text glyphicon-fast-backward"></a>
                    </li>
                    <li>
                        <a href="week.php?week=<?php echo(int)$this_week - 1; ?>" class="glyphicon-text glyphicon-arrow-left"></a>
                    </li>
                    <li>
                        <a href="week.php?week=<?php echo(int)$this_week + 1; ?>" class="glyphicon-text glyphicon-arrow-right"></a>
                    </li>
                    <li>
                        <a href="week.php?week=<?php echo(int)$this_week + 4; ?>" class="glyphicon-text glyphicon-fast-forward"></a>
                    </li>
                    <li></li>
                    <li >
                        <a href="week.php">WeekWork</a>
                    </li>
                    <li >
                        <a href="#">채널 설정</a>
                    </li>
                    <li >
                        <a href="#">질문&답변</a>
                    </li>
                    <li >
                        <a href="#">계정 관리</a>
                    </li>

                </ul>
            </nav>
        </header>
        <div id="wrapper">
            <div  id='content'  >
                <form class="form-horizontal" id="margin" name="select_school" method="post" style="">
                    <div class="form-group">
                        <label class="col-sm-2 control-label" >이     름</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="teacher_name" placeholder="작성자 항목에 표시되는 이름이므로 정확히 입력해 주세요.">
                        </div>
                    </div>

                    <div class="form-group" style="">
                        <label  class="col-sm-2 control-label">아이디</label>
                        <div class="col-sm-8">
                            <input type="email" class="form-control" name="user_id" id="user_id" checked="0" placeholder="비밀번호 재발급에 이용되므로 사용중인 이메일을 입력하세요.">
                        </div>
                        <div class="col-sm-2">
                            <button type="button" class="btn btn-info form-control" id="submit_btn" onclick=idCheck()>
                                중복확인
                            </button>
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
                            <input type="text" id="email" class="form-control" name="teacher_name" placeholder="비밀번호 재발급에 이용되므로 사용중인 이메일을 입력하세요.">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" ></label>
                        <div class="col-sm-10">
                            <button type="button" class="btn btn-info form-control" id="submit_btn" onclick=signUp()>
                                가입하기
                            </button>
                        </div>
                    </div>

                </form>
            </div>

            <!-- /#page-content-wrapper -->

        </div>
        <!-- /#wrapper -->
        <!-- Menu Toggle Script -->
        <script src="/js/sign.js"></script>

        <?php
        include_once ("./tail.php");
        ?>
    </body>

</html>
