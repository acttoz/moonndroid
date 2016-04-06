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
    </head>

    <body >
 <?php
include_once ('./header.php');
         ?>
        <div id="wrapper">
                            <div  id='content'  >
                                <table class="time_table" style="table-layout: fixed;" align="center"  >
                                    <tr class="row1" style="border-radius: 10px 0 0 0; ">
                                        <td class=" cell1 center " style="font-size:25px;border-top-style:none;border-left-style:none; border-radius: 10px 0 0 0; "><?php
echo (int)date("m", strtotime($weeks[0])) . "월";
                                        ?></td>
                                        <td class="center" style="border-top-style:none;">월요일<span style="font-size:17px;">(<?php echo (int)date("d", strtotime($weeks[0]))."일"; ?>)
                                        </span></td>
                                        <td class="center" style="border-top-style:none;">화요일<span style="font-size:17px;">(<?php echo (int)date("d", strtotime($weeks[1]))."일"; ?>)
                                        </span></td>
                                        <td class="center" style="border-top-style:none;">수요일<span style="font-size:17px;">(<?php echo (int)date("d", strtotime($weeks[2]))."일"; ?>)
                                       </span> </td>
                                        <td class="center" style="border-top-style:none;">목요일<span style="font-size:17px;">(<?php echo (int)date("d", strtotime($weeks[3]))."일"; ?>)
                                       </span> </td>
                                        <td class="cell2 center" style="border-top-style:none;border-right-style:none; border-radius: 0 10px 0 0;"> 금요일<span style="font-size:17px;">(<?php echo (int)date("d", strtotime($weeks[4]))."일"; ?>)
                                        </span></td>
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
                                            echo '<button class="btn btn-default work" style="display:block;margin-top:10px;margin-bottom:10px; " onclick=newWork(' . $ch_ids[$i] . ',"' . $ch_names[$i] . '","' . $weeks[$j] . '")>+</button>';
                                        }

                                        echo "</td>";

                                        echo "</tr>";
                                    }
                                    ?>
                                </table>
                                <br>
                                
                                <form id="workList"  style="display: none;" action="file.php" method="post" enctype="multipart/form-data"  onsubmit="return formValidate();">
                                <h2 id="workDate"  user="<?php echo $_SESSION["id"]; ?>" >제목</h2> 
                                <input id="work_id" type="hidden" name="work_id" value=
                                <?php
                                if (isset($_REQUEST['work_id'])) {
                                    echo $_REQUEST['work_id'];
                                } else {
                                    echo 0;
                                }
                                ?>
                                />
                                <input id="flag_select" type="hidden" name="select" value="upload"/>
                                <input id="work_day" type="hidden" name="work_day" value=0/>
                                <input id="work_ch_id" type="hidden" name="work_ch_id" value=0/>
                                 <table class="time_table" style="table-layout: fixed" align="center"  >
                                    <tr class="" style="border-radius: 10px 0 0 0; ">
                                        <td colspan="1"  class="content " style=" width:7%;border-top-style:none;border-left-style:none; border-right-color:white; border-bottom-color:white; border-radius: 10px 0 0 0; font-weight: bold;font-size:20px ">
                                           
                                            <button id="work_complete_btn" style="height: 50px;" type="button" class="btn btn-info has-spinner glyphicon">
                                            </button>
                                         </td>
                                        <td colspan="4" class="content"  style="width:40%;border-top-style:none;border-left-color:white;  border-bottom-color:white; font-weight: bold;font-size:20px ">
                                            <input id="work_title" type="text" name="work_name" placeholder="제목"/>
                                            </td>
                                         
                                        
                                        <td  colspan="5" rowspan="2"  class="content" style="vertical-align:top ;  width:70%;border-top-style:none; border-right-style:none; border-radius: 0 10px 0 0;">
                                            <div id="reply" style="overflow-y:scroll;margin-top:15px;margin-right:10px;margin-bottom: 10px ">
                                            
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="" style="border-radius: 10px 0 0 0; ">
                                        <td class="content " colspan="5" style="border-bottom-style:none;border-left-style:none;">
                                            <div  style=" ">
                                                <textarea  class="contents" type="text" name="work_content" id="work_content" placeholder="설명" ></textarea>                                                                                           


                                            </div></td>    
                             
                                          
                                    </tr>
                                    <tr>
                                        <td colspan="5" class="content "style="width:15%;border-left-style:none;border-top-style:none;border-bottom-color:white; ">
                                            <input class="file" type="file" name="file" id="work_file_add" style="display:none"/>
                                            <div id="work_file_btns" class="btn-group" style="display:none; width:100%;">
                                             <button id="work_file_down" class="btn btn-info" type="button" style="width:88%;height:35px" >
                                                 첨부파일
                                                 </button>
                                             <button id="work_file_del" class="btn btn-danger glyphicon glyphicon-trash" type="button" style="width:12%;height:35px" >

                                                 </button>
                                             </div>
                                         </td> 
                                        <td colspan="5" class="content "style="width:15%;border-right-style:none;border-top-style:none;border-bottom-color:white; ">
                                            <input class="file" type="file" name="reply_file" id="reply_file_add"  />
                                         </td> 
                                    </tr>
                                    <tr>
                                        
                                          <td colspan="5"  class="content " style="width:80%;border-left-style:none;border-bottom-style:none;   font-weight: bold;font-size:10px;border-radius: 0 0 0 10px  ;  ">
                                             <div class="btn-group " style=" width:100%;">
                                            <button id="work_edit_btn"type="button" style="width:80%;height: 50px;" class="btn btn-info" onclick="editMode()">
                                                                                        수정
                                            </button>
                                            <button id="work_save_btn" name="submit" style="width:80%;height: 50px;display:none" type="submit" class="btn btn-info btn-warning" >
                                                                                        저장
                                            </button>
                                            <button id="work_delete_btn" style="width:20%;height: 50px;" type="button" class="btn btn-danger glyphicon glyphicon-trash">
                                            </button>
                                            </div>
                                         </td>
                                         
                                        <td   class="content " colspan="4" style="width:100%; border-top-style:none;border-bottom-style:none; border-right-color:white; font-weight: bold;font-size:10px ">
                                                        <textarea id="reply_input" type="text" name="reply_content" style="height:50px; width:100%" class="form-control"   checked="0" placeholder="댓글을 입력하세요."></textarea>
                                         </td>
                                         <td class="content " style="width:100%;border-bottom-style:none;border-right-style:none; border-left-color:white; border-radius: 0 0 10px  0;">
                                                <input id="reply_submit" class = "btn   btn-info" type="submit" name="submit" style="margin-top:1px;width: 100%;height:50px;" value="댓글 달기"/>
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

            <!-- /#page-content-wrapper -->

        </div>
        <!-- /#wrapper -->
<div class="overlay overlay_ctrl" >
</div>
        <!-- Menu Toggle Script -->
        <script src="week.js"></script>
        <script src="./js/reply.js"></script>

        <?php
        include_once ("./tail.php");
        ?>
    </body>

</html>
