<?php
session_start();
require('../common.php');
require('../controller/quiz/quiz_playing.php');

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
            <?php foreach($choices[$index] as $value): ?>
                <form action="" method="get">
                    <!-- <div class="answer"><?= $value?></div>
                    <input type="hidden" name="choice" value="<?= $value?>"> -->
                    <button type="submit" value="<?= $value?>" name="selected_choice"><?= $value?></button>
                </form>

            <?php  endforeach; ?>
        </div>
    </div>
</body>
</html>