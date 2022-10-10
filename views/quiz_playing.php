<?php
session_start();
require('../common.php');
require('../controller/quiz/quiz_playing.php');

var_dump($_SESSION['foods']);
$index =  $_SESSION['current_num'];
var_dump( $index);
$choices = $_SESSION['choices'];
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/css/quiz_playing.css">
</head>
<body>
    <div class="main">
        <div class="title">Q<?=  $index + 1 ?></div>
        <div class="question">
            <p><?= $_SESSION['foods'][ $index]["name"]  ?></p>
            <img src="<?=$_SESSION['foods'][ $index]["image"]  ?>">

        </div>
        <div class="answers">
            <div class="answer"><?= $choices[$index][0] ?></div>
            <div class="answer"><?= $choices[$index][1] ?></div>
            <div class="answer"><?= $choices[$index][2] ?></div>
        </div>
    </div>
</body>
</html>