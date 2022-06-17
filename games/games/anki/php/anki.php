<?php
session_start();
require('../../../common.php');


if(isset($_SESSION['id']) && isset($_SESSION['name'])){
    $id = $_SESSION['id'];
    $name = $_SESSION['name'];
}else{
    var_dump("failed");
    header('Location: ../../login_v.php');
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
    
</head>
<body>
    <header>
    <?php echo htmlspecialchars($id) ?> 
    <?php echo htmlspecialchars($name)?>
    <form action = "../../../top/php/index.php">
        <input type = "submit" value = "戻る">
    </form>
    </header>
    <main>
        <div class="top-title">
                        <h1>暗記</h1>
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
                <form action= "cardslist.php" method = "POST">
                    <input type = "submit" class = "start-btn"  value = "スタート">
                </form>
            </div>
    </main>
    <footer></footer>
</body>
</html>