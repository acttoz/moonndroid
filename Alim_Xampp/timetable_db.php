<?php
include_once ('./config.php');

///////////////////////////////////////
if ($_REQUEST['select'] == "week") {
    $w_1 = $_REQUEST['w_1'];
    $w_2 = $_REQUEST['w_2'];
    $w_3 = $_REQUEST['w_3'];
    $w_4 = $_REQUEST['w_4'];
    $w_5 = $_REQUEST['w_5'];
    $week = array($w_1, $w_2, $w_3, $w_4, $w_5);

    echo $week[0][0];

    for ($i = 0; $i < 5; $i++) {
        $sql = "UPDATE w_" . ($i + 1) . " SET t1='" . $week[$i][0] . "',t2='" . $week[$i][1] . "',t3='" . $week[$i][2] . "',t4='" . $week[$i][3] . "',t5='" . $week[$i][4] . "',t6='" . $week[$i][5] . "',t7='" . $week[$i][6] . "' WHERE id='" . $_SESSION['id'] . "'";
        mysql_query($sql, $connect);
    }
}

if ($_REQUEST['select'] == "class_key") {
        $sql = "UPDATE member SET class_key='" . $_REQUEST['class_key'] . "' WHERE id='" . $_SESSION['id'] . "'";
        mysql_query($sql, $connect);
        $_SESSION['class_key'] = $_REQUEST['class_key'];
        header("location:today.php");
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