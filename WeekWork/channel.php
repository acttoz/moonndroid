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
        if (empty($_SESSION['is_logged']) || $_SESSION['is_logged'] == FALSE) {
            header("location:index.php");
            exit ;
        }
        ?>
    </head>

    <body >

        <LINK REL="SHORTCUT ICON" HREF="./favicon.ico" />
        <header id="header">

            <logo>
                <a href="./index.php"></a>
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
                    <li>
                    </li>
                    <li >
                        <a href="week.php">WeekWork</a>
                    </li>
                    <li >
                        <a href="#">학년 설정</a>
                    </li>
                    <li >
                        <a href="qna.php">문의 게시판</a>
                    </li>
                    <li >
                        <a href="#"><?php echo $_SESSION['name']; ?></a>
                    </li>

                </ul>
            </nav>
        </header>
        <div id="wrapper">
            <br>
            <table class="time_table" style="table-layout: fixed;height: 400px;" align="center"  >
                <tr class="" style="border-radius: 10px 0 0 0; ">
                    <!-- 학교제목  -->
                    <td  class="content"  style="height:70px;width:10%;border-radius:10px 0 0 0; border-left-style:none;border-top-style:none;   font-weight: bold;font-size:25px "> 학교 </td>

                    <!-- 학교   -->
                    <td  class="content"    style="width:40%;border-top-style:none; font-weight: bold;font-size:20px "><?php

                    echo $_SESSION['school'];
                    ?></td>

                    <!-- 검색리스트  -->
                    <td    class="content" style=" width:50%;border-top-style:none; border-right-style:none; border-radius: 0 10px 0 0;"><?php

                    $sql = "SELECT * FROM w_channel WHERE ";
                    $sql = $sql . "school_no='" . $_SESSION['school_id'] . "'";
                    $result = mysql_query($sql);
                    $results;
                    $ch_login_list = array();
                    while ($row = mysql_fetch_array($result)) {
                        if($row['grade']==0)
                            $ch_login_list['school'] = array('grade'=>$row['grade'],'ch_id' => $row['ch_id'], 'pw' => $row['pw']);
                        else if($row['grade']==10)
                            $ch_login_list['me'] = array('grade'=>$row['grade'],'ch_id' => $row['ch_id'], 'pw' => $row['pw']);
                        else
                            $ch_login_list['grade'] = array('grade'=>$row['grade'],'ch_id' => $row['ch_id'], 'pw' => $row['pw']);
                    }

                    //로그인 됨  ch_school!=0 or ch_grade!=0
                    if ($_SESSION['ch_school'] != 0) {
                        echo '로그인됨';
                    } else{
                        //채널이 생성 안됨  w_channel테이블의 school_no 컬럼이 일치하는 row가 없음.
                        echo '
                          <div class="form-group" id="sign_school" style="display:block">
                           <h4 id="ch_name" style="white-space: pre-wrap">';
                        if (!empty($ch_login_list['school']))
                            echo '학교 채널 생성자가 정한 비밀번호를 입력해주세요.';
                        else {
                            echo '학교 채널이 생성되지 않았습니다. 학교 채널 비밀번호를 생성해주세요.';
                        }
                                echo '</h4>
                                
                                
                            <div class="col-sm-8">
                                <input type="text" id="school_pw" class="form-control numeric" placeholder="숫자 네자리" maxlength="4" style="ime-mode:disabled;"/>
                            </div>
                            <div class="col-sm-4">
                                <button type="button" class="btn btn-success form-control" onclick="';
                                 if (!empty($ch_login_list['school']))
                            echo 'login_ch(0,'.$ch_login_list['school']['ch_id'].')';
                        else {
                            echo 'sign_ch(0,'.$_SESSION['school_id'].')';
                        }
                          
                                echo '">';
                      if (!empty($ch_login_list['school']))
                            echo '로그인';
                        else {
                            echo '암호 생성하기';
                        }
                          
                                echo '</button>
                            </div>
                        </div>
                        ';
                    }
                        ?>
                      
                     
                    </td>
                </tr>
                <tr style="">
                    <!-- 학년제목  -->
                    <td  class="content"  style=" width:10%;border-radius:0 0 0 10px; border-left-style:none;border-bottom-style:none; font-weight: bold;font-size:25px "> 학년 </td>

                    <!-- 학년 리스트  -->
                    <td  class="content"  style=" width:40%;border-style:none;border-bottom-style:none;border-left-color:white; font-weight: bold;font-size:20px "><?php
                    // if (count($ch_ids) > 1) {
                    // for ($i = 1; $i < count($ch_ids); $i++) {
                    //
                    // echo "<button class='btn btn-default' style='margin-bottom:10px;height:70px;font-size:20px;' onclick='channel()'>" . $ch_names[$i] . "(재설정)</button>";
                    // }
                    // } else if (count($ch_ids) == 1) {
                    // echo "<button class='btn btn-info' style='height:70px;font-size:30px;' onclick='channel()' >+</button>";
                    // }
                    echo $_SESSION['grade'] . '학년';
                    ?></td>
                    
                    <td    class="content" style=" width:50%;border-bottom-style:none; border-right-style:none; border-radius: 0 0 10px 0;"><?php

                   
                    if ($_SESSION['ch_grade'] != 0) {
                        echo '로그인됨';
                    } else{
                        //채널이 생성 안됨  w_channel테이블의 school_no 컬럼이 일치하는 row가 없음.
                        echo '
                          <div class="form-group" id="sign_school" style="display:block">
                           <h4 id="ch_name" style="white-space: pre-wrap">';
                        if (!empty($ch_login_list['grade']))
                            echo $ch_login_list['grade']['grade'].'학년 채널 생성자가 정한 비밀번호를 입력해주세요.';
                        else {
                            echo $_SESSION['grade'].'학년 채널이 생성되지 않았습니다. <br>학년 채널 비밀번호를 생성해주세요.';
                        }
                                echo '</h4>
                                
                                
                            <div class="col-sm-8">
                                <input type="text" id="grade_pw" class="form-control numeric" placeholder="숫자 네자리" maxlength="4" style="ime-mode:disabled;"/>
                            </div>
                            <div class="col-sm-4">
                                <button type="button" class="btn btn-success form-control" onclick="';
                                 if (!empty($ch_login_list['grade']))
                            echo 'login_ch('.$ch_login_list['grade']['grade'].','.$ch_login_list['grade']['ch_id'].')';
                        else {
                            echo 'sign_ch('.$_SESSION['grade'].','.$_SESSION['school_id'].')';
                            
                        }
                          
                                echo '">';
                                                                                       if (!empty($ch_login_list['grade']))
                            echo '로그인';
                        else {
                            echo '암호 생성하기';
                        }
                          
                                echo '</button>
                            </div>
                        </div>
                        ';
                    }
                        ?>
                      
                     
                    </td>
                </tr>
            </table>

            <!-- /#page-content-wrapper -->

        </div>
        <!-- /#wrapper -->
        <!-- Menu Toggle Script -->
        <script src="./sign.js"></script>
<script>var school_pw = '<?= $ch_login_list['school']['pw'] ?>';
    var grade_pw =  '<?= $ch_login_list['grade']['pw'] ?>';
    </script>
            <?php
            include_once ("./tail.php");
        ?>
    </body>

</html>
