<?php
include_once ('./config.php');

///////////////////////////////////////
// if ($_REQUEST['select'] == "sign_school") {
// //make school
// $sql = "INSERT INTO w_school (no,school_name) VALUE ('${_REQUEST['no']}','${_REQUEST['school_name']}')";
// mysql_query($sql);
// $school_id = mysql_insert_id();
// //make ch_0
// $sql = "INSERT INTO w_channel (school_id,ch_name,pw) VALUE (" . $school_id . ",'학교','${_REQUEST['pw']}')";
// $sql = $sql . ",(" . $school_id . ",'1학년','0')";
// $sql = $sql . ",(" . $school_id . ",'2학년','0')";
// $sql = $sql . ",(" . $school_id . ",'3학년','0')";
// $sql = $sql . ",(" . $school_id . ",'4학년','0')";
// $sql = $sql . ",(" . $school_id . ",'5학년','0')";
// $sql = $sql . ",(" . $school_id . ",'6학년','0');";
// mysql_query($sql);
// logInCh(mysql_insert_id(), 1);
// header("location:channel.php");
// }

if ($_REQUEST['select'] == "sign_ch") {
    //make ch_0
    $sql = "INSERT INTO w_channel (school_no,grade,pw) VALUE ('${_REQUEST['school_no']}','${_REQUEST['grade']}','${_REQUEST['pw']}')";
    mysql_query($sql);

    $grade = $_REQUEST['grade'];
    if ($grade != 0 && $grade != 50) {
        $sql = "INSERT INTO w_chat_polling (ch_id) VALUE (" . mysql_insert_id() . ")";
        mysql_query($sql);
    }

    logInCh(mysql_insert_id(), $_REQUEST['grade']);
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}

if ($_REQUEST['select'] == "login_ch") {
    logInCh($_REQUEST['ch_id'], $_REQUEST['grade']);
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}
if ($_REQUEST['select'] == "get_channel") {
    getCh($_REQUEST['school_id']);
}

// if ($_REQUEST['select'] == "get_school") {
// $query = mysql_query("SELECT school_id FROM w_school where no=${_REQUEST['no']}");
// if (mysql_num_rows($query) != 0) {
// //login
// $school_id = mysql_result($query, 0);
// getCh($school_id);
// } else {
// //sign
// echo 0;
// }
// }

function getCh($school_id) {
    $result2 = mysql_query("SELECT * FROM w_channel WHERE school_id =" . $school_id);
    while ($array2 = mysql_fetch_array($result2)) {
        $results[] = array('ch_id' => $array2['ch_id'], 'ch_name' => $array2['ch_name'], 'pw' => $array2['pw']);
    }
    $data = array('list' => $results);
    echo json_encode($data);
}

function logInCh($ch_id, $grade) {
    $ch_num = '';
    if ($grade == 0) {
        $ch_num = '_school';
    } else if ($grade == 50) {
        $ch_num = '_me';
    } else {
        $ch_num = '_grade';

        $sql = "INSERT INTO w_channel (school_no,grade,pw) VALUE ('${_SESSION['school_id']}',50,'0')";
        mysql_query($sql);
        logInCh(mysql_insert_id(), 50);
    }
    mysql_query("UPDATE member SET ch" . $ch_num . "=" . $ch_id . "  WHERE id='${_SESSION['id']}'");
    $_SESSION['ch' . $ch_num] = $ch_id;

}

if ($_REQUEST['select'] == "search") {

    $result2 = mysql_query("SELECT * FROM school_cho WHERE school LIKE '%" . $_REQUEST['word'] . "%' ORDER BY school ASC");

    while ($array2 = mysql_fetch_array($result2)) {
        $results[] = array('school' => $array2['school'], 'no' => $array2['no'], 'pw' => $array2['pw']);
    }

    $data = array('list' => $results);

    echo json_encode($data);

}

if ($_REQUEST['select'] == "idcheck") {

    $query = mysql_query("SELECT * FROM member WHERE id ='" . $_REQUEST['user_id'] . "'", $connect);

    if (mysql_num_rows($query) == 0) {

        echo "success";

    } else {
        echo "fail";
    }

}

if ($_REQUEST['select'] == "account") {

    $sql = "UPDATE member SET school='" . $_REQUEST['school'] . "'";
    if ($_REQUEST['school_logout'] == 1) {
        $sql = $sql . ",ch_school=0 ,ch_grade=0,news=''";
        $_SESSION['ch_school'] = 0;
        $_SESSION['ch_grade'] = 0;
    }
    $sql = $sql . ",school_id='" . $_REQUEST['school_id'] . "' ,grade='" . $_REQUEST['grade'] . "' ,ban='" . $_REQUEST['ban'] . "' ,name='" . $_REQUEST['name'];
    $sql = $sql . "' , pass='" . $_REQUEST['user_pass'] . "' WHERE id='" . $_REQUEST['user_id'] . "'";
    mysql_query($sql, $connect);
    $_SESSION['id'] = $_REQUEST['user_id'];
    $_SESSION['school'] = $_REQUEST['school'];
    $_SESSION['school_id'] = $_REQUEST['school_id'];
    $_SESSION['name'] = $_REQUEST['name'];
    $_SESSION['grade'] = $_REQUEST['grade'];
    $_SESSION['ban'] = $_REQUEST['ban'];
    $_SESSION['is_logged'] = TRUE;
}
if ($_REQUEST['select'] == "sign") {
    $query = mysql_query("SELECT * FROM member WHERE school_id='" . $_REQUEST['school_id'] . "' and grade='" . $_REQUEST['grade'] . "' and name='" . $_REQUEST['name'] . "' and ban='" . $_REQUEST['ban'] . "'", $connect);
    if (mysql_num_rows($query) == 0) {
        $sql = "INSERT INTO member (id ,pass ,name,school,school_id,grade,ban) VALUES ( ";
        $sql = $sql . "'" . $_REQUEST['user_id'] . "',";
        $sql = $sql . "'" . $_REQUEST['user_pass'] . "',";
        $sql = $sql . "'" . $_REQUEST['name'] . "',";
        $sql = $sql . "'" . $_REQUEST['school'] . "',";
        $sql = $sql . "'" . $_REQUEST['school_id'] . "',";
        $sql = $sql . "'" . $_REQUEST['grade'] . "',";
        $sql = $sql . "'" . $_REQUEST['ban'] . "')";
        mysql_query($sql, $connect);
        $_SESSION['id'] = $_REQUEST['user_id'];

        echo "success";
    } else {
        echo "fail";
    }
}

if ($_REQUEST['select'] == "login") {

    $result = mysql_query("SELECT * FROM member WHERE id ='${_REQUEST['user_id']}' AND pass='${_REQUEST['user_pass']}'", $connect);

    if (mysql_num_rows($result) == 1) {
        $row = mysql_fetch_assoc($result);
        $_SESSION['is_logged'] = TRUE;
        $_SESSION['id'] = $row['id'];
        $_SESSION['name'] = $row['name'];
        $_SESSION['school'] = $row['school'];
        $_SESSION['school_id'] = $row['school_id'];
        $_SESSION['grade'] = $row['grade'];
        $_SESSION['ban'] = $row['ban'];
        $_SESSION['ch_school'] = $row['ch_school'];
        $_SESSION['ch_grade'] = $row['ch_grade'];
        $_SESSION['ch_me'] = $row['ch_me'];
        $_SESSION['class_key'] = $row['class_key'];
        $_SESSION['side'] = $row['side'];

        echo "success";

    } else {
        echo "fail";
    }
}

if ($_REQUEST['select'] == "week") {

    $sql = "SELECT w_work.*,member.name,member.news,member.grade FROM w_work INNER JOIN member ON w_work.user_id
     = member.id WHERE ";
    $sql = $sql . " w_work.ch_id='" . $_SESSION['ch_school'] . "'";
    $sql = $sql . " OR w_work.ch_id='" . $_SESSION['ch_grade'] . "'";
    $sql = $sql . " OR w_work.ch_id='" . $_SESSION['ch_me'] . "'";
    $sql = $sql . " ORDER BY work_id DESC";
    $result = mysql_query($sql);
    while ($array = mysql_fetch_array($result)) {
        if ($array['ch_id'] == $_SESSION['ch_school'])
            $ch_group = 'ch_school';
        else if ($array['ch_id'] == $_SESSION['ch_grade'])
            $ch_group = 'ch_grade';
        else if ($array['ch_id'] == $_SESSION['ch_me'])
            $ch_group = 'ch_me';

        $work_name = htmlspecialchars_decode($array['work_name'], ENT_QUOTES);
        $work_decoded = htmlspecialchars_decode($array['work_content'], ENT_QUOTES);
        $results[] = array('ch_group' => $ch_group, 'work_id' => $array['work_id'], 'work_name' => $work_name, 'new' => $array['new'], 'work_content' => $work_decoded, 'file_id' => $array['file_id'], 'complete' => $array['complete'], 'grade' => $array['grade'], 'day' => $array['day'], 'ch_id' => $array['ch_id'], 'user_name' => $array['name'], 'user_id' => $array['user_id'], 'reply' => $array['reply']);
    }

    $data = array('week' => $results);

    echo json_encode($data);

}

if ($_REQUEST['select'] == "reply") {
    $sql = "SELECT w_reply.*,member.name,member.ban,member.grade FROM w_reply INNER JOIN member ON w_reply.user_id = member.id WHERE w_reply.work_id=${_REQUEST['work_id']} ORDER BY time ASC ";
    $result = mysql_query($sql);
    $results = array();
    while ($array = mysql_fetch_array($result)) {
        $reply_decoded = htmlspecialchars_decode($array['content'], ENT_QUOTES);
        $datetime = new DateTime($array['time']);
        $time = $datetime -> format('y') . "." . $datetime -> format('m') . "." . $datetime -> format('d') . "." . $datetime -> format('H') . ":" . $datetime -> format('i');
        $results[] = array('reply_id' => $array['reply_id'], 'content' => $reply_decoded, 'grade' => $array['grade'], 'ban' => $array['ban'], 'time' => $time, 'user_id' => $array['user_id'], 'work_id' => $array['work_id'], 'file_name' => $array['file_name'], 'file_hash' => $array['file_hash'], 'name' => $array['name'], 'ch_school' => $_SESSION['ch_school'], 'ch_grade' => $_SESSION['ch_grade']);
    }

    $data = array('week' => $results);
    if (!empty($results))
        echo json_encode($data);

}

if ($_REQUEST['select'] == "help") {
    $sql = "SELECT * FROM w_help WHERE user_id='${_SESSION['id']}' ORDER BY id";
    $result = mysql_query($sql);
    $results = array();
    while ($array = mysql_fetch_array($result)) {
        $reply_decoded = htmlspecialchars_decode($array['content'], ENT_QUOTES);
        $results[] = array('content' => $reply_decoded, 'me' => $array['me']);
    }
    $data = array('week' => $results);
    if (!empty($results))
        echo json_encode($data);
}

if ($_REQUEST['select'] == "answer") {
    $sql = "SELECT * FROM w_help WHERE user_id='${_REQUEST['user_id']}' ORDER BY id";
    $result = mysql_query($sql);
    $results = array();
    while ($array = mysql_fetch_array($result)) {
        $reply_decoded = htmlspecialchars_decode($array['content'], ENT_QUOTES);
        $results[] = array('content' => $reply_decoded, 'me' => $array['me']);
    }
    $data = array('week' => $results);
    if (!empty($results))
        echo json_encode($data);
}

if ($_REQUEST['select'] == "search_work") {
    $sql = "SELECT * FROM w_work WHERE work_name LIKE '%${_REQUEST['word']}%' AND (ch_id IN (${_SESSION['ch_school']},${_SESSION['ch_grade']},${_SESSION['ch_me']}))
       ORDER BY day DESC";
    $result = mysql_query($sql);
    $results = array();
    while ($array = mysql_fetch_array($result)) {
        $timestamp = strtotime($array['day']);

        //channel
        $ch_id = $array['ch_id'];
        $ch_name;
        if ($ch_id == $_SESSION['ch_school'])
            $ch_name = '학교';
        if ($ch_id == $_SESSION['ch_grade'])
            $ch_name = $_SESSION['grade'] . '학년';
        if ($ch_id == $_SESSION['ch_me'])
            $ch_name = $_SESSION['name'];

        $day = date("d", $timestamp);
        $month = date("m", $timestamp);
        $work_decoded = htmlspecialchars_decode($array['work_name'], ENT_QUOTES);
        $results[] = array('work_name' => $work_decoded, 'day' => $month . '/' . $day, 'work_id' => $array['work_id'], 'ch_id' => $ch_name, 'user_id' => $array['user_id'], 'date' => $array['day']);
    }
    $data = array('week' => $results);
    echo json_encode($data);
}

if ($_REQUEST['select'] == "help_poll") {
    echo mysql_result(mysql_query("SELECT COUNT(id) FROM w_help where user_id='${_SESSION['id']}'"), 0);
}

if ($_REQUEST['select'] == "reply_poll") {
    echo mysql_result(mysql_query("SELECT COUNT(reply_id) FROM w_reply where work_id='${_REQUEST['work_id']}'"), 0);
}
if ($_REQUEST['select'] == "chat") {
    $sql = "SELECT * from(SELECT w_chat.*,member.name,member.ban FROM w_chat INNER JOIN member ON w_chat.user_id = member.id WHERE w_chat.ch_id=${_SESSION['ch_grade']} ORDER BY time DESC LIMIT 30)tmp ORDER BY tmp.time ASC";
    $result = mysql_query($sql);
    $results = array();
    while ($array = mysql_fetch_array($result)) {
        $reply_decoded = htmlspecialchars_decode($array['content'], ENT_QUOTES);
        $datetime = new DateTime($array['time']);
        $time = $datetime -> format('y') . "." . $datetime -> format('m') . "." . $datetime -> format('d') . "." . $datetime -> format('H') . ":" . $datetime -> format('i');
        $results[] = array('chat_id' => $array['chat_id'], 'content' => $reply_decoded, 'ban' => $array['ban'], 'time' => $time, 'user_id' => $array['user_id'], 'ch_id' => $array['ch_id'], 'file_name' => $array['file_name'], 'file_hash' => $array['file_hash'], 'name' => $array['name']);
    }
    $data = array('week' => $results);
    if (!empty($results))
        echo json_encode($data);
}

if ($_REQUEST['select'] == "sendChat") {
    $dt = new DateTime();
    $time = $dt -> format('Y-m-d H:i:s');
    $chat_content = htmlspecialchars($_REQUEST['content'], ENT_QUOTES);
    $sql = "INSERT INTO w_chat (content,time,user_id,ch_id,file_name,file_hash) VALUE ('${chat_content}','${time}','${_SESSION['id']}','${_SESSION['ch_grade']}','0','0')";
    mysql_query($sql);
    $sql = "UPDATE w_chat_polling SET chat_no = chat_no + 1 WHERE ch_id = ${_SESSION['ch_grade']}";
    mysql_query($sql);
}

if ($_REQUEST['select'] == "sendHelp") {
    $chat_content = htmlspecialchars($_REQUEST['content'], ENT_QUOTES);
    $sql = "INSERT INTO w_help (content,user_id,me) VALUE ('${chat_content}','${_SESSION['id']}',0)";
    mysql_query($sql);
}
if ($_REQUEST['select'] == "sendAnswer") {
    $chat_content = htmlspecialchars($_REQUEST['content'], ENT_QUOTES);
    $sql = "INSERT INTO w_help (content,user_id,me) VALUE ('${chat_content}','${_REQUEST['user_id']}',1)";
    mysql_query($sql);
}

if ($_REQUEST['select'] == "chat_polling") {
    echo mysql_result(mysql_query("SELECT chat_no FROM w_chat_polling where ch_id='${_SESSION['ch_grade']}'"), 0);
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
if ($_REQUEST['select'] == "my_work") {
    $work_name = htmlspecialchars($_REQUEST['work_title'], ENT_QUOTES);
    $sql = "INSERT INTO w_work (work_name,work_content,day,ch_id,user_id,file_id) VALUE ('${work_name}'
        ,'','${_REQUEST['day']}','${_SESSION['ch_me']}','${_SESSION['id']}',0)";
    mysql_query($sql);
}

if ($_REQUEST['select'] == "complete") {
    mysql_query("UPDATE w_work SET complete=${_REQUEST['complete']} WHERE work_id=${_REQUEST['work_id']}");
}

if ($_REQUEST['select'] == "side") {
    mysql_query("UPDATE member SET side=${_REQUEST['side']} WHERE id ='${_SESSION['id']}'");
    $_SESSION['side'] = $_REQUEST['side'];
}

if ($_REQUEST['select'] == "up_new") {
    mysql_query("UPDATE member SET news='${_REQUEST['news']}' WHERE id ='${_SESSION['id']}'");
}
if ($_REQUEST['select'] == "get_new") {

    echo mysql_result(mysql_query("SELECT news FROM member where id='${_SESSION['id']}'"), 0);
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

// if ($_REQUEST['select'] == "sendWork") {
// if ($_REQUEST['work_id'] == 0) {
// $sql = "INSERT INTO w_work (work_name,work_content,day,ch_id,user_id) VALUE ('${_REQUEST['work_name']}','${_REQUEST['work_content']}','${_REQUEST['day']}','${_REQUEST['ch_id']}','${_SESSION['w_id']}')";
// } else {
// $sql = "UPDATE w_work SET work_name='${_REQUEST['work_name']}',work_content='${_REQUEST['work_content']}' WHERE work_id='${_REQUEST['work_id']}'";
// }
// mysql_query($sql);
// }
//

///////////////////////////////////

mysql_close($connect);

///////////////////////////////////
?>