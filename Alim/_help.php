<?
session_start();
   ?>
<!DOCTYPE html>
<html lang="ko">
   <head>
      <?
	include_once ('./framework.php');
         ?>
      <link href="css/timetable.css" rel="stylesheet" type="text/css">
   </head>
   <body id="home">
      <div id="wrapper">
         
          
            <div style="width:100%;padding:5px;font-size: 20px;">
               <?
			include_once ('./config.php');

			$result = mysql_query("SELECT * FROM help ORDER BY id DESC");
			while ($row = mysql_fetch_array($result)) {
				echo '<dl style="background:#cfebf2;border: 2px solid #cfebf2;border-radius: 5px;" class="dl-horizontal">
						<dt style="text-align:left;font-size:15px;">' . $row[mail] . '</dt>
						<dd style="text-align:left;font-size:15px;">:' . $row[content] . '<span style="font-size:12px;">(' . $row[date] . ')<span></dd></dl>';

				if (true) {
					echo '<dl style="background:#e6eff2;border: 2px solid #e6eff2;border-radius: 5px;" class="dl-horizontal">
						
						<dd style="text-align:left;font-size:15px;"><form action="_help_db.php" method="POST">' ;
						echo '<div class="form-group">
						<div class="col-sm-10">
						<input  type="hidden" name="id" type="text" value="'.$row[id].'">
						<textarea style="width:100%;" name="reply" type="text" value="">'.$row[reply].'</textarea>
					</div>
						<div class="col-sm-2">
						<input style="width:100%;" type="submit" class="btn btn-info " value="저장">
					</div></form></dd></dl>
					
						';

				}

			}
			mysql_close($connect);
					?>
            </div>
         </div>
         <br>
          

         <br>
         <!-- <img src="./img/help.png" style="text-align: center;color: #ffffff;	width: 100%;position: absolute;	bottom: 0;	left: 0;width:100%; padding-left:10%;padding-right:10%;" class="center"> -->
         <br>
         
      </div>
      <script type="text/javascript">
		var url = window.location.href;
		if (url.substring(35, 36) == "1") {
			alert("접수 완료.\n답변은 선생님의 이메일을 통해 받아보실 수 있습니다.")
		}
      </script>
   </body>
</html>
