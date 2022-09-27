<?php
session_start();

require('../../common.php');
include('../../parts/_head.php');
if(isset($_SESSION['user_id']) && isset($_SESSION['user_name'])){
    $user_id = $_SESSION['user_id'];
    $user_name = $_SESSION['user_name'];

}else{
    header('Location: ../../login_v.php');
    exit();
}





?>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link rel="stylesheet" href="../../common.css">
<link rel="stylesheet" href="../css/style.css">
</head>

<body class="drawer drawer--left">


<?php
include('../../parts/_header.php');
?>

<header role="banner">

</header>

    <main role="main">
        
        <div class="top-title">
            <h1 class="carbo_town">Welcome to Carbo Town!</h1>
            <p>選択してね</p> 
        </div>
        
        <div class="items-area">
            <a href=" ../../games/carbo_ate/php/carbo_ate.php" class="item ate-game">
                <p>カーボ当てゲーム</p>
                
                <img src = "http://4.bp.blogspot.com/-D5kKrMBiFxM/VMIt1KJ0L4I/AAAAAAAAqy8/rTn6p9VyVFY/s180-c/onigiri_maru.png" alt = "おにぎり">
                <p>食べ物のカーボはいくつかを答えるクイズです。</p>
            </a>
            <a href="../../games/total_carbo/php/total_carbo.php" class="item total-game">
                <p>トータルカーボ当てゲーム</p>
                <img src = "http://1.bp.blogspot.com/--Z0FQl8l9sU/UbVvQV3OinI/AAAAAAAAUtE/XpDlhdqZxaY/s180-c/fruits_basket.png" alt = "フルーツバスケット">
                <p>指定されたトータルカーボを目指して食べ物を集めましょう</p>
            </a>
            <a href="../../games/anki/php/cardslist.php" class="item anki">
                <p>カーボ暗記帳</p>
                <img src = "https://2.bp.blogspot.com/-MatVFm3S0Fk/VXOTfp034qI/AAAAAAAAuAU/Pt3x4nQOY-I/s400/anki_card.png" alt = "暗記カード">
                <p>食べ物のカーボを暗記カードで覚えましょう</p>
            </a>     
        </div>
        <script type="text/javascript" src = "../../index.js"></script>
        <script type="text/javascript" src = "../../parts/_drawer.js"></script>
    </main>
    <?php

include('../../parts/_footer.php');