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
                        <a href="#">학년 설정</a>
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
            <br>
            <table class="time_table" style="table-layout: fixed;height: 400px;" align="center"  >
                <tr class="" style="border-radius: 10px 0 0 0; ">
                    <!-- 학교제목  -->
                    <td  class="content"  style="height:70px;width:10%;border-radius:10px 0 0 0; border-left-style:none;border-top-style:none;   font-weight: bold;font-size:25px "> 학교 </td>

                    <!-- 학교   -->
                    <td  class="content"    style="width:40%;border-top-style:none; font-weight: bold;font-size:20px "><?php
                    if (empty($_SESSION['ch1'])) {
                        echo "<button class='btn btn-info' style='height:70px;font-size:30px;' onclick='school()'>+</button>";
                    } else {

                        $sql = "SELECT * FROM w_channel WHERE ";
                        $sql = $sql . "ch_id='" . $_SESSION['ch1'] . "'";
                        $sql = $sql . " OR ch_id='" . $_SESSION['ch2'] . "'";
                        $sql = $sql . " OR ch_id='" . $_SESSION['ch3'] . "'";
                        $sql = $sql . " OR ch_id='" . $_SESSION['ch4'] . "'";
                        $sql = $sql . " OR ch_id='" . $_SESSION['ch5'] . "'";
                        $result = mysql_query($sql);
                        $school_id = 0;
                        while ($row = mysql_fetch_array($result)) {
                            $ch_ids[] = $row['ch_id'];
                            $ch_names[] = $row['ch_name'];
                            $school_id = $row['school_id'];
                        }

                        $sql = "SELECT * FROM w_school WHERE ";
                        $sql = $sql . "school_id='" . $school_id . "'";
                        $result = mysql_query($sql);
                        $school_name = "";
                        while ($row = mysql_fetch_array($result)) {
                            $school_name = $row['school_name'];
                        }

                        echo "<button id='school_name' class='btn btn-default' style=' height:70px;font-size:20px;' onclick='school()' >" . $school_name . "(재설정)</button>";
                    }
                    ?></td>

                    <!-- 검색리스트  -->
                    <td    class="content" rowspan="2" style="vertical-align:top ;  width:50%;border-top-style:none; border-right-style:none; border-radius: 0 10px 10px 0;">
                        <div id="list_group" style="display:none">
                        <div id="search_group" class="form-group">
                    <div class="col-sm-8">
                        <input type="text" id="search_input" class="form-control" name="school_word" placeholder="검색할 학교 이름을 입력하세요." value="덕">
                    </div>
                    <div class="col-sm-4">
                        <button type="button" id="search_button" class="btn btn-info form-control" onclick=fnSchool()>
                            검색하기
                        </button>
                    </div>
                </div>
                        <ul class="" id="school_list" style="list-style-type:none; height: auto;height: 400px; overflow-x: hidden; margin-top:60px;margin-right:10px;margin-bottom: 10px ">
                        <li>
                            <a href="#" class="list-group-item">검색 결과 없음</a>
                        </li>
                          </ul>
                                <!-- sign_school  -->                                                                                                
                        <div class="form-group" id="sign_school" style="display:none">
                            <hr>
                           <h4 id="ch_name">학교</h4>
                            <div class="col-sm-8">
                                <input type="text" id="pw_create" class="form-control numeric" placeholder="숫자 네자리" maxlength="4" onkeypress="return fn_press(event, 'numbers');" onkeydown="fn_press_han(this);" style="ime-mode:disabled;"/>
                            </div>
                            <div class="col-sm-4">
                                <button type="button" id="search_button" class="btn btn-success form-control" onclick=signSchool()>
                                                                                        암호 생성하기
                                </button>
                            </div>
                        </div>
                                <!-- sign_ch  -->                                                                                                
                        <div class="form-group" id="sign_ch" style="display:none">
                            <hr>
                           <h4 id="ch_name">학년</h4>
                            <div class="col-sm-8">
                                <input type="text" id="ch_pw_create" class="form-control numeric" placeholder="숫자 네자리" maxlength="4" onkeypress="return fn_press(event, 'numbers');" onkeydown="fn_press_han(this);" style="ime-mode:disabled;"/>
                            </div>
                            <div class="col-sm-4">
                                <button type="button" id="search_button" class="btn btn-success form-control" onclick=signCh()>
                                                                                        암호 생성하기
                                </button>
                            </div>
                        </div>
                        
                        
                                <!-- login_ch  -->                                                                                                
                        <div class="form-group" id="login_ch" style="display:none">
                        <hr>
                         <h4 id="ch_name">학년</h4>
                        <div class="col-sm-8">
                            <input type="text" id="pw_input" class="form-control numeric" placeholder="숫자 네자리" maxlength="4" onkeypress="return fn_press(event, 'numbers');" onkeydown="fn_press_han(this);" style="ime-mode:disabled;"/>
                        </div>
                        <div class="col-sm-4">
                            <button type="button" id="search_button" class="btn btn-info form-control" onclick=loginCh()>
                                가입하기
                            </button>
                        </div>
                    </div>
                    </td>
</div>
                </tr>
                <tr style="">
                    <!-- 학년제목  -->
                    <td  class="content"  style=" width:10%;border-radius:0 0 0 10px; border-left-style:none;border-bottom-style:none; font-weight: bold;font-size:25px "> 학년 </td>

                    <!-- 학년 리스트  -->
                    <td  class="content"  style=" width:40%;border-style:none;border-left-color:white;  border-bottom-color:white; font-weight: bold;font-size:20px "><?php
                    if (count($ch_ids) > 1) {
                        for ($i = 1; $i < count($ch_ids); $i++) {

                            echo "<button class='btn btn-default' style='margin-bottom:10px;height:70px;font-size:20px;' onclick='channel()'>" . $ch_names[$i] . "(재설정)</button>";
                        }
                    } else if (count($ch_ids) == 1) {
                        echo "<button class='btn btn-info' style='height:70px;font-size:30px;' onclick='channel()' >+</button>";
                    }
                    ?></td>
                </tr>
            </table>

            <!-- /#page-content-wrapper -->

        </div>
        <!-- /#wrapper -->
        <!-- Menu Toggle Script -->
        <script src="/js/sign.js"></script>
<script>var school_id = '<?= $school_id ?>';
    var school_name =  '<?= $school_name ?>';</script>
        <?php
        include_once ("./tail.php");
        ?>
    </body>

</html>
