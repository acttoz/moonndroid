<!DOCTYPE html>
<html lang="ko" >

    <?php
    include_once ('./config.php');
    ?>

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <?php
        include_once ('./framework.php');
        ?>
        
        
        
        <script src="framework/js/jquery.pulse.min.js"></script>
    <link href="framework/css/simple-sidebar.css" rel="stylesheet" >
    </head>

    <body >
 <?php
 
 
 $_SESSION['is_logged']=false;
$_SESSION['ch_school']=246;
$_SESSION['ch_grade']=247;
$_SESSION['ch_me']=249;
 
 
$ch_ids = array($_SESSION['ch_school'], $_SESSION['ch_grade'], $_SESSION['ch_me']);
if (1 == 10)
    $temp_grade = '교무실';
else if (1 == 100)
    $temp_grade = '행정실';
else {
    $temp_grade = 1 . '학년';
}
$ch_names = array('학교', $temp_grade, 송중기);
$ddate = date('Y-m-d');

$date = new DateTime($ddate);
$week = 10;
$year = 2016;

if (empty($_REQUEST['week'])) {

    echo $array[0];
    echo $array[1];

    $this_week = 0;
} else {
    $this_week = $_REQUEST['week'];
}
$week += $this_week;


$weeks = getStartAndEndDate($week, $year);
function getStartAndEndDate($week, $year) {

    $time = strtotime("1 January $year", time());
    $day = date('w', $time);
    $time += ((7 * $week) + 1 - $day) * 24 * 3600;

    for ($i = 0; $i < 5; $i++) {
        $return[$i] = date('Y-m-d', $time);
        $time += 24 * 3600;
    }
    return $return;
}

$eventyear1 = new DateTime($weeks[0]);
$eventyear = $eventyear1 -> format("Y");
?>

<script>var year =   '<?= $eventyear ?>';</script>

<LINK REL="SHORTCUT ICON" HREF="./favicon.ico" />
<header id="header">

    <logo>
        <a href="./login.php"></a>
    </logo>
    <nav id="mainMenu">
        <ul style="height:40px;top:11px">

            <li >
                <a class="btn btn-info" href="sign.php">위크워크 가입하기</a>
            </li>

        </ul>
    </nav>
</header>
         
        <div id="wrapper" class=" " style="padding-top: 0px;padding-bottom: 0px;padding-right: 0px; ">
            
                <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <!-- <li class="sidebar-brand">
                      &nbsp; 메뉴
                </li> -->
              <!--  <li>
                    <a href="#" data-toggle="collapse" data-target="#month">1달보기</a>
                    <div id="month" class="collapse">
                        1달 보기 메뉴
                    </div>
                </li>
                <li>
                    <a href="#" data-toggle="collapse" data-target="#search">검색</a>
                     <div id="search" class="collapse">
                         검색 메뉴
                    </div>
                </li>
            -->
                <li >
                    <a href="#" data-toggle="collapse" style="font-size: 1.3em">&nbsp;&nbsp;<? echo $temp_grade.' 쪽지함'; ?></a>
                    <div id="chat_parent"  >
                   <table class="chat_table" style="background:#F8F8F8;color:#000; border-radius: 10px 10px 10px 10px; table-layout: fixed" align="center"  >
                               <tr class="" style="border-radius: 10px 0 0 0; ">
                                   <td    class="content" style="vertical-align:top;  width:70%;border-top-style:none; border-right-style:none; ">
                                      <div id="chat" style="text-align:left; overflow-y:scroll;margin:10px;width:360px;height: 70vh;">
                                          대화를 주고 받을 수 있는 쪽지함입니다.<br>대화내용은 동학년 선생님만 볼 수 있습니다.
                                      </div>
                                   </td>
                                </tr>
                                 
                     </table>
                    </div>
                </li>
                <!-- <li>
                    <a href="#" data-toggle="collapse" data-target="#favorite">&nbsp;&nbsp;즐겨찾기</a>
                    <div id="favorite" class="collapse">
                    즐겨찾기 메뉴
                    </div>
                </li> -->
                <h5 style="width:100%;text-align: center">  
                    <span style="font-style: bold">&lt;알림 &gt;</span> 위크워크는 인터넷 익스플로러 11,<br> 크롬브라우저에 최적화 되어있습니다.
                </h5>
            </ul>
        </div>
        <!-- /#sidebar-wrapper -->
       
        
        <div id="page-content-wrapper" style="">
            <div class="container-fluid" style="">
                <table style="width:100%;height:30px;margin-top: 10px;">
                    <tr>
                        <td style="width:20%;">
                             <a href="#menu-toggle" style="background: #EB625E;color:#fff;" class="btn glyphicon <?
                             if($_SESSION['side']==0)
                                 echo 'glyphicon-envelope';
                             else
                                echo 'glyphicon-arrow-left';
                             ?>" id="menu-toggle"></a>
                        </td>
                        <td style="width:20%;text-align: right">
                        </td>
                        <td style="width:20%;text-align: center">                              
                        </td>
                        <td style="width:20%;text-align: left">                              
                        </td>
                        <td style="width:20%;">
                        </td>
                    </tr>
                </table>
                <div class="row">
                    <div class="col-lg-12">
                            <div  id='content'  >
                                <br>
                                <table class="time_table" style="table-layout: fixed;" align="center"  >
                                    <tr class="row1" style="border-radius: 10px 0 0 0; ">
                                        <td class=" cell1 center " style="width:120px;font-size:25px;border-top-style:none;border-left-style:none; border-radius: 10px 0 0 0; "><?php
                                        echo(int)date("m", strtotime($weeks[0])) . "월";
                                        ?></td>
                                        <td class="center" style="padding-top: 20px;border-top-style:none;vertical-align: top">
                                            월요일
                                            <span style="font-size:17px;vertical-align: top">(<?php echo(int)date("d", strtotime($weeks[0])) . "일"; ?>)</span>
                                            <span class="week" style="font-size:17px;white-space: pre-wrap; "  id="<?php echo $weeks[0]; ?>"> </span>
                                        </td>
                                        <td class="center" style="padding-top: 20px;border-top-style:none;vertical-align: top">화요일
                                            <span style="font-size:17px;">(<?php echo(int)date("d", strtotime($weeks[1])) . "일"; ?>)</span>
                                            <span class="week" style="font-size:17px;white-space: pre-wrap; " id="<?php echo $weeks[1]; ?>"> </span>
                                        </td>
                                        <td class="center" style="padding-top: 20px;border-top-style:none;vertical-align: top">수요일
                                            <span style="font-size:17px;">(<?php echo(int)date("d", strtotime($weeks[2])) . "일"; ?>)</span>
                                            <span class="week" style="font-size:17px;white-space: pre-wrap; "  id="<?php echo $weeks[2]; ?>"> </span>
                                        </td>
                                        <td class="center" style="padding-top: 20px;border-top-style:none;vertical-align: top">목요일
                                            <span style="font-size:17px;">(<?php echo(int)date("d", strtotime($weeks[3])) . "일"; ?>) </span>
                                            <span class="week" style="font-size:17px;white-space: pre-wrap; "  id="<?php echo $weeks[3]; ?>"> </span>
                                       </td>
                                        <td class="cell2 center" style="padding-top: 20px;border-top-style:none;border-right-style:none; border-radius: 0 10px 0 0;vertical-align: top">금요일 
                                            <span style="font-size:17px;">(<?php echo(int)date("d", strtotime($weeks[4])) . "일"; ?>) </span>
                                            <span class="week" style="font-size:17px;white-space: pre-wrap; "  id="<?php echo $weeks[4]; ?>"> </span>
                                       </td>
                                    </tr>
                                    <?php
                                    // 한 채널의 work 배치(표 한줄 완성)
                                    for ($i = 0; $i < count($ch_ids); $i++) {
                                        echo "<tr id='" . $ch_ids[$i] . "' ch_name='" . $ch_names[$i] . "'>";

                                        if ($i < (count($ch_ids) - 1)) {
                                            echo "<td class='center' style='border-left-style:none;width: 60px;background-color:#e3f3f7;'>" . $ch_names[$i] . "</td>";
                                            for ($j = 0; $j < 5; $j++) {
                                                if ($i == (count($ch_ids) - 1) && $j == (4)) {
                                                    if ($ddate == $weeks[$j])
                                                        echo "<td style='background:#fff7e3;border-right-style:none;border-bottom-style:none; border-radius: 0 0 10px 0;text-align:center;font-size:30px' class='work' id='" . $weeks[$j] . "'>";
                                                    else
                                                        echo "<td style='border-right-style:none;border-bottom-style:none; border-radius: 0 0 10px 0;text-align:center;font-size:30px' class='work' id='" . $weeks[$j] . "'>";
                                                } else {
                                                    if ($ddate == $weeks[$j])
                                                        echo "<td style='background:#fff7e3;text-align:center;font-size:30px' class='work' id='" . $weeks[$j] . "'>";
                                                    else
                                                        echo "<td style='text-align:center;font-size:30px' class='work' id='" . $weeks[$j] . "'>";
                                                }
                                                echo '<button class="btn btn-default work" style="border:1px solid #cfebf2; display:block;margin-top:10px;margin-bottom:10px;" onclick="newWork(' . $ch_ids[$i] . ',\'' . $ch_names[$i] . '\',\'' . $weeks[$j] . '\')">+</button>';
                                            }
                                        } else {
                                            echo "<td class='center' style='border-left-style:none;border-bottom-style:none; border-radius: 0 0 0 10px;width: 60px;background-color:#e3f3f7;'>" . $ch_names[$i] . "</td>";
                                            for ($j = 0; $j < 5; $j++) {
                                                if ($i == (count($ch_ids) - 1) && $j == (4)) {
                                                    if ($ddate == $weeks[$j])
                                                        echo "<td style='background:#fff7e3;border-right-style:none;border-bottom-style:none; border-radius: 0 0 10px 0;text-align:center;font-size:30px' class='work' id='" . $weeks[$j] . "'>";
                                                    else
                                                        echo "<td style='border-right-style:none;border-bottom-style:none; border-radius: 0 0 10px 0;text-align:center;font-size:30px' class='work' id='" . $weeks[$j] . "'>";
                                                } else {
                                                    if ($ddate == $weeks[$j])
                                                        echo "<td style='border-bottom-style:none;background:#fff7e3;text-align:center;font-size:30px' class='work' id='" . $weeks[$j] . "'>";
                                                    else
                                                        echo "<td style='border-bottom-style:none;text-align:center;font-size:30px' class='work' id='" . $weeks[$j] . "'>";
                                                }
                                                echo '<button class="btn btn-default work" style="border:1px solid #cfebf2;display:block;margin-top:10px;margin-bottom:10px;" onclick="newWork(' . $ch_ids[$i] . ',\'' . $ch_names[$i] . '\',\'' . $weeks[$j] . '\')">+</button>';
                                            }
                                        }

                                        echo "</td>";

                                        echo "</tr>";
                                    }
                                    ?>
                                </table>
                                <br>
                                
                                <form id="workList"  style="display: none;" action="file.php" method="post" enctype="multipart/form-data"  onsubmit="return formValidate();">
                                <table width="100%;">
                                    <tr>
                                        <td style="width:70%;">
                                            <h2 id="workDate" style="margin-top: 10px" user="<?php echo "thdwndrl"; ?>" >제목</h2> 
                                        </td>
                                        <td style="width: 30%;text-align: right">
                                            <button style="height:35px;width:150px;" type="button"  class="btn btn-success" onclick="toMyWork()">나의 할일로 등록</button>
                                        </td>
                                    </tr>                                    
                                </table>
                                <input id="work_id" type="hidden" name="work_id" value=<?php
                                if (isset($_REQUEST['work_id'])) {
                                    echo $_REQUEST['work_id'];
                                } else {
                                    echo 0;
                                }
                                ?>/>
                                <input id="flag_select" type="hidden" name="select" value="upload"/>
                                <input id="work_day" type="hidden" name="work_day" value=0/>
                                <input id="work_ch_id" type="hidden" name="work_ch_id" value=0/>
                                 <table class="time_table" style="table-layout: fixed" align="center"  >
                                    <tr class="" style="border-radius: 10px 0 0 0; ">
                                        <td   class="content " style=" width:7%;border-top-style:none;border-left-style:none; border-right-color:white; border-bottom-color:white; border-radius: 10px 0 0 0; font-weight: bold;font-size:20px ">
                                           
                                            <button id="work_complete_btn" style="height: 50px;padding:inherit ;text-align: center;" type="button" class="btn btn-info has-spinner glyphicon">
                                            </button>
                                         </td>
                                        <td  class="content"  style="width:40%;border-top-style:none;border-left-color:white;  border-bottom-color:white; font-weight: bold;font-size:20px ">
                                            <input id="work_title" style="height:40px;width:100%;" type="text" name="work_name" placeholder="제목"/>
                                            </td>
                                         
                                        
                                        <td rowspan="2"  class="content" style="vertical-align:top;  width:70%;border-top-style:none; border-right-style:none; border-radius: 0 10px 0 0;">
                                            <div id="reply" style="text-align:left; overflow-y:scroll;margin:10px;">
                                            
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="" style="border-radius: 10px 0 0 0; ">
                                        <td class="content " id="work_content_td" colspan="2" style="border-bottom-style:none;border-left-style:none;">
                                                <textarea class="contents" type="text" name="work_content" id="work_content" placeholder="내용" ></textarea>                                                                                           
                                                <p style="white-space: pre-wrap" class="contents" id="work_content_view"></p>                                                                                           
                                         </td>    
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="content" style="width:15%;border-left-style:none;border-top-style:none;border-bottom-color:white; ">
                                            <input class="file" type="file" name="file" id="work_file_add" style="display:none"/>
                                            <div id="work_file_btns" class="btn-group" style="display:none; width:100%;">
                                             <button id="work_file_down" class="btn btn-info" type="button" style="width:88%;height:35px" >
                                                 첨부파일
                                                 </button>
                                             <button id="work_file_del" class="btn btn-danger glyphicon glyphicon-trash" type="button" style="width:12%;height:35px" >

                                                 </button>
                                             </div>
                                         </td> 
                                        <td class="content" style="width:15%;border-right-style:none;border-top-style:none;border-bottom-color:white; ">
                                              <div class="form-group" style="">
                                            <div class="col-sm-12">
                                            <input class="file" type="file" name="reply_file" id="reply_file_add"  />
                                            </div>
                                            </div>
                                         </td> 
                                    </tr>
                                    <tr>
                                          <td colspan="5"  class="content" style="width:40%;border-left-style:none;border-bottom-style:none;   font-weight: bold;font-size:10px;border-radius: 0 0 0 10px  ;  ">
                                              <h4>워크와 댓글은 작성할 수 없어요~!<br>
 위크워크에 가입해서  직접 이용해볼까요?<br>
가입은 오른쪽 위에 있어요~</h4>
                                         </td>
                                    </tr>
                                </table>
                                </form>
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

        </div><!-- /#wrapper -->
         
<div class="overlay overlay_ctrl" >
</div>
        <div id="dialog" title="알림" style="display: none">
  <p>연구실에 새 메세지가 도착했습니다.</p>
</div>
<div id="help_chat" class="hide">
     <div id="help_chat_parent"  >
                   <table class="help_chat_table" style="background:#F8F8F8;color:#000; border-radius: 10px 10px 10px 10px; table-layout: fixed" align="center"  >
                               <tr class="" style="border-radius: 10px 0 0 0; ">
                                   <td class="content" style="vertical-align:top;  width:70%;border-top-style:none; border-right-style:none; ">
                                      <div id="help_chat_content" style="text-align:left; overflow-y:scroll;margin:10px;height: 400px;">
                                          안녕하세요. 선생님!<br><br> 저희 위크워크를 사용하시면서 궁금하신 점이나 불편하신 점이 있으면 언제든 말씀해 주시기 바랍니다.<br><br> 이 곳은 선생님과 저희 위크워크만 볼 수 있는 공간이니 편하게 말씀하셔도 됩니다.^^
                                      </div>
                                   </td>
                                </tr>
                                <tr>
                                   <td class="content"  style="width:10%;border-bottom-style:none;border-right-style:none; border-left-color:white; border-radius: 0 0 10px  0;">
                                      <div class="form-group" style="height:50px;margin-bottom:0px;line-height: 0px">
                                         <div class="col-sm-8" style="padding:5px;">
                                            <input id="help_chat_input" type="text" name="reply_content" style="height:30px; width:100%" class="form-control"   checked="0" placeholder=""/>
                                         </div>
                                         <div class="col-sm-4" style="padding:5px;">
                                            <button id="help_chat_submit" class = "btn btn-info form-control " type="button"  style=" width: 100%px;height:30px;" onclick="sendHelp()">보내기</button>
                                         </div>
                                      </div>
                                   </td>
                                </tr>
                     </table>
                    </div>
</div>
<div id="help_btn" class="hide">
    <img style="width:62px;height:64px" src="img/help.png" onclick="toggle_help()" />
</div>
 
            <div id="dialog-confirm2" title="알림" style="display:none;">
                  <img src="./img/example_main.png"  class="displayed" style="width:800px; display: block; margin-left: auto; margin-right: auto"></img>
            </div>
    
        <!-- Menu Toggle Script -->
        <script>
               $(function() {
                    $("#dialog-confirm2").css("display", "block");
                    $("#dialog-confirm2").dialog({
                        resizable : false,
                        width : 900,
                        height : 730,
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
          var is_side;
            $("#menu-toggle").click(function(e) {
                e.preventDefault();
                $("#wrapper").toggleClass("toggled");
                    chat_no=server_chat_no;
                    
                     $('#menu-toggle').pulse('destroy');
                if ($("#wrapper").hasClass("toggled")) {
                    $(this).attr("class", "btn glyphicon glyphicon-envelope");
                     side(0);
                } else {
                    $(this).attr("class", "btn glyphicon glyphicon-arrow-left");
                     $("#menu-toggle").text("");
                     side(1);
                }
            });
            
            function toggle_help(){
                $("#help_chat").toggleClass("hide");
                getHelp();
            }
            
            function side(side) {
                    is_side=side;
                    var request = $.ajax("db.php", {
                        type : "GET",
                        data : {
                            select : "side",
                            side:side
                        }
                
                    });
                
                    request.done(function() {
                    });
                
                    request.fail(function(jqXHR, textStatus, errorThrown) {
                    });

              }
              
              
    </script>
        <script src="example.js"></script>
        <script src="example_reply.js"></script>

        <?php
        include_once ("./tail.php");
        ?>
        
    </body>

</html>
