<?php

session_start();
require('../../../common.php');


if(isset($_SESSION['id']) && isset($_SESSION['name'])){
    $id = $_SESSION['id'];
    $name = $_SESSION['name'];
}else{
    var_dump("failed");
    header('Location: ../../../top/php/index.php');
    exit();
}



// //DB接続
$db = dbconnect();

//合計データ数を求めるーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーー

$counts = $db->query('select count(*) as card_cnt from cards');
$count = $counts-> fetch_assoc();

$max_page = floor(($count['card_cnt'] - 1 )/5 + 1);

//最初のデータ５件を表示ーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーー

$stmt = $db->prepare("select id, name, carbo, image from cards where member_id= '$id' order by id desc limit ?, 5");

if(!$stmt){
    die($db->error);
}

$stmt-> bind_result($id, $name, $carbo, $image);

//ページ数----------------------------------------------------------------------
$page = filter_input(INPUT_GET, 'page', FILTER_SANITIZE_NUMBER_INT);
if(!$page){
    $page = 1;
}
$start =($page - 1) * 5;
$stmt->bind_param('i', $start);
$success= $stmt->execute();

if(!$success){
    die($db->error);
}


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
        <?= $name ?>
        <a href = "cardslist.php">
            <input type = "button" value = "一覧へ戻る">
        </a>
        <form action = "newCard.php" method="POST" name = "newCard">
                    <input type = "submit" value = "カードを新規登録" >
            </form>
    </header>
    <main>
        <div class="top-title">
            <h1>MY暗記カード一覧</h1>
        </div>

        <div class="cards">
            <?php while($stmt -> fetch()):?>
                <a href = "my_oneCard.php?id=<?= $id?>" class="card">
                    <p><?php echo $name;?></p>
                    <br>
                </a>
                
            <?php endwhile; ?>
        </div>
        <div class="pager_area">
            <?php if ($page - 1 > 0): ?>
                <p><a href = "?page=<?= $page - 1?>"><?= $page - 1 ?>ページ目へ</a></p>
            <?php endif; ?>
            <?php if($page < $max_page) :?>
                <p><a href = "?page=<?= $page + 1?>"><?= $page + 1 ?>ページ目へ</a></p>
            <?php endif; ?>
        </div>
    </main>
    <footer></footer>

</body>
</html>