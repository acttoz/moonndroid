<?php
include_once ('./config.php');

$result2 = mysql_query("SELECT grade,ban,name,class_key,id,day FROM member WHERE school_id LIKE '" . $_REQUEST['id'] . "'");

while ($array2 = mysql_fetch_array($result2)) {
	$results[] = array('grade' => $array2['grade'],'id' => $array2['id'], 'ban' => $array2['ban'], 'name' => $array2['name'], 'class_key' => $array2['class_key'],'day' => $array2['day']);
}

$data = array('list' => $results);

echo json_encode2($data);

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