<!DOCTYPE html>
<html lang="ko">

    <?php
    include_once ('./config.php');
    ?>

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>WeekWork</title>

        <?php
        include_once ('./framework.php');
        ?>
    </head>

    <body>
        <div id="wrapper">

            <!-- Sidebar -->
            <div id="sidebar-wrapper">
                <ul class="sidebar-nav">
                    <li class="sidebar-brand">
                        <a href="#">계정 </a>
                    </li>
                    <li >
                        <a href="#">수정 </a>
                    </li>
                    <li >
                        <a href="#">로그아웃 </a>
                    </li>
                    <hr>
                    <li class="sidebar-brand">
                        <a >채널 </a>
                    </li>
                    <li>
                        <a href="#">전체보기</a>
                    </li>

                    <?php
                    $sql = "SELECT ch_id,ch_name FROM channel WHERE ";
                    $sql = $sql . "ch_id='" . $_SESSION['ch1'] . "'";
                    $sql = $sql . " OR ch_id='" . $_SESSION['ch2'] . "'";
                    $sql = $sql . " OR ch_id='" . $_SESSION['ch3'] . "'";
                    $sql = $sql . " OR ch_id='" . $_SESSION['ch4'] . "'";
                    $sql = $sql . " OR ch_id='" . $_SESSION['ch5'] . "'";

                    $result = mysql_query($sql);
                    while ($row = mysql_fetch_array($result)) {
                        $ch_ids[] = $row['ch_id'];
                        $ch_names[] = $row['ch_name'];
                        echo "<li>                                            ";
                        echo "    <a href=index.php?ch=" . $row['ch_id'] . ">" . $row['ch_name'] . "</a>";
                        echo "</li>       											";
                    }
                    ?>

                    <li>
                        <a href="#">채널+</a>
                    </li>
                    <hr>
                    <li>
                        <a href="#">초대</a>
                    </li>

                </ul>

            </div>
            <!-- /#sidebar-wrapper -->
            <!-- <a href="#menu-toggle" class="btn btn-default" id="menu-toggle">Toggle Menu</a> -->
            <!-- Page Content -->

            <div id="page-content-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div  id='content'  >
                    <h1>WeekWork</h1>
                                <table class="time_table" align="center"  >
                                    <tr class="row1" style="border-radius: 10px 0 0 0; ">
                                        <td class="cell1 center" style="border-top-style:none;border-left-style:none; border-radius: 10px 0 0 0; "><?php
                                        // $monday = strtotime('monday this week');
                                        $monday = 1458486000;
                                        echo(int)date("m", $monday) . "월";
                                        $weeks[] = date("Y-m-d", strtotime('monday this week'));
                                        $weeks[] = date("Y-m-d", strtotime('tuesday this week'));
                                        $weeks[] = date("Y-m-d", strtotime('wednesday this week'));
                                        $weeks[] = date("Y-m-d", strtotime('thursday this week'));
                                        $weeks[] = date("Y-m-d", strtotime('friday this week'));
                                        ?></td>
                                        <td class="center" style="border-top-style:none;">월(<?php echo(int)date("d", $monday); ?>)
                                        </td>
                                        <td class="center" style="border-top-style:none;">화(<?php echo(int)date("d", $monday) + 1; ?>)
                                        </td>
                                        <td class="center" style="border-top-style:none;">수(<?php echo(int)date("d", $monday) + 2; ?>)
                                        </td>
                                        <td class="center" style="border-top-style:none;">목(<?php echo(int)date("d", $monday) + 3; ?>)
                                        </td>
                                        <td class="cell2 center" style="border-top-style:none;border-right-style:none; border-radius: 0 10px 0 0;"> 금(<?php echo(int)date("d", $monday) + 4; ?>)
                                        </td>
                                    </tr>
                                    <?php
                                    // 한 채널의 work 배치(표 한줄 완성)
                                    for ($i = 0; $i < count($ch_ids); $i++) {
                                        echo "<tr id='" . $ch_ids[$i] . "'>";

                                        if ($i < (count($ch_ids) - 1)) {
                                            echo "<td class='center' style='border-left-style:none;width: 60px;background-color:#e3f3f7;'>" . $ch_names[$i] . "</td>";
                                        } else {
                                            echo "<td class='center' style='border-left-style:none;border-bottom-style:none; border-radius: 0 0 0 10px;width: 60px;background-color:#e3f3f7;'>" . $ch_names[$i] . "</td>";
                                        }
                                        for ($j = 0; $j < 5; $j++) {
                                            if ($i == (count($ch_ids) - 1) && $j == (4)) {
                                                echo "<td style='border-right-style:none;border-bottom-style:none; border-radius: 0 0 10px 0;text-align:center;font-size:30px' class='work' id='" . $weeks[$j] . "' onclick=workList(" . $ch_ids[$i] . ",'" . $weeks[$j] . "')>+</td>";
                                            } else
                                                echo "<td style='text-align:center;font-size:30px' class='work' id='" . $weeks[$j] . "' onclick=workList(" . $ch_ids[$i] . ",'" . $weeks[$j] . "')>+</td>";
                                        }
                                        echo "</tr>";
                                    }
                                    ?>
                                </table>
                                <br/>
                                
                                <div id="workList" style="<!-- display: none -->">
                                <h1>3월 23일 / 4학년</h1>
                                 <table class="time_table" align="center"  >
                                    <tr class="" style="border-radius: 10px 0 0 0; ">
                                        <td class="content " style="width:60%;border-top-style:none;border-left-style:none; border-right-color:white;border-bottom-color:white; border-radius: 10px 0 0 0; font-weight: bold;font-size:20px ">수행평가 제출
                                        <td class="content " style="width:20%;border-top-style:none;border-bottom-color:white; border-left-color:white; font-weight: bold;font-size:10px "><img style="float:right;padding-right:10px;padding-top: 10px" width="60px" src="img/diskette.png" />
                                        
                                        <td rowspan="2"   class="content" style="border-top-style:none;border-right-style:none; border-radius: 0 10px 0 0;"> 채팅
                                        </td>
                                    </tr>
                                    <tr class="" style="border-radius: 10px 0 0 0; ">
                                        <td class="content " rowspan="2" colspan="2" style="border-bottom-style:none;border-left-style:none; border-radius: 0 0 0 10px; ">수행평가 제출
                                                    1반 국어 <br/>
                                                    2반 수학,사회<br/>
                                                    3반 과학<br/>
                                                    4반 음악,체육<br/>
                                                    5반 미술,도덕<br/>
                                                    <br/>
                                                                                                                임의로 나누었으니 제출해주세요.<br/>                                       
                                    </tr>
                                    <tr>
                                        
                                        <td class="content" style="width:80%;border-top-style:none;border-right-style:none; border-radius: 0 0 10px  0;"> <span style=" ">댓글:</span> <input style=" ">
                                        </td>
                                        </tr>
                                    
                                </table>
                                </div>
                                <!--
                                <div id="margin" align="center">
                                <div class="btn-group inline">
                                <button type="button" class="btn btn-info" style="font-size: 40px" onclick=upload()>
                                저장
                                </button>
                                </div>
                                -->
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- /#page-content-wrapper -->

        </div>
        <!-- /#wrapper -->

        <!-- Menu Toggle Script -->
        <script src="index.js"></script>

        <?php
        include_once ("./tail.php");
        ?>
    </body>

</html>
