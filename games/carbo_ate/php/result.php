<?php
session_start();
require('../../../common.php');

$foods =  $_SESSION['foods'];
$result = $_SESSION['result'];
$point = $_SESSION['point'];
// var_dump($foods);
var_dump($result);
var_dump($point);

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
        <div class="top-title">
            <h1>結果発表</h1>
        </div>
        <div class="points">
            <h2><?= $point ?>点 / 100点</h2>
        </div>
        <div class="results">
            
                <?php foreach($foods as $food): ?>
                <div class="result">
                    <p><?php echo $food['name'].'<br>'; ?></p>
                    <img src ="<?php echo $food['image'].'<br>';?>" >
                    <p>答え <?php echo $food['carbo'];?>カーボ</p>
                </div>
                <?php endforeach; ?>
            

        </div>
    </main>
    <footer></footer>
    
</body>
</html>