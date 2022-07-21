<?php
session_start();
require('../../../common.php');


if(isset($_SESSION['user_id']) && isset($_SESSION['user_name'])){
    $user_id = $_SESSION['user_id'];
    $user_name = $_SESSION['user_name'];
}else{
    var_dump("failed");
    header('Location: ../../../top/php/index.php');
    exit();
}

// //DB接続
$db = dbconnect();

//合計データ数を求めるーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーー
//デフォルトの食べ物データ
$counts = $db->query("select count(*) as food_cnt from foods  ");
$count = $counts-> fetch_assoc();


$max_page = floor(($count['food_cnt'] - 1 )/5 + 1);



//最初のデータ５件を表示ーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーー


$stmt = $db->prepare('select id, name, carbo, image from foods order by id desc limit ?, 5');

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



//My暗記カードリスト遷移へ
if(isset($_POST['my_cardslist'])){
    $_SESSION['user_name'] = $user_name;
    $_SESSION['user_id'] = $user_id;
    header('Location: my_cardslist.php');
    exit();
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
        <!-- <?= $user_name ?>さん -->
        
        
    </header>
    <main>
        <div class="top">
            <div class="btns">
                <a href = "../../../top/php/index.php" >戻る</a>
                <form action = "" method = "POST" >
                    <input type = "submit"  value = "MY暗記カード一覧" name = "my_cardslist">
                </form>
            </div>
            <h1>暗記カード一覧</h1>
        </div>
        <div class="search" >
            <form action="" class="search_form">
                <input type="text" class="form_txt" placeholder="暗記カードを検索">
                <input type="submit" value="検索" class="form_btn">
            </form>
        </div>
            <div class="cards">
                <?php while($stmt -> fetch()):?>
                    <a href = "oneCard.php?id=<?= $id?>" class="card">
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
    <footer>

    </footer>
</body>
</html>