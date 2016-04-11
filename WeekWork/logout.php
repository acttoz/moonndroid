<?php
session_start();
$_SESSION['w_is_logged'] = FALSE;
session_destroy();
header('Location: index.php');
?>