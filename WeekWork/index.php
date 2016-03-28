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
        <div id="wrapper" class="toggled">

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
            
             <a href="#menu-toggle" class="btn btn-info glyphicon glyphicon-align-justify" style="font-size:15px" id="menu-toggle"></a>

            <div id="page-content-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div  id='content'  >
                    <h1>WeekWork</h1>
                                <table class="time_table" style="table-layout: fixed;" align="center"  >
                                    <tr class="row1" style="border-radius: 10px 0 0 0; ">
                                        <td class="cell1 center" style="border-top-style:none;border-left-style:none; border-radius: 10px 0 0 0; "><?php
                                        // $monday = strtotime('monday this week');
                                        $monday = 1458486000;
                                        echo(int)date("m", $monday) . "월";
                                        $weeks[] = "2016-03-21";
                                        $weeks[] = "2016-03-22";
                                        $weeks[] = "2016-03-23";
                                        $weeks[] = "2016-03-24";
                                        $weeks[] = "2016-03-25";
                                        // $weeks[] = date("Y-m-d", strtotime('monday this week'));
                                        // $weeks[] = date("Y-m-d", strtotime('tuesday this week'));
                                        // $weeks[] = date("Y-m-d", strtotime('wednesday this week'));
                                        // $weeks[] = date("Y-m-d", strtotime('thursday this week'));
                                        // $weeks[] = date("Y-m-d", strtotime('friday this week'));
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
                                        echo "<tr id='" . $ch_ids[$i] . "' ch_name='" . $ch_names[$i] . "'>";

                                        if ($i < (count($ch_ids) - 1)) {
                                            echo "<td class='center' style='border-left-style:none;width: 60px;background-color:#e3f3f7;'>" . $ch_names[$i] . "</td>";
                                        } else {
                                            echo "<td class='center' style='border-left-style:none;border-bottom-style:none; border-radius: 0 0 0 10px;width: 60px;background-color:#e3f3f7;'>" . $ch_names[$i] . "</td>";
                                        }
                                        for ($j = 0; $j < 5; $j++) {
                                            if ($i == (count($ch_ids) - 1) && $j == (4)) {
                                                echo "<td style='border-right-style:none;border-bottom-style:none; border-radius: 0 0 10px 0;text-align:center;font-size:30px' class='work' id='" . $weeks[$j] . "')>";
                                            } else
                                                echo "<td style='text-align:center;font-size:30px' class='work' id='" . $weeks[$j] . "')>";
                                            echo '<p class="btn btn-default" style="display:block;margin-top:10px;margin-bottom:10px; " onclick=newWork(' . $ch_ids[$i]. ',"' . $ch_names[$i] . '","' . $weeks[$j] . '")>+</p>';
                                        }

                                        echo "</td>";

                                        echo "</tr>";
                                    }
                                    ?>
                                </table>
                                <br/>
                                
                                <div id="workList" style="<!-- display: none -->;">
                                <h1 id="workDate"  user="<?php echo $_SESSION["id"]; ?>" >제목</h1> 
                                 <table class="time_table" style="table-layout: fixed" align="center"  >
                                    <tr class="" style="border-radius: 10px 0 0 0; ">
                                        <td colspan="3" class="content"  style="width:30%;border-top-style:none;border-left-style:none; border-right-color:white;border-bottom-color:white; border-radius: 10px 0 0 0; font-weight: bold;font-size:20px "><input id="work_title" placeholder="제목"  value="work"></td>
                                         <td class="content "style="padding-right:10px;width:15%;border-top-style:none;border-bottom-color:white; border-left-color:white; font-weight: bold;font-size:10px ">
                                            <button id="work_file"  type="button" class="btn btn-info" id="submit_btn" onclick=fnSign()>
                                                                                        파일첨부
                                            </button>
                                         </td>
                                        
                                        <td  colspan="5" rowspan="2"  class="content" style="vertical-align:top ;  width:70%;border-top-style:none;border-right-style:none; border-radius: 0 10px 0 0;">
                                            <div id="reply" style="height: 50vh; overflow-y:scroll; ">
                                            
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="" style="border-radius: 10px 0 0 0; ">
                                        <td class="content " colspan="4" style="padding-right:10px;padding-left:10px; border-bottom-style:none;border-left-style:none;">
                                            <div  style=" ">
                                                <textarea  class="contents" id="work_content" placeholder="설명" ></textarea>                                           

</div>                                            </td>                                  
                                          
                                    </tr>
                                    <tr>
                                        <td colspan="3"  class="content " style="padding:10px;width:20%;border-left-style:none;border-bottom-style:none; border-right-color:white; font-weight: bold;font-size:10px; border-radius: 0 0 0 10px; ">
                                            <button id="work_edit_btn" style="width:100%;height: 100%;" type="button" class="btn btn-info" onclick=editWork()>
                                                                                        수정
                                            </button>
                                         </td>
                                          <td colspan="1"  class="content " style="padding:10px;width:20%;border-left-style:none;border-bottom-style:none;   font-weight: bold;font-size:10px;  ">
                                            <button id="work_complete_btn" style="width:100%;height: 100%;" type="button" class="btn btn-info has-spinner">
                                                                                        완료 표시하기
                                            </button>
                                         </td>
                                         
                                        <td   class="content " colspan="4" style="width:100%;padding-left:5px;padding-top:0px;padding-right:5px;padding-bottom:0px; border-top-style:none;border-bottom-style:none; border-right-color:white; font-weight: bold;font-size:10px ">
                                                        <textarea id="reply_input" type="email" style="height:100%; width:100%" class="form-control" name="user_id" id="user_id" checked="0" placeholder="댓글을 입력하세요."></textarea>
                                         </td>
                                         <td class="content " style="width:10%;padding:5px; border-bottom-style:none;border-right-style:none; border-left-color:white; border-radius: 0 0 10px  0;">
                                           <p class = "tpbutton btn-toolbar" style="text-align:center">
                                                <a id="reply_file" class = "btn   btn-info" style="margin-bottom:1px;width:90%"  href = "#" target = "_texturepack">파일 첨부</a>
                                                <a id="reply_submit" class = "btn   btn-info" style="margin-top:1px;width: 90%" href = "#" target = "_texturepack">저         장</a>
                                            </p>
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
