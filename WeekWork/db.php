<?php
include_once ('./config.php');

///////////////////////////////////////

if ($_REQUEST['select'] == "idcheck") {

    $query = mysql_query("SELECT * FROM w_account WHERE user_id ='" . $_REQUEST['user_id'] . "'", $connect);

    if (mysql_num_rows($query) == 0) {

        echo "success";

    } else {
        echo "fail";
    }

}

if ($_REQUEST['select'] == "submit") {

    $id = $_REQUEST['user_id'];
    $sql = "INSERT INTO w_account ( user_id,user_pw,user_name,user_mail) VALUES ( ";
    $sql = $sql . "'" . $_REQUEST['user_id'] . "',";
    $sql = $sql . "'" . $_REQUEST['user_pw'] . "',";
    $sql = $sql . "'" . $_REQUEST['user_name'] . "',";
    $sql = $sql . "'" . $_REQUEST['user_mail'] . "')";
    mysql_query($sql, $connect);
}

if ($_REQUEST['select'] == "login") {
    $result = mysql_query("SELECT * FROM w_account WHERE user_id ='${_REQUEST['user_id']}' AND user_pw='${_REQUEST['user_pass']}'", $connect);

    if (mysql_num_rows($result) == 1) {
        $row = mysql_fetch_assoc($result);

        $_SESSION['is_logged'] = TRUE;
        $_SESSION['id'] = $row['user_id'];
        $_SESSION['school'] = $row['school_id'];
        $_SESSION['name'] = $row['user_name'];
        $_SESSION['ch1'] = $row['ch1_id'];
        $_SESSION['ch2'] = $row['ch2_id'];
        $_SESSION['ch3'] = $row['ch3_id'];
        $_SESSION['ch4'] = $row['ch4_id'];
        $_SESSION['ch5'] = $row['ch5_id'];

        echo "success";

    } else {
        echo "fail";
    }

}

if ($_REQUEST['select'] == "week") {

    $sql = "SELECT w_work.*,w_account.user_name FROM w_work INNER JOIN w_account ON w_work.user_id = w_account.user_id WHERE ";
    $sql = $sql . " w_work.ch_id='" . $_SESSION['ch1'] . "'";
    $sql = $sql . " OR w_work.ch_id='" . $_SESSION['ch2'] . "'";
    $sql = $sql . " OR w_work.ch_id='" . $_SESSION['ch3'] . "'";
    $sql = $sql . " OR w_work.ch_id='" . $_SESSION['ch4'] . "'";
    $sql = $sql . " OR w_work.ch_id='" . $_SESSION['ch5'] . "'";
    $sql = $sql . " ORDER BY work_id DESC";
    $result = mysql_query($sql);
    while ($array = mysql_fetch_array($result)) {
        $results[] = array('work_id' => $array['work_id'], 'work_name' => $array['work_name'], 'work_content' => $array['work_content'], 'file_id' => $array['file_id'], 'complete' => $array['complete'], 'day' => $array['day'], 'ch_id' => $array['ch_id'], 'user_name' => $array['user_name'], 'user_id' => $array['user_id']);
    }

    $data = array('week' => $results);

    echo json_encode($data);

}

if ($_REQUEST['select'] == "reply") {
    $sql = "SELECT w_reply.*,w_account.user_name FROM w_reply INNER JOIN w_account ON w_reply.user_id = w_account.user_id WHERE w_reply.work_id=${_REQUEST['work_id']}";
    $result = mysql_query($sql);
    $results = array();
    while ($array = mysql_fetch_array($result)) {
        $datetime = new DateTime($array['time']);
        $time = $datetime -> format('y') . "." . $datetime -> format('m') . "." . $datetime -> format('d') . "." . $datetime -> format('H') . ":" . $datetime -> format('i');
        $results[] = array('reply_id' => $array['reply_id'], 'content' => $array['content'], 'time' => $time, 'user_id' => $array['user_id'], 'work_id' => $array['work_id'], 'file_name' => $array['file_name'], 'file_hash' => $array['file_hash'], 'user_name' => $array['user_name']);
    }

    $data = array('week' => $results);
    if (!empty($results))
        echo json_encode($data);

}
if ($_REQUEST['select'] == "file") {
    $sql = "SELECT * FROM w_files WHERE file_id=${_REQUEST['file_id']}";
    $result = mysql_query($sql);
    $results = array();
    while ($array = mysql_fetch_array($result)) {
        $results[] = array('name' => $array['name'], 'hash' => $array['hash']);
    }

    $data = array('week' => $results);
    if (!empty($results))
        echo json_encode($data);

}

if ($_REQUEST['select'] == "complete") {
    mysql_query("UPDATE w_work SET complete=${_REQUEST['complete']} WHERE work_id=${_REQUEST['work_id']}");
}

if ($_REQUEST['select'] == "delWork") {
    $dir = "./files/";

    if (!empty($_REQUEST['hash'])) {
        $filehash = $_REQUEST['hash'];

        if (!unlink($dir . $filehash)) {
            echo "error";
        }
    }
    mysql_query("DELETE FROM w_work WHERE work_id=${_REQUEST['work_id']}");
    mysql_query("DELETE FROM w_files WHERE file_id=${_REQUEST['file_id']}");
}

if ($_REQUEST['select'] == "sendWork") {
    if ($_REQUEST['work_id'] == 0) {
        $sql = "INSERT INTO w_work (work_name,work_content,day,ch_id,user_id) VALUE ('${_REQUEST['work_name']}','${_REQUEST['work_content']}','${_REQUEST['day']}','${_REQUEST['ch_id']}','${_SESSION['id']}')";
    } else {
        $sql = "UPDATE w_work SET work_name='${_REQUEST['work_name']}',work_content='${_REQUEST['work_content']}' WHERE work_id='${_REQUEST['work_id']}'";
    }
    mysql_query($sql);
}

if ($_REQUEST['select'] == "sendReply") {
    $dt = new DateTime();
    $time = $dt -> format('Y-m-d H:i:s');
    $sql = "INSERT INTO w_reply (content,time,user_id,work_id) VALUE ('${_REQUEST['content']}','${time}','${_SESSION['id']}','${_REQUEST['work_id']}')";
    mysql_query($sql);
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