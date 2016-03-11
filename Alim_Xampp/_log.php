<?
session_start();
   ?>
<!DOCTYPE html>
<html lang="ko">
   <head>
       
   </head>
   <body id="home">
      <div id="wrapper">
         
          
            <div style="width:100%;padding:5px;font-size: 20px;">
               <?
			include_once ('./config.php');

			$result = mysql_query("SELECT * FROM log ORDER BY id ASC, time");
			while ($row = mysql_fetch_array($result)) {
				
				if($row[field]=="today")
				echo "<span style='color:red'>";
				else 
				echo "<span style='color:blue'>";
					
				
				echo $row[time]."   ".$row[field]."   ".$row[id]."   ".$row[name]."   ".$row[school].$row[grade]."   ".$row[ban]."   ".$row[class_key]."   ".$row[d5]."<br/> "."<br/> ";
				
				echo "</span>";
 
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
