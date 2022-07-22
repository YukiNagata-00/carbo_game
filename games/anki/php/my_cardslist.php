<?php

session_start();
require('../../../common.php');


if(isset($_SESSION['user_id']) && isset($_SESSION['user_name'])){
    $user_id = $_SESSION['user_id'];
    $user_name = $_SESSION['user_name'];
}else{
    var_dump("failed");
    // header('Location: ../../../top/php/index.php');
    exit();
}



// //DB接続
$db = dbconnect();

//合計データ数を求めるーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーー

$counts = $db->query('select count(*) as card_cnt from cards');
$count = $counts-> fetch_assoc();

$max_page = floor(($count['card_cnt'] - 1 )/5 + 1);

//最初のデータ５件を表示ーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーーー

$stmt = $db->prepare("select id, name, carbo, image from cards where member_id= '$user_id' order by id desc limit ?, 5");

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


///新規暗記カード登録ページへ遷移

if(isset($_POST['newCard'])){
    $_SESSION['user_name'] = $user_name;
    $_SESSION['user_id'] = $user_id;
    header('Location: newCard.php');
    exit();
}

if(isset($_POST['to_signup'])){
    $_SESSION['guest_bool'] = "ゲスト";
    header('Location: ../../../signup/php/signup_v.php');
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
    <header></header>
    <main>
        <div class="top">
            <div class="btns">
                <a href = "cardslist.php" >一覧へ戻る</a>
                <?php if($user_name != "ゲスト"):  ?>
                    <form action = "newCard.php" method="POST" name = "newCard">
                        <input type = "submit" value = "カードを新規登録" >
                    </form>
                <?php  endif; ?>
            </div>
            <h1>MY暗記カード一覧</h1>
        </div>

        <div class="cards">
            <?php  if($user_name != "ゲスト"): ?>
                <?php while($stmt -> fetch()):?>
                    <a href = "my_oneCard.php?id=<?= $id?>" class="card">
                        <p><?php echo $name;?></p>
                        <br>
                    </a>
                    
                <?php endwhile; ?>
            <?php else: ?>
                <div class="alert">
                    <p>MY暗記カードは会員限定の機能です。</p> 
                    <form action="" method = "POST" >
                        <input type="submit" value="新規登録はこちら" name = "to_signup">
                    </form>
                </div>
            <?php endif; ?>
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