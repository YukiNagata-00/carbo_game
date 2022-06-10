<?php
session_start();
require('../../../common.php');

$db = dbconnect();
$stmt = $db->prepare('select id, name, carbo, image from foods   order by id desc limit 5');

if(!$stmt){
    die($db->error);
}

$success= $stmt->execute();
if(!$success){
    die($db->error);
}

$stmt -> bind_result($id, $name, $carbo, $image);

// while($stmt -> fetch()):
?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../../common.css">
    <link rel="stylesheet" href="../css/cardslist.css">
</head>
<body>
    <header>
        <form action = "../../../top/php/index.php">
            <input type = "submit" value = "戻る">
        </form>
    </header>
    <main>
        <div class="top-title">
            <h1>暗記カード一覧</h1>
        </div>
        
            <div class="cards">
                <?php while($stmt -> fetch()):?>
                    
                    <a href = "oneCard.php?id=<?= $id?>" class="card">
                        <p><?php echo $name;?></p>
                        <br>
                        <!-- <?php echo $carbo;?>
                        <br>
                        <img src = "<?php echo $image ?>"> -->
                    </a>
                    

                <?php endwhile; ?>
                </div>
            

            <div class="btns">
                <form action = "#">
                        <input type = "submit" value = "次のリスト">
                </form>
            </div>

    

    </main>
    <footer>

    </footer>
</body>
</html>