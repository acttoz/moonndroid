<?php
include_once ('./config.php');
$dir = "./files/";
$filehash = $_REQUEST['hash'];

if (!unlink($dir . $filehash)) {
    echo "file delete error";
    exit ;
}
mysql_query("delete from files where file_id=" . $_GET['file_id']);
mysql_query("UPDATE work SET file_id=0 WHERE file_id=${_REQUEST['file_id']}");
mysql_close($connect);
?>