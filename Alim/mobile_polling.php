<?php
include_once ('./config.php');
$url="SELECT day FROM member WHERE id='${_REQUEST['id1']}' OR id='${_REQUEST['id2']}' OR id='${_REQUEST['id3']}' ORDER BY FIELD(id,'${_REQUEST['id1']}','${_REQUEST['id2']}','${_REQUEST['id3']}')";
$result2 = mysql_query($url);
while ($row = mysql_fetch_row($result2)) {
    echo $row[0].",";
}
echo "0,0,0,0";


mysql_close($connect);

?>