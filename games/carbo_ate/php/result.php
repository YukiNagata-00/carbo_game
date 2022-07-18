<?php
session_start();
require('../../../common.php');

$foods =  $_SESSION['foods'];
$result = $_SESSION['result'];
$point = $_SESSION['point'];
// var_dump($foods);
// var_dump($result);
// var_dump($point);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../../common.css">
    <link rel="stylesheet" href="../css/result.css">

</head>
<body>
    <header>
    <a href = "carbo_ate.php">ゲーム画面TOPへ</a>
    </header>
    <main>
        <div class="top_title">
            <h1>結果発表</h1>
        </div>
        <div class="points">
            <h2><?= $point ?>点 / 100点</h2>
        </div>
        <div class="results">
            <div class="answers">
                <?php foreach($foods as $food): ?>
                    <div class="answer">
                    <p><?php echo $food['name'].'<br>'; ?></p>
                    <img src ="<?php echo $food['image'].'<br>';?>" >
                    <p>答え <?php echo $food['carbo'];?>カーボ</p>
                    </div>
                    
                <?php endforeach; ?>
            </div>
            <div class="ans_imges">
                <?php foreach($result as $r): ?>
                    <?php if($r == "correct"): ?>
                        <p>⭕️</p>
                    <?php else:  ?>
                        <p>❌</p>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>
    </main>
    <footer></footer>
    
</body>
</html>