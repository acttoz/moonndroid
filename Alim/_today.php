<?
session_start();
$mobileKeyWords = array('iPhone', 'iPod', 'BlackBerry', 'Android', 'Windows CE', 'Windows CE;', 'LG', 'MOT', 'SAMSUNG', 'SonyEricsson', 'Mobile', 'Symbian', 'Opera Mobi', 'Opera Mini', 'IEmobile');
for ($i = 0; $i < count($mobileKeyWords); $i++) {
	if (strpos($_SERVER['HTTP_USER_AGENT'], $mobileKeyWords[$i]) == true) {
		header("Location: m_today.php");
		exit ;
	}
}
   ?>
<!DOCTYPE html>
<html lang="ko">
   <head>
      <?
	include_once ('./framework.php');
         ?>
      <link rel="stylesheet" href="./css/jquery-ui.css">
      <script src="//code.jquery.com/jquery-1.10.2.js"></script>
      <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
      <style>
      	.fill_parent{
      		width:100%;
      	}
      </style>
   </head>
   <body id="home">
      <div id="wrapper">
         <?php
		include_once ('./header.php');
         ?>
         <div id="content">
            <div id="margin" >
            	
               <table class="today_menu">
                  <tr>
                     <td class="col1">
                        <div style="padding-top: 4px">
                           <button type="button" class="btn btn-info fill_parent" id="font_plus" onclick=fontResize(5)>
                           <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
                           </button>
                        </div>
                     </td>
                     <td class="col2" rowspan="2" align="center" style="padding-left: 5px;padding-right: 5px">
                        <table class="time_table" align="center"  >
                           <?php
						include_once ('./config.php');
						$week = 1;
						$today = date("d");
						$week2 = array("일", "월", "화", "수", "목", "금", "토");
						if (date("w") < 5) {
							$week = date("w") + 1;
						} else {
							$week = 1;
						}

						$result = mysql_query("SELECT * FROM w_" . $week . " WHERE id='" . $_SESSION[id] . "'");
						$result2 = mysql_query("SELECT d1,d2,d3,d4,d5,day,today FROM member WHERE id='${_SESSION[id]}'");

						$content = mysql_fetch_array($result2);
						$array = mysql_fetch_array($result);

						if($content['d5'] == ""){
							$sql = "UPDATE member SET today=${today} WHERE id='${_SESSION['id']}'";
							mysql_query($sql, $connect);
						}else if ($today != $content['today']) {
							$sql = "UPDATE member SET d1='${content['d2']}',d2='${content['d3']}',d3='${content['d4']}',d4='${content['d5']}',d5='',today=${today} WHERE id='${_SESSION['id']}'";
							mysql_query($sql, $connect);
							$result2 = mysql_query("SELECT d1,d2,d3,d4,d5,day,today FROM member WHERE id='${_SESSION[id]}'");
							$content = mysql_fetch_array($result2);
						}
						mysql_close($connect);
                              ?>
                           <tr class="row1">
                              <td rowspan="2">내일(<?
			 echo $week2[$week];
                              	?>)
                                 <br/>
                                 시간표
                              </td>
                              <td>1</td>
                              <td>2</td>
                              <td>3</td>
                              <td>4</td>
                              <?
                                 if(!$array['t5']=="")
                                 echo "<td>5</td>"
                                 ?>
                              <?
                                 if(!$array['t6']=="")
                                 echo "<td>6</td>"
                                 ?>
                              <?
                                 if(!$array['t7']=="")
                                 echo "<td>7</td>"
                                 ?>
                           </tr>
                           <tr class="row2">
                              <td><?echo mb_substr($array['t1'], 0, 3,'UTF-8')?></td>
                              <td><?echo mb_substr($array['t2'], 0, 3,'UTF-8')?></td>
                              <td><?echo mb_substr($array['t3'], 0, 3,'UTF-8')?></td>
                              <td><?echo mb_substr($array['t4'], 0, 3,'UTF-8')?></td>
                              <?
                                 if(!$array['t5']=="")
                                 echo "<td>".mb_substr($array['t5'], 0, 3,'UTF-8')."</td>"
                                 ?>
                              <?
                                 if(!$array['t6']=="")
                                 echo "<td>".mb_substr($array['t6'], 0, 3,'UTF-8')."</td>"
                                 ?>
                              <?
                                 if(!$array['t7']=="")
                                 echo "<td>".mb_substr($array['t7'], 0, 3,'UTF-8')."</td>"
                                 ?>
                           </tr>
                        </table>
                     </td>
                     <td class="col3"  style="width: 15%" >
                        <div class="btn-group inline fill_parent" style="padding-top: 3px; ">
                           <button type="button" style="width: 50%" class="btn btn-info" id="previous" onclick=daySelect(-1)>
                           <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                           </button>
                           <button type="button" style="width: 50%"  class="btn btn-info" id="next" onclick=daySelect(1)>
                           <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                           </button>
                        </div>
                     </td>
                  </tr>
                  <tr>
                     <td class="col1">
                        <div style="padding-bottom: 4px">
                           <button type="button"  class="btn btn-info fill_parent" id="font_minus" onclick=fontResize(-5)>
                           <span class="glyphicon glyphicon-minus-sign" aria-hidden="true"></span>
                           </button>
                        </div>
                     </td>
                     <td class="col3" style="width: 15%">
                     	<div class="btn-group inline fill_parent" style="padding-bottom: 5px; ">
                           <!-- <button type="button"  style="width: 50%" class="btn btn-info" id="previous" onclick="save()">
                          저장하기
                           </button> -->
                           <button type="button"  style="width: 100%" class="btn btn-success" id="next" onclick="upload()">
                           보내기
                           </button>
                        </div>
                        
                     </td>
                  </tr>
               </table>
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
			
			$s = $week2[date("w")];

			if ($content['d5'] == "") {
				echo date("m") . "/" . date("d") . "(" . $s . ")\n";
			} else {
				echo $content['d5'];
			}
                  	?></textarea>
            </div>
         </div>
         <footer><?php
		include_once ('./footer.php');
            ?></footer>
         <div id="dialog-confirm" title="알림" style="display:none;"><?php
		include_once ('./today_notice.php');
            ?></div>
      </div>
      <script src="today.js"></script>
   </body>
</html>
