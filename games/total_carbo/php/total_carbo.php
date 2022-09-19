<?php
session_start();
require('../../../common.php');
include('../../../parts/_head.php');
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

<link rel="stylesheet" href="../css/total-carbo.css">
<body class="drawer drawer--left">


<?php
include('../../../parts/_header.php');
?>

<header role="banner">

</header>

    <main role="main">
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
        <script type="text/javascript" src = "../../../parts/_drawer.js"></script>
    </main>
    <?php

include('../../../parts/_footer.php');