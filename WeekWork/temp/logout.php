<?php
session_start();
$_SESSION['is_logged'] = FALSE;
session_destroy();
header('Location: login.php');
?>