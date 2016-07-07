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

                $result = mysql_query("SELECT * FROM w_help WHERE id IN (SELECT MAX(id) FROM w_help GROUP BY user_id);");

                while ($row = mysql_fetch_array($result)) {
                    echo '<dl style="background:#cfebf2;border: 2px solid #cfebf2;border-radius: 5px;" class="dl-horizontal">
						<dt style="text-align:left;font-size:15px;">' . $row[user_id] . '</dt>
						<dd style="text-align:left;font-size:15px;">:' . $row[content] . '</dd>
						<button class="btn btn-info" style="width:200px" onclick="answer(\'' . $row[user_id] . '\')">답하기</button>
						</dl>
                        <br>
                        <br>';
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
            function answer(user_id) {
                location.href = "_answer.php?user_id=" + user_id;
            }

            var url = window.location.href;
            if (url.substring(35, 36) == "1") {
                alert("접수 완료.\n답변은 선생님의 이메일을 통해 받아보실 수 있습니다.")
            }
        </script>
    </body>
</html>
