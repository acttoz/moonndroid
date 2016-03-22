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
         <?php
		include_once ('./header.php');
            ?>
         <div align="center" style="padding-top:30px; text-align: center;	margin-left: auto;	margin-right: auto;width:80%;display:table" >
            <div class="board" style="font-size: 20px;">
               <table style="width:100%">
                  <tr>
                     <td style="width: 20%;font-weight: bold;">안내장 샘플</td>
                     <td style="width: 40%"><a href="./sample/sample_iphone.hwp" download type="button" class="btn btn-info" onclick=toNext() style="width:80%">아이폰용 받기</a><br/><div style="text-align:center;width:100%;font-size: 0.7em">안내장의 <span style="color:red">빨간색</span> 부분을 수정하여 이용하세요.</div></td>
                     <td style="width: 40%"><a href="./sample/sample_android.hwp" download type="button" class="btn btn-info" onclick=toNext() style="width:80%">안드로이드용 받기</a><br/><div style="text-align:center;width:100%;font-size: 0.7em">안내장의 <span style="color:red">빨간색</span> 부분을 수정하여 이용하세요.</div>
                     </td>
                  </tr>
               </table>
            </div>
         </div>
         <br>
         <div align="center" style="height:300px; text-align: center;	margin-left: auto;	margin-right: auto;width:80%;display:table" >
            <div class="board" style="font-size: 20px;">
               <form method="POST" action="help_db.php" style="padding-top: 10px;width:100%;height: 270px;">
                  <table style="padding-top: 10px;width:100%;height: 100%;">
                     <tr style="height:100%">
                        <td style="width: 20%;vertical-align: middle;font-weight: bold;">문의하기</td>
                        <td style="width: 80%;"><textarea type="text" name="content" style="width: 90%;height:200px;border-radius: 10px;border: 1px solid #eb625e;"></textarea>
                        	<input type="hidden" name="select" value="commit">
                        </td>
                     </tr>
                     <tr>
                        <td></td>
                        <td style="width: 80%"><button type="submit" class="btn btn-info" style="width: 90%">
                           전송
                           </button>
                        </td>
                     </tr>
                  </table>
               </form>
            </div>
         </div>
         <br>
          
         <div align="center" style=" text-align: center;	margin-left: auto;	margin-right: auto;width:80%;display:table" >
            <div class="board" style="padding:5px;font-size: 20px;">
               <?
			include_once ('./config.php');

			$result = mysql_query("SELECT * FROM help ORDER BY id DESC");
			while ($row = mysql_fetch_array($result)) {
				echo '<dl style="background:#cfebf2;border: 2px solid #cfebf2;border-radius: 5px;" class="dl-horizontal">
						<dt style="text-align:right;font-size:15px;">' . $row[mail] . '</dt>
						<dd style="text-align:left;font-size:15px;">: ' . $row[content] . '<span style="font-size:12px;">(' . $row[date] . ')';
						if($_SESSION[id]==$row[mail]){
						echo '<button class="btn btn-info" style="width:60px;height:30px;" onclick=fndelete('.$row[id].')>
                           삭제
                           </button>';
						}
						echo '<span></dd></dl>';

				if ($row[reply] != "") {
					echo '<dl style="background:#e6eff2;border: 2px solid #e6eff2;border-radius: 5px;" class="dl-horizontal">
						<dt style="text-align:right;font-weight:normal;font-size:15px;">문샘</dt>
						<dd style="text-align:left;font-size:15px;">: ' . $row[reply] .'<span style="font-size:12px;"></dd></dl>';

				}
				echo '<br/>';

			}
			mysql_close($connect);
					?>
            </div>
         </div>
         <br>
          

         <br>
         <!-- <img src="./img/help.png" style="text-align: center;color: #ffffff;	width: 100%;position: absolute;	bottom: 0;	left: 0;width:100%; padding-left:10%;padding-right:10%;" class="center"> -->
         <br>
         <footer><?php
		include_once ('./footer.php');
            ?></footer>
      </div>
      <script>
      	function fndelete(mId){
      		location.href="help_db.php?select=delete&id="+mId;
      	}
      </script>
   </body>
</html>
