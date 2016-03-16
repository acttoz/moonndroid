<?php
include_once ('./config.php');

///////////////////////////////////////

if ($_REQUEST['select'] == "idcheck") {

	$query = mysql_query("SELECT * FROM member WHERE id ='" . $_REQUEST['user_id'] . "'", $connect);

	if (mysql_num_rows($query) == 0) {

		echo "success";

	} else {
		echo "fail";
	}

}

////////////////////////////////////

if ($_REQUEST['select'] == "search") {

	$result2 = mysql_query("SELECT * FROM " . $_REQUEST['grade'] . " WHERE school LIKE '%" . $_REQUEST['word'] . "%' ORDER BY school ASC");

	while ($array2 = mysql_fetch_array($result2)) {
		$results[] = array('school' => $array2['school'], 'no' => $array2['no']);
	}

	$data = array('list' => $results);

	echo json_encode2($data);

}

///////////////////////////////////////

if ($_REQUEST['select'] == "sign") {

	$query = mysql_query("SELECT * FROM member WHERE school_id='" . $_REQUEST['school_id'] . "' and grade='" . $_REQUEST['grade'] . "' and name='" . $_REQUEST['name'] . "' and ban='" . $_REQUEST['ban'] . "'", $connect);
	if (mysql_num_rows($query) == 0) {

		$id = $_REQUEST['user_id'];
		mysql_query("INSERT INTO member ( id ) VALUES ( '" . $id . "')", $connect);
		$sql = "UPDATE member SET school='" . $_REQUEST['school'] . "' ,school_id='" . $_REQUEST['school_id'] . "' ,grade='" . $_REQUEST['grade'] . "' ,ban='" . $_REQUEST['ban'] . "' ,name='" . $_REQUEST['name'];
		$sql = $sql . "' , class_key='" . $_REQUEST['class_key'] . "' , pass='" . $_REQUEST['user_pass'] . "' WHERE id='" . $id . "'";
		mysql_query($sql, $connect);
		mysql_query("INSERT INTO w_1 ( id ) VALUES ( '" . $id . "')", $connect);
		mysql_query("INSERT INTO w_2 ( id ) VALUES ( '" . $id . "')", $connect);
		mysql_query("INSERT INTO w_3 ( id ) VALUES ( '" . $id . "')", $connect);
		mysql_query("INSERT INTO w_4 ( id ) VALUES ( '" . $id . "')", $connect);
		mysql_query("INSERT INTO w_5 ( id ) VALUES ( '" . $id . "')", $connect);
		$_SESSION['id'] = $id;
		$_SESSION['school'] = $_REQUEST['school'];
		$_SESSION['school_id'] = $_REQUEST['school_id'];
		$_SESSION['name'] = $_REQUEST['name'];
		$_SESSION['grade'] = $_REQUEST['grade'];
		$_SESSION['ban'] = $_REQUEST['ban'];
		$_SESSION['class_key'] = $_REQUEST['class_key'];
		$_SESSION['is_logged'] = TRUE;

		$log = "INSERT INTO log ( id,school,name,grade,ban,class_key,time,field ) VALUES ( ";
		$log = $log . "'" . $id . "',";
		$log = $log . "'" . $_SESSION['school'] . "',";
		$log = $log . "'" . $_SESSION['name'] . "',";
		$log = $log . "'" . $_SESSION['grade'] . "',";
		$log = $log . "'" . $_SESSION['ban'] . "',";
		$log = $log . "'" . $_SESSION['class_key'] . "',";
		$log = $log . "'" . date("Y-m-d H:i:s", time()) . "',";
		$log = $log . "'" . "sign" . "'";
		$log = $log . ")";
		mysql_query($log, $connect);

		echo "success";
	} else {
		echo "fail";
	}

}

if ($_REQUEST['select'] == "edit") {


		$id = $_REQUEST['user_id'];
		mysql_query("INSERT INTO member ( id ) VALUES ( '" . $id . "')", $connect);
		$sql = "UPDATE member SET school='" . $_REQUEST['school'] . "' ,school_id='" . $_REQUEST['school_id'] . "' ,grade='" . $_REQUEST['grade'] . "' ,ban='" . $_REQUEST['ban'] . "' ,name='" . $_REQUEST['name'];
		$sql = $sql . "' , class_key='" . $_REQUEST['class_key'] . "' , pass='" . $_REQUEST['user_pass'] . "' WHERE id='" . $id . "'";
		mysql_query($sql, $connect);
		mysql_query("INSERT INTO w_1 ( id ) VALUES ( '" . $id . "')", $connect);
		mysql_query("INSERT INTO w_2 ( id ) VALUES ( '" . $id . "')", $connect);
		mysql_query("INSERT INTO w_3 ( id ) VALUES ( '" . $id . "')", $connect);
		mysql_query("INSERT INTO w_4 ( id ) VALUES ( '" . $id . "')", $connect);
		mysql_query("INSERT INTO w_5 ( id ) VALUES ( '" . $id . "')", $connect);
		$_SESSION['id'] = $id;
		$_SESSION['school'] = $_REQUEST['school'];
		$_SESSION['school_id'] = $_REQUEST['school_id'];
		$_SESSION['name'] = $_REQUEST['name'];
		$_SESSION['grade'] = $_REQUEST['grade'];
		$_SESSION['ban'] = $_REQUEST['ban'];
		$_SESSION['class_key'] = $_REQUEST['class_key'];
		$_SESSION['is_logged'] = TRUE;

		 


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