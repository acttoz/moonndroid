<?
session_start();
?>
<!DOCTYPE html>
<html lang="ko">
	<head>
		<?
        error_reporting(0);
        include_once ('./framework.php');
		?>
		<link href="css/timetable.css" rel="stylesheet" type="text/css">
	</head>

	<body id="home">
		<div id="wrapper" style="min-height: 0px;">
			<?php

            include_once ('./header.php');
			?>
<br>
			<div  id='content' style="width:800px; display: block; margin-left: auto; margin-right: auto">
			    <h4 style="font-weight: bold">&lt;필수&gt; 학급코드를 정하셔야 스피드알림장을 이용하실 수 있습니다. 숫자 4자리로 정하고 학생과<br> 학부모에게 알려주세요.</h4>
			    <div style="padding-bottom: 30px" class="form-group">
                   <div class="col-sm-3" style="padding: 0px">
                        <div class="btn btn-danger form-control" id="submit_btn">
                            학급코드
                        </div>
                    </div>
                    <div class="col-sm-3" style="padding: 0px">
                        <input type="number" class="form-control" name="user_id" id="class_key" checked="0" value="<?
                        if ($_SESSION['class_key'] != '' && !empty($_SESSION['class_key'])) {echo $_SESSION['class_key'];
                        }
 ?>">
                    </div>
                    <div class="col-sm-3" style="">
                        <button type="button" class="btn btn-info form-control" onclick="submit_class_key()">
                            저장
                        </button>
                    </div>
                </div>
                <br>
                <br>
                
                <div class="board" style=" text-align:center; font-size: 20px; width: 100%;display: block">
               <table style="width:100%;margin-top: 13px;">
                  <tr>
                     <td style="width: 20%;font-weight: bold;">안내장 샘플</td>
                     <td style="width: 40%"><a href="./sample/sample_iphone.hwp" download type="button" class="btn btn-info" onclick=toNext() style="width:80%">아이폰용 받기</a><br/><div style="text-align:center;width:100%;font-size: 0.7em">안내장의 <span style="color:red">빨간색</span> 부분을 수정하여 이용하세요.</div></td>
                     <td style="width: 40%"><a href="./sample/sample_android.hwp" download type="button" class="btn btn-info" onclick=toNext() style="width:80%">안드로이드용 받기</a><br/><div style="text-align:center;width:100%;font-size: 0.7em">안내장의 <span style="color:red">빨간색</span> 부분을 수정하여 이용하세요.</div>
                     </td>
                  </tr>
               </table>
            </div>
                <div style="display:<?
                if ($_SESSION['class_key'] != '' && !empty($_SESSION['class_key'])) {echo "table";
                } else { echo "none";
                }
                ?>">
                <br>
                <br>
				    <h4 style="font-weight: bold">&lt;선택&gt; 기초시간표를 입력하시면 교사와 학생 모든 화면에 다음날 시간표가 표시되어 편리합니다.</h4>
				<table class="time_table" align="center" >
					<tr class="row1" style="border-radius: 10px 0 0 0; ">
						<td class="cell1" style="border-radius: 10px 0 0 0; "></td>
						<td>월</td>
						<td>화</td>
						<td>수</td>
						<td>목</td>
						<td class="cell2" style="border-radius: 0 10px 0 0;">금</td>
					</tr>
					<?php
                    include_once ('./config.php');

                    $result1 = mysql_query("SELECT * FROM w_1 WHERE id='" . $_SESSION[id] . "'");
                    $result2 = mysql_query("SELECT * FROM w_2 WHERE id='" . $_SESSION[id] . "'");
                    $result3 = mysql_query("SELECT * FROM w_3 WHERE id='" . $_SESSION[id] . "'");
                    $result4 = mysql_query("SELECT * FROM w_4 WHERE id='" . $_SESSION[id] . "'");
                    $result5 = mysql_query("SELECT * FROM w_5 WHERE id='" . $_SESSION[id] . "'");
                    $table = array(mysql_fetch_array($result1), mysql_fetch_array($result2), mysql_fetch_array($result3), mysql_fetch_array($result4), mysql_fetch_array($result5));

                    for ($i = 1; $i < 8; $i++) {
                        echo "<tr>";
                        echo "<td style='width: 40px;background-color:#e3f3f7;'>" . $i . "</td>";
                        for ($j = 0; $j < 5; $j++) {
                            echo "<td><input w='$j' t='$i' value='" . $table[$j][$i] . "'></td>";
                        }
                        echo "</tr>";
                    }
                    mysql_close($connect);
					?>
				</table>
				
					<br/>
					<br/>
				<div id="margin" align="center">
					<!-- <div class="btn-group inline"> -->
					<button type="button" class="btn btn-info" style="font-size: 40px" onclick="upload()">
						저장
					</button>
				</div>
				</div>
			</div>
			 <!-- <div id="content"  align="center" style="padding:30px; text-align: center;    margin-left: auto;  margin-right: auto;width:100%;display:table" > -->
			     
            
         </div>
          <div id="content">
      <br>
      <IMG class="displayed" src="./img/teaser.png" style="width:800px; display: block; margin-left: auto; margin-right: auto">  </biglogo>
  </div>
			<!-- <img src="./img/help.png" style="text-align: center;color: #ffffff;	width: 100%;position: absolute;	bottom: 0;	left: 0;width:100%; padding-left:10%;padding-right:10%;" class="center"> -->
			<br>
			<br>
			<br>
		 
		</div>

		<script type="text/javascript">
            var week = new Array(new Array(7), new Array(7), new Array(7), new Array(7), new Array(7));
            var isLoading = false;
            function upload() {
                if (isLoading)
                    return false;
                isLoading = true;
                for (var j = 0; j < 5; j++) {
                    for (var i = 1; i < 8; i++) {
                        week[j][i - 1] = $("input[w='" + j + "'][t='" + i + "']").val();
                    }
                }
                $.ajax({
                    url : "timetable_db.php",
                    type : 'GET',
                    data : {
                        select : "week",
                        w_1 : week[0],
                        w_2 : week[1],
                        w_3 : week[2],
                        w_4 : week[3],
                        w_5 : week[4]
                    },
                    success : function(args) {
                        alert("저장완료");
                        isLoading = false;
                        document.location.reload();
                    },
                    fail : function(jqXHR, textStatus, errorThrown) {
                        alert("오류발생 \n jqXHR: " + jqXHR.status + "\ntextStatus: " + textStatus + "\nerrorThrown: " + errorThrown);
                        isLoading = false;
                    }
                });
            }

            function submit_class_key() {
                if ($("#class_key").val().replace(/\s/g, '') == "") {
                    alert("학급코드를 입력해주세요.");
                    return ;
                } else {
                     
                }
                location.href = "timetable_db.php?select=class_key&class_key=" + $("#class_key").val();

            }
		</script>

	</body>
</html>
