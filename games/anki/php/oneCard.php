<?php
session_start();
require('../../../common.php');
include('../../../parts/_header.php');
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
if(!$id){
    header('Location: cardslist.php');
    exit();
}
//DB接続
$db = dbconnect();

$counts = $db->query('select count(*) as cnt from foods');
$count = $counts-> fetch_assoc();
$max_id = $count['cnt'];
// var_dump($max_id);

//データ取得
$stmt = $db->prepare('select id, name, carbo, image from foods  where id =?  limit 1');

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
    <link rel="stylesheet" href="../css/oneCard.css">
    <body>
    <header>
    </header>
    <main>
        <div class="main-wrapper"> 
        <div class="back_btn">
                    <a href="cardslist.php">戻る</a>
                </div>
                <div class="aCard"  id = "card">
                    <?php while($stmt -> fetch()):?>
                            <div class = "foodName" ><div><?php echo $name;?></div></div>
                            <div id="carbo" class = "carbo off">
                                <?php echo $carbo;?>
                            </div>
                            <img src = "<?php echo $image ?>" class = "foodImg" id = "img"> 
                    
                </div>
                <?php endwhile; ?>
                
                <div class="onecard_btns">
                    <?php if($id != 1):?>
                        <a href="?id=<?= $id - 1?>" class="back_btn">前のカード</a>
                    <?php   endif; ?>
                    <?php if($id != $max_id):?>
                        <a href = "?id=<?= $id + 1 ?>" class="next_btn">次のカード</a>
                    <?php   endif; ?>    
                </div>
        </div> 

    </main>
<script type="text/javascript" src = "../js/oneCard.js"></script>
<?php

include('../../../parts/_footer.php');