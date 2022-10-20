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
                <form action="" method="post">
                    <?php if($_SESSION['afterClicked'] ):?>
                        <input type="submit" value="<?= $value?>" name="selected_choice"  disabled class="choices <?php echo $foods[$index]['carbo'] == $value ?   "green" : "red"; ?>">
                    <?php else: ?>
                    <input type="submit" value="<?= $value?>" name="selected_choice" class="choices" >
                    <?php endif; ?>
                </form>

            <?php  endforeach; ?>
            <?php if($_SESSION['afterClicked'] ):?>
            <form action="" method="POST" class = "next_form ">
                <input type="submit" name = "next_btn" value="次の問題へ">
                <?php endif; ?>
            </form>
        </div>
    </div>
    <!-- <script type="text/javascript" src = "../controller/quiz/quiz.js"></script> -->
</body>
</html>