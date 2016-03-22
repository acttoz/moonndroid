<?
session_start();
if ($_SESSION['is_logged']) {
} else {
	Header("Location:m_login.php");
}
   ?>
<!DOCTYPE html>
<html lang="ko">
   <head>
      <?
	include_once ('./framework.php');
         ?>
         <link href="css/mobile.css" rel="stylesheet" type="text/css">
      <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
      <script src="//code.jquery.com/jquery-1.10.2.js"></script>
      <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
   </head>
   <body id="home">
       <header id="header">
         <logo style="left:0px" >
            <img style="height:18px;width:121px;" src="./img/logo.png"> 
         </logo>
         </div>
      </header>
      <div id="wrapper">
         <div id="content">
            <div id="margin" >
            	<table class="today_menu">
                  <tr>
                     <td class="col2" rowspan="2" align="center" style="padding-right: 10px;">
                        <table class="time_table" align="center" style="border-top-left-radius: 10px;border-top-right-radius: 10px;border-bottom-left-radius: 10px;border-bottom-right-radius: 10px;" >
                           <tr class="row2">
                              <?php
							include_once ('./config.php');
							$week2 = 1;
							$today = date("d");
							if (date("w") < 5) {
								$week2 = date("w") + 1;
							} else {
								$week2 = 1;
							}

							$result = mysql_query("SELECT * FROM w_" . $week2 . " WHERE id='" . $_SESSION[id] . "'");
							$result2 = mysql_query("SELECT d1,d2,d3,d4,d5,day,today FROM member WHERE id='${_SESSION[id]}'");
							$array = mysql_fetch_array($result);
							$content = mysql_fetch_array($result2);

							if ($content['d5'] == "") {
								$sql = "UPDATE member SET today=${today} WHERE id='${_SESSION['id']}'";
								mysql_query($sql, $connect);
							} else if ($today != $content['today']) {
								$sql = "UPDATE member SET d1='${content['d2']}',d2='${content['d3']}',d3='${content['d4']}',d4='${content['d5']}',d5='',today=${today} WHERE id='${_SESSION['id']}'";
								mysql_query($sql, $connect);
								$result2 = mysql_query("SELECT d1,d2,d3,d4,d5,day,today FROM member WHERE id='${_SESSION[id]}'");
								$content = mysql_fetch_array($result2);
							}

							mysql_close($connect);
                                 ?>
                              <td style="color: white;background-color: #59c2d8;" id="week"><?$weeks = array("일", "월", "화", "수", "목", "금", "토");
									echo "(${weeks[($week2)]})";
                                 ?></td>
                              <?
                                 if(!$array['t1']=="")
                                 echo "<td>".mb_substr($array['t1'], 0, 2,'UTF-8')."</td>"
                                 ?>
                              <?
                                 if(!$array['t2']=="")
                                 echo "<td>".mb_substr($array['t2'], 0, 2,'UTF-8')."</td>"
                                 ?>
                              <?
                                 if(!$array['t3']=="")
                                 echo "<td>".mb_substr($array['t3'], 0, 2,'UTF-8')."</td>"
                                 ?>
                              <?
                                 if(!$array['t4']=="")
                                 echo "<td>".mb_substr($array['t4'], 0, 2,'UTF-8')."</td>"
                                 ?>
                              <?
                                 if(!$array['t5']=="")
                                 echo "<td>".mb_substr($array['t5'], 0, 2,'UTF-8')."</td>"
                                 ?>
                              <?
                                 if(!$array['t6']=="")
                                 echo "<td>".mb_substr($array['t6'], 0, 2,'UTF-8')."</td>"
                                 ?>
                              <?
                                 if(!$array['t7']=="")
                                 echo "<td>".mb_substr($array['t7'], 0, 2,'UTF-8')."</td>"
                                 ?>
                           </tr>
                        </table>
                     </td>
                     <td class="col3" style="padding-top: 3px; ">
                        <button type="button" class="btn btn-info" id="previous" onclick=daySelect(-1) >
                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                        </button>
                     </td>
                  </tr>
                  <tr>
                     <td class="col3" style="padding-bottom: 4px; ">
                        <button type="button" class="btn btn-info" id="next" onclick=daySelect(1)>
                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                        </button> 
            </div>
            </td>
            </tr>
            </table>
               <div class="btn-group inline" style="width:100%;">
                           <!-- <button type="button"  style="width:50%;"class="btn btn-info"   onclick="save()">
                          저장하기
                           </button> -->
                           <button type="button" style="width:100%;"class="btn btn-success"   onclick="upload()">
                           보내기
                           </button>
                        </div>
                        <br/>
                        <br/>
               <textarea class="contents" id="content1" readonly style="display:none;color:#59C2D8"><?
			if ($content['d1'] == "") {
				echo "내용없음";
			} else {
				echo $content['d1'];
			}
                  	?></textarea>
               <textarea class="contents" id="content2" readonly style="display:none;color:#59C2D8 "><?
			if ($content['d2'] == "") {
				echo "내용없음";
			} else {
				echo $content['d2'];
			}
                  ?></textarea>
               <textarea class="contents" id="content3" readonly style="display:none;color:#59C2D8 "><?
			if ($content['d3'] == "") {
				echo "내용없음";
			} else {
				echo $content['d3'];
			}
                  ?></textarea>
               <textarea class="contents" id="content4" readonly style="display:none;color:#59C2D8 "><?
			if ($content['d4'] == "") {
				echo "내용없음";
			} else {
				echo $content['d4'];
			}
                  ?></textarea>
               </textarea>
              
               <textarea class="contents" id="content5" user_id="<? echo $_SESSION[id]; ?>" day="<? echo $content['day']; ?>" today="<? echo $today; ?>" placeholder="알림장쓰기" style="display:block;"><?

			$s = $weeks[date("w")];

			if ($content['d5'] == "") {
				echo date("m") . "/" . date("d") . "(" . $s . ")\n";
			} else {
				echo $content['d5'];
			}
                  	?></textarea>
            </div>
         </div>
          
         
      </div>
      <script src="today.js"></script>
   </body>
</html>
