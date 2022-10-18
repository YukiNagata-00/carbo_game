<?php
session_start();
require('../common.php');
require('../controller/quiz/quiz_result.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Acme&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=M+PLUS+Rounded+1c" rel="stylesheet">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/css/quiz_result.css">
    <?php
    include('../parts/_drawer_links.php');
    ?>
</head>
<body  class="drawer drawer--left">
    <?php
        include('../parts/_header.php');
    ?>
    <header role="banner"></header>
    <div class="main" >
        <div class="top">
            <div class="image">
                <img src="../assets/images/Achievement _Outline.png">
            </div>
            <div class="score">
                <div class="message">AWESOME!</div>
                <div class="score_number"><?= $point ?></div>
            </div>
        </div>
        <div class="results">
            <?php foreach($foods as $food): ?>
                <div class="question">
                <p><?php echo $food['name'].'<br>'; ?></p>
                    <img src ="<?php echo $food['image'].'<br>';?>" >
                    <p>答え　　<span><?php echo $food['carbo'];?></span>　カーボ</p>
                </div>
            <?php endforeach; ?>
            <?php foreach($result as $r): ?>
                    <?php if($r == "ok"): ?>
                        <p>⭕️</p>
                    <?php else:  ?>
                        <p>❌</p>
                    <?php endif; ?>
                <?php endforeach; ?>
        </div>
        <div class="btns">
            <a href="quiz_top.php">TOP画面へ</a>
        </div>
    </div>
    <script type="text/javascript" src = "../parts/_drawer.js"></script>
</body>
</html>