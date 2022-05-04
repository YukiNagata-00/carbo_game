<?php
session_start();
//index.phpで使用したSession[]
// unset($_SESSION['id']);
// unset($_SESSION['name']);
header('Location:../../login_v.php');
exit();
?>