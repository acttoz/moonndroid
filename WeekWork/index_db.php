<?php
include_once ('./config.php');

///////////////////////////////////////

if ($_REQUEST['select'] == "save") {

	$sql = "UPDATE member SET d5='${d5}' WHERE id='${_SESSION['id']}'";
	mysql_query($sql, $connect);
}

if ($_REQUEST['select'] == "send") {
	$groupname = htmlspecialchars($_REQUEST['d5'], ENT_QUOTES);
	$sql = "UPDATE member SET time='" . date("Y-m-d H:i:s", time()) . "',d5='" . $groupname . "',day=" . $_REQUEST['day'] . " WHERE id='" . $_SESSION['id'] . "'";
	mysql_query($sql, $connect);
	$log = "INSERT INTO log ( id,day,school,name,grade,ban,class_key,time,field,d5 ) VALUES ( ";
	$log = $log . "'" . $_SESSION['id'] . "',";
	$log = $log . "'" . $day2 . "',";
	$log = $log . "'" . $_SESSION['school'] . "',";
	$log = $log . "'" . $_SESSION['name'] . "',";
	$log = $log . "'" . $_SESSION['grade'] . "',";
	$log = $log . "'" . $_SESSION['ban'] . "',";
	$log = $log . "'" . $_SESSION['class_key'] . "',";
	$log = $log . "'" . date("Y-m-d H:i:s", time()) . "',";
	$log = $log . "'" . "today" . "',";
	$log = $log . "'" . $groupname . "' ";
	$log = $log . ")";
	mysql_query($log, $connect);

	echo "<script>
    
    
    if (!alert('보내기 완료.(수정할 내용이 있는 경우, 내용을 수정하고 보내기버튼을 누르면 재전송이 가능합니다.)')) {
					 location.replace('today.php'); 
				};
    
    
    </script>";

}

if ($_REQUEST['select'] == "week") {

	$sql = "SELECT * FROM work WHERE ";
	$sql = $sql . "ch_id='" . $_SESSION['ch1'] . "'";
	$sql = $sql . " OR ch_id='" . $_SESSION['ch2'] . "'";
	$sql = $sql . " OR ch_id='" . $_SESSION['ch3'] . "'";
	$sql = $sql . " OR ch_id='" . $_SESSION['ch4'] . "'";
	$sql = $sql . " OR ch_id='" . $_SESSION['ch5'] . "'";
	$result = mysql_query($sql);
	while ($array2 = mysql_fetch_array($result)) {
		$results[] = array('work_id' => $array2['work_id'], 'work_name' => $array2['work_name'], 'file_path' => $array2['file_path'], 'complete' => $array2['complete'], 'day' => $array2['day'], 'ch_id' => $array2['ch_id']);
	}

	$data = array('week' => $results);

	echo json_encode2($data);

}
///////////////////////////////////

mysql_close($connect);

///////////////////////////////////

function json_encode2($data) {

	switch (gettype($data)) {
		case 'boolean' :
			return $data ? 'true' : 'false';
		case 'integer' :
		case 'double' :
			return $data;
		case 'string' :
			return '"' . strtr($data, array('\\' => '\\\\', '"' => '\\"')) . '"';
		case 'array' :
			$rel = false;
			// relative array?
			$key = array_keys($data);
			foreach ($key as $v) {
				if (!is_int($v)) {
					$rel = true;
					break;
				}
			}

			$arr = array();
			foreach ($data as $k => $v) {
				$arr[] = ($rel ? '"' . strtr($k, array('\\' => '\\\\', '"' => '\\"')) . '":' : '') . json_encode2($v);
			}

			return $rel ? '{' . join(',', $arr) . '}' : '[' . join(',', $arr) . ']';
		default :
			return '""';
	}

}
?>