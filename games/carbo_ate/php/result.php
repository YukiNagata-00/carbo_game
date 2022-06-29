<?php
session_start();
require('../../../common.php');

$foods =  $_SESSION['foods'];
$result = $_SESSION['result'];


var_dump($result);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href = "carbo_ate.php">ゲーム画面TOP</a>
</body>
</html>