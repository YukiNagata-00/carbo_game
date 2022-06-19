<?php
session_start();
require('../../../common.php');

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
if(!$id){
    header('Location: my_cardslist.php');
    exit();
}
//DB接続
$db = dbconnect();

$counts = $db->query('select count(*) as cnt from cards');
$count = $counts-> fetch_assoc();
$max_id = $count['cnt'];
// var_dump($max_id);

//データ取得
$stmt = $db->prepare('select id, name, carbo, image from cards  where id =?  limit 1');

if(!$stmt){
    die($db->error);
}

$stmt->bind_param('i', $id);
$success= $stmt->execute();
if(!$success){
    die($db->error);
}

$stmt -> bind_result($id, $name, $carbo, $image);



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../../common.css">
    <link rel="stylesheet" href="../css/oneCard.css">

</head>
<body>
    <header>
        <form action = "my_cardslist.php">
            <input type = "submit" value = "戻る">
        </form>
        
    </header>
    <main>
        <div class="main-wrapper">
            <div class="btn">
                <form action = "" method="POST">
                    <input type = "submit" value = "編集" name = "edit">
                </form>
            </div>
            
            <div class="aCard"  id = "card">
            
                <?php while($stmt -> fetch()):?>
                    
                        <p id = "foodName" ><?php echo $name;?></p>
                        <p id = "carbo" class = "carbo off"><?php echo $carbo;?> </p>
                        <!-- <img src = "<?php echo $image ?>" class = "foodImg" id = "img">  -->
                        <img src = "../../game_images/<?php echo $image ?>" class = "foodImg" id = "img"> 
                    
            </div>
            <?php endwhile; ?>
            
            <div class="btns">
                <?php if($id != 1):?>
                    <a href="?id=<?= $id - 1?>">前のカード</a>
                <?php   endif; ?>
                <?php if($id != $max_id):?>
                    <a href = "?id=<?= $id + 1 ?>">次のカード</a>
                <?php   endif; ?>    
            </div>

<!-- //editページ遷移 -->
    <?php 
        if(isset($_POST['edit'])){
            $_SESSION['id'] = $id;
            $_SESSION['name'] = $name;
            $_SESSION['carbo'] = $carbo;
            $_SESSION['image'] = $image;
            header('Location: edit.php');
            exit();
        }
    ?>
        </div>

    </main>
    <footer></footer>
    <script type="text/javascript" src = "../js/oneCard.js"></script>
</body>
</html>