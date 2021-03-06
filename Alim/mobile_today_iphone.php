<!DOCTYPE html>
<html lang="ko">
   <head>
      <title>스피드 알림장</title >
      <LINK REL="SHORTCUT ICON" HREF="./favicon.ico" />
      <meta http-equiv='Content-Type' content='text/html' charset='utf-8'>
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name= "viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0,maximum-scale=1.0, user-scalable=no" />
      <link rel="stylesheet" href="framework/css/bootstrap.css">
      <link href="css/mobile.css" rel="stylesheet" type="text/css">
      <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
      <script src="framework/js/placeholder.js"></script>
      <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
      <script src="//code.jquery.com/jquery-1.10.2.js"></script>
      <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
   </head>
   <body id="home">
      <header id="header">
         <logo  >
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
                                 if (date("w") < 5) {
                                 	$week2 = date("w") + 1;
                                 } else {
                                 	$week2 = 1;
                                 }
                                 
                                 $result = mysql_query("SELECT * FROM w_" . $week2 . " WHERE id='" . $_REQUEST[id] . "'");
                                 $result2 = mysql_query("SELECT d1,d2,d3,d4,d5,day FROM member WHERE id='${_REQUEST[id]}' AND class_key='${_REQUEST[key]}'");
                                 $array = mysql_fetch_array($result);
                                 $content = mysql_fetch_array($result2);
                                 
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
            <textarea id="content1" readonly style="display:none; "><?
               if ($content['d1'] == "") {
               	echo "내용없음";
               } else {
               	echo $content['d1'];
               }
               	?></textarea>
            <textarea id="content2" readonly style="display:none; "><?
               if ($content['d2'] == "") {
               	echo "내용없음";
               } else {
               	echo $content['d2'];
               }
               ?></textarea>
            <textarea id="content3" readonly style="display:none; "><?
               if ($content['d3'] == "") {
               	echo "내용없음";
               } else {
               	echo $content['d3'];
               }
               ?></textarea>
            <textarea id="content4" readonly style="display:none; "><?
               if ($content['d4'] == "") {
               	echo "내용없음";
               } else {
               	echo $content['d4'];
               }
               ?></textarea>
            </textarea>
            <textarea id="content5" readonly style="display:block;overflow: visible"><?
              if ($content['d5'] == "") {
							$week = array("일", "월", "화", "수", "목", "금", "토");
			$s = $week[date("w")];
			echo date("m") . "/" . date("d") . "(" . $s . ")\n";
							echo "내용없음";
						} else {
							echo $content['d5'];
						}
               ?></textarea>
            <br>
            <div style="position: relative;">
               <img style="display: block;
                  margin-left: auto;
                  margin-right: auto;height: 30px; " src="img/landscape_mobile.png" />
            </div>
         </div>
      </div>
      </div>
      <script src="mobile_today.js"></script>
   </body>
</html>