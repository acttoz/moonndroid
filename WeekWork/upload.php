<?php

include_once ('./config.php');
// echo $_POST['work_id'];
// echo $_POST['work_name'];
// echo $_POST['work_content'];
// echo $_POST['work_day'];
// echo $_POST['work_ch_id'];
if ($_FILES['file']['name']) {
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
    $query = "insert into files (name, hash) 
              values('" . $_FILES['file']['name'] . "', 
              '" . $file_hash . "')";
    mysql_query($query);
    $file_id = mysql_insert_id();
}else{
    $file_id = 0;
}



if ($_POST['work_id'] == 0) {
    $sql = "INSERT INTO work (work_name,work_content,day,ch_id,user_id,file_id) VALUE ('${_POST['work_name']}','${_POST['work_content']}','${_POST['work_day']}','${_POST['work_ch_id']}','${_SESSION['id']}',${file_id})";
} else {
    $sql = "UPDATE work SET work_name='${_POST['work_name']}',work_content='${_POST['work_content']}',file_id=${file_id} WHERE work_id='${_POST['work_id']}'";
}
mysql_query($sql);

mysql_close($connect);

header('Location: index.php');
?>