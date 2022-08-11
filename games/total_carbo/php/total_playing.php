
<?php
    session_start();
    require('../../../common.php');
    require('food_class.php');

    if(isset($_SESSION['user_id']) && isset($_SESSION['user_name'])){
        $user_id = $_SESSION['user_id'];
        $user_name = $_SESSION['user_name'];
    }

    //DB接続  データ取り出し
    $db = dbconnect();
    $foods = [];
    $records = $db->query("SELECT name, carbo, image  FROM foods ORDER BY RAND() LIMIT 5");
    if($records){
        while($record = $records->fetch_assoc()){
            $foods[]= $record;
        }
    }
    print_r($foods);

    $ex1 = new Food();
    $ex1->setName( $foods[0]['name']);
    $ex1->setCarb( $foods[0]['carbo']);
    $ex1->setImg( $foods[0]['image']);
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../../common.css">
    <link rel="stylesheet" href="../css/total_playing.css">
</head>
<body>
    <header>
        <a href="../php/total_carbo.php">ゲームをやめる</a>
        <?= $user_name ?>さん
    </header>
    <main>
        <div class ="character"></div>
        <?= $ex1->getName();?>
        <?= $ex1->getCarb();?>
        <?= $ex1->getImg();?>
    </main>
    <footer></footer>
</body>
</html>