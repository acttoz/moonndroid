<?php
 
    header("Content-type: text/html; charset=utf-8");
    
    $dir = "./files/";
    $filename = $_REQUEST['name'];
    $filehash = $_REQUEST['hash'];
    
    if(file_exists($dir.$filehash))
    {
            header("Content-Type: Application/octet-stream");
            header("Content-Disposition: attachment; filename=".$filename);
            header("Content-Transfer-Encoding: binary");
            header("Content-Length: ".filesize($dir.$filehash));
 
            $fp = fopen($dir.$filehash, "rb");
            while(!feof($fp))
            {
                echo fread($fp, 1024);
            }
            fclose($fp);
            
            
    }
    else
    {
            echo "<script>alert('파일이 없습니다.');";
            echo "history.back();</script>";
            exit;
    }
    
?>