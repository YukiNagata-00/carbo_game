<?php
session_start();
require('../../../common.php');

if(isset($_SESSION['user_id']) && isset($_SESSION['user_name'])){
    $user_id = $_SESSION['user_id'];
    $user_name = $_SESSION['user_name'];

}else{
    var_dump("failed");
    // header('Location: ../../login_v.php');
    // exit();
}

if(isset($_POST["game_start"])){

    $_SESSION['user_id'] = $user_id;
    $_SESSION['user_name'] =  $user_name;
    echo "hit";
    header('Location: total_playing.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>トータルカーボ当てゲームトップ</title>
    <link rel="stylesheet" href="../../../common.css">
    <link rel="stylesheet" href="../css/total-carbo.css">
<body>
    <header>
    <?php echo htmlspecialchars($user_id) ?> 
    <?php echo htmlspecialchars($user_name)?>
    <form action = "../../../top/php/index.php">
        <input type = "submit" value = "戻る">
    </form>
    </header>
    <main>
        <div class="top-title">
                    <h1>トータルカーボ当てゲーム</h1>
                    <p>指示されたカーボを目指して食べ物を集めよう！
                    ここでは糖質量 10g = 1カーボとし、運動はゲーム上の設定としてー5カーボとします。</p>
        </div>
        <div class="main-wrapper">
            <div class="game-example"></div>
            <div class="ranking">
                <h2>ランキング</h2>
                <div class="prize gold">
                    <img>
                    <p>name</p>
                    <p>score</p>
                </div>
                <div class="prize silver">
                    <img>
                    <p>name</p>
                    <p>score</p>
                </div>
                <div class="prize blond">
                    <img>
                    <p>name</p>
                    <p>score</p>
                </div>
            </div>
        </div>
        <div class="btn-wrapper">
            <form action= "" method = "POST" >
                <input type = "submit" class = "start-btn"  value = "スタート" name = "game_start">
            </form>
        </div>
    </main>
<footer></footer>
</body>
</html>