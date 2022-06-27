<?php
session_start();
require('../../common.php');


if(isset($_SESSION['user_id']) && isset($_SESSION['user_name'])){
    $user_id = $_SESSION['user_id'];
    $user_name = $_SESSION['user_name'];

}else{
    header('Location: ../../login_v.php');
    exit();
}
if($_SERVER['REQUEST_METHOD'] == "POST"){
    $_SESSION['user_id'] = $user_id;
    $_SESSION['user_name'] = $user_name;
    
    if($_POST["ate_game"]){
        // $_SESSION['user_id'] = $user_id;
        // $_SESSION['user_name'] = $user_name;
        header('Location: ../../games/carbo_ate/php/carbo_ate.php ');
        exit();

    }elseif($_POST["total_game"]){
        header('Location: ../../games/total_carbo/php/total_carbo.php');
        exit();

    }elseif($_POST["anki"]){
        header('Location: ../../games/anki/php/anki.php');
        exit();
    }
}





?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> トップページ</title>
    <link rel="stylesheet" href="../../common.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <header>
        <a href = "logout.php">ログアウト</a>
        <?php echo htmlspecialchars($user_id); ?>
        <?php echo htmlspecialchars($user_name); ?>
    </header>
    <main>
        <div class="top-title">
            <h1>トップページ</h1>
            <p>選択してね</p> 
        </div>
        
        <div class="items-area">
            
            <div class="item flash-game">
                
                <p>カーボ当てゲーム</p>
                
                <img src = "http://4.bp.blogspot.com/-D5kKrMBiFxM/VMIt1KJ0L4I/AAAAAAAAqy8/rTn6p9VyVFY/s180-c/onigiri_maru.png" alt = "おにぎり">
                <p>食べ物のカーボはいくつかを答えるクイズです。</p>
                <form action = "" method = "POST">
                    <input type = "submit" name = "ate_game" value = "遊ぶ！" class = "btn">
                </form> 
            </div>
            <div class="item total-game">
                
                <p>トータルカーボ当てゲーム</p>
                <img src = "http://1.bp.blogspot.com/--Z0FQl8l9sU/UbVvQV3OinI/AAAAAAAAUtE/XpDlhdqZxaY/s180-c/fruits_basket.png" alt = "フルーツバスケット">
                <p>指定されたトータルカーボを目指して食べ物を集めましょう</p>
                <form action = "" method = "POST">
                    <input type = "submit" name = "total_game" value = "遊ぶ！" class = "btn">
                </form> 
            </div>
            <div class="item anki">
                
                <p>カーボ暗記帳</p>
                <img src = "https://2.bp.blogspot.com/-MatVFm3S0Fk/VXOTfp034qI/AAAAAAAAuAU/Pt3x4nQOY-I/s400/anki_card.png" alt = "暗記カード">
                <p>食べ物のカーボを暗記カードで覚えましょう</p>
                <form action = "" method = "POST">
                    <input type = "submit" name = "anki" value = "遊ぶ！" class = "btn">
                </form> 
            </div>

            
            
        </div>
    
    </main>
    <footer></footer>
</body>
</html>