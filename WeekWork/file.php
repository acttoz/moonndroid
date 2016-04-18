<?php
include_once ('./config.php');
if ($_REQUEST['select'] == "upload") {
    if (!empty($_FILES['file']['name'])) {
        if (strlen($_FILES['file']['name']) > 255) {
            echo "<script>alert('파일 이름이 너무 깁니다.');";
            echo "history.back();</script>";
            exit ;
        }

        $date = date("YmdHis", time());
        $dir = "./files/";
        $file_hash = $date . $_FILES['file']['name'];
        $file_hash = md5($file_hash);
        $upfile = $dir . $file_hash;

        if (is_uploaded_file($_FILES['file']['tmp_name'])) {
            if (!move_uploaded_file($_FILES['file']['tmp_name'], $upfile)) {
                echo "upload error";
                exit ;
            }
        }
        //auto file naming
        // $query = "insert into w_files (name, hash)
        // values('" . $_FILES['file']['name'] . "',
        // '" . $file_hash . "')";
        $query = "insert into w_files (name, hash) 
              values('(" . $_SESSION['w_name'] . ")" . $_FILES['file']['name'] . "','" . $file_hash . "')";
        mysql_query($query);
        $file_id = mysql_insert_id();
    } else {
        if ($_REQUEST['work_id'] != 0)
            $file_id = mysql_result(mysql_query("SELECT file_id FROM w_work where work_id=${_REQUEST['work_id']}"), 0);
        else
            $file_id = 0;
    }
    $work_id;
    $work_content = htmlspecialchars($_REQUEST['work_content'], ENT_QUOTES);
    if ($_REQUEST['work_id'] == 0) {
        $sql = "INSERT INTO w_work (work_name,work_content,day,ch_id,user_id,file_id) VALUE ('${_REQUEST['work_name']}'
        ,'${work_content}','${_REQUEST['work_day']}','${_REQUEST['work_ch_id']}','${_SESSION['w_id']}',${file_id})";
        mysql_query($sql);
        $work_id = mysql_insert_id();
    } else {
        $sql = "UPDATE w_work SET work_name='${_REQUEST['work_name']}',work_content='${work_content}'
        ,file_id=${file_id} WHERE work_id='${_REQUEST['work_id']}'";
        mysql_query($sql);
        $work_id = $_REQUEST['work_id'];
    }
    echo $work_id;
    mysql_close($connect);

}

if ($_REQUEST['select'] == "download") {
    $dir = "./files/";
    $filename = urldecode($_REQUEST['name']);
    $filehash = $_REQUEST['hash'];
    if (file_exists($dir . $filehash)) {
        header("Content-Type: Application/octet-stream");
        header("Content-Disposition: attachment; filename=\"" . iconv('UTF-8', 'CP949', $filename) . "\"");
        header("Content-Transfer-Encoding: binary");
        header("Content-Length: " . filesize($dir . $filehash));

        $fp = fopen($dir . $filehash, "rb");
        while (!feof($fp)) {
            echo fread($fp, 1024);
        }
        fclose($fp);

    } else {
        echo "<script>alert('파일이 없습니다.');";
        echo "history.back();</script>";
        exit ;
    }
}

if ($_REQUEST['select'] == "del") {

    $dir = "./files/";
    $filehash = $_REQUEST['hash'];

    if (!unlink($dir . $filehash)) {
        echo "file delete error";
        exit ;
    }
    mysql_query("delete from w_files where file_id=" . $_REQUEST['file_id']);
    mysql_query("UPDATE w_work SET file_id=0 WHERE file_id=${_REQUEST['file_id']}");
    mysql_close($connect);
}
if ($_REQUEST['select'] == "delReply") {

    $dir = "./files/";
    $filehash = $_REQUEST['hash'];
    if (!unlink($dir . $filehash)) {
    }

    mysql_query("DELETE FROM w_reply WHERE reply_id=${_REQUEST['reply_id']}");
    mysql_close($connect);
}

if ($_REQUEST['select'] == "reply") {
    $file_name;
    $file_hash;
    if ($_FILES['reply_file']['name']) {
        if (strlen($_FILES['reply_file']['name']) > 255) {
            echo "<script>alert('파일 이름이 너무 깁니다.');";
            echo "history.back();</script>";
            exit ;
        }

        $date = date("YmdHis", time());
        $dir = "./files/";
        $file_hash = $date . $_FILES['reply_file']['name'];
        $file_hash = md5($file_hash);
        $upfile = $dir . $file_hash;

        if (is_uploaded_file($_FILES['reply_file']['tmp_name'])) {
            if (!move_uploaded_file($_FILES['reply_file']['tmp_name'], $upfile)) {
                echo "upload error";
                exit ;
            }
        }
        //auto file naming
        // $file_name = $_FILES['reply_file']['name'];
        $file_name = "(" . $_SESSION['w_name'] . ")" . $_FILES['reply_file']['name'];
    } else {
        $file_name = '0';
        $file_hash = '0';
    }
    $dt = new DateTime();
    $time = $dt -> format('Y-m-d H:i:s');
    $reply_content = nl2br(htmlspecialchars($_REQUEST['reply_content']));
    $sql = "INSERT INTO w_reply (content,time,user_id,work_id,file_name,file_hash) VALUE ('${reply_content}'
    ,'${time}','${_SESSION['w_id']}','${_REQUEST['work_id']}','${file_name}','${file_hash}')";

    mysql_query($sql);

    mysql_close($connect);

}
?>