<?
session_start();
extract($_POST);
if ($post_id == null && $_REQUEST[id] == null) {
	header('Location: mobile_index.php');
}
      ?>
<!DOCTYPE html>
<html lang="ko">
   <head>
      <title>스피드 알림장</title >
      <meta http-equiv='Content-Type' content='text/html' charset='utf-8'>
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name= "viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0,maximum-scale=1.0, user-scalable=no" />
      <link rel="stylesheet" href="framework/css/bootstrap.css">
      <link href="css/_mobile.css" rel="stylesheet" type="text/css">
      <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
      <script src="framework/js/placeholder.js"></script>
      <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
      <script src="//code.jquery.com/jquery-1.10.2.js"></script>
      <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
      <!-- Link Swiper's CSS -->
   </head>
   <body id="home">
      <?
	if ($platform == 1) {echo '<header id="header">
                       <logo  >
                          <img style="height:18px;width:121px;" src="./img/logo.png"> 
                       </logo>
                       </div>
                    </header>';
	}
                    ?>
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

							
							if (date("H") < 12) {
								if (date("w") < 5) {
									$week2 = date("w");
								} else {
									$week2 = 5;
								}
							} else {
								if (date("w") < 5) {
									$week2 = date("w")+1;
								} else {
									$week2 = 1;
								}
							}

							if ($platform == 1) {
								$id = $post_id;
								$key = $post_key;
							} else {
								$id = $_REQUEST[id];
								$key = $_REQUEST[key];
							}
							$result = mysql_query("SELECT * FROM w_" . $week2 . " WHERE id='" . $id . "'");
							$result2 = mysql_query("SELECT d1,d2,d3,d4,d5,day FROM member WHERE id='${id}' AND class_key='${key}'");
							$array = mysql_fetch_array($result);
							$content = mysql_fetch_array($result2);

							mysql_close($connect);
                                                           ?>
                              <td style="color: white;background-color: #59c2d8;" id="week"><?
							if (!$array['t1'] == "") {
								$weeks = array("일", "월", "화", "수", "목", "금", "토");
								echo "(${weeks[($week2)]})";
							} else {
								echo "스피드알림장";
							}
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
                        <button type="button" class="btn btn-info" id="font_plus" onclick=fontResize(5)>
                        <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
                        </button>
                     </td>
                  </tr>
                  <tr>
                     <td class="col3" style="padding-bottom: 4px; ">
                        <button type="button" class="btn btn-info" id="font_minus" onclick=fontResize(-5)>
                        <span class="glyphicon glyphicon-minus-sign" aria-hidden="true"></span>
                        </button>
                     </td>
                  </tr>
               </table>
                <?
					if ($content['d5'] != "") {
						echo ' <div class="content" id="content5">' . nl2br($content['d5']) . '</div><br/>';

					}
                                         ?>
                                         
                                          <div class="content" id="content4"><?
					if ($content['d4'] == "") {
						echo "내용없음";
					} else {
						echo nl2br($content['d4']);
					}
                                         ?></div><br/>
                                         
                                           <div class="content" id="content3"><?
					if ($content['d3'] == "") {
						echo "내용없음";
					} else {
						echo nl2br($content['d3']);
					}
                                         ?></div><br/>
                                         
                                          <div class="content" id="content2"><?
					if ($content['d2'] == "") {
						echo "내용없음";
					} else {
						echo nl2br($content['d2']);
					}
                                         ?></div><br/>
                                         
                      <div class="content" id="content1"><?
					if ($content['d1'] == "") {
						echo "내용없음";
					} else {
						echo nl2br($content['d1']);
					}
                                         	?></div>
                                         	
                                         	<br/>
                    
                    
                   
                    
                  </div>
                   
               </div>
               
               <?
	if ($platform == 1) {echo '<div id="margin">
            <button type="button" style="width:100%;" class="btn btn-info" onclick=logOut()>
							로그아웃
						</button>
                    </div>';
	}
                    ?>
                
			
						
						<br/>
            </div>
         </div>
      </div>
      <script src="_mobile_today.js"></script>
      <!-- Swiper JS -->
      <!-- Initialize Swiper -->
      <script></script>
   </body>
</html>