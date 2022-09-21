<?php
session_start();
require('../../../common.php');
include('../../../parts/_head.php');

if(isset($_SESSION['user_name']) && isset($_SESSION['user_name'])){
    $user_id = $_SESSION['user_id'];
    $user_name = $_SESSION['user_name'];
}else{
    var_dump("failed");
    // header('Location: ../../login_v.php');
    exit();
}
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $_SESSION['user_id'] = $user_id;
    $_SESSION['user_name'] = $user_name;
    header('Location: carbo_array.php');
    exit();
}
?>

    <link rel="stylesheet" href="../css/carbo-ate.css">
</head>
<body class="drawer drawer--left">
<?php
include('../../../parts/_header.php');
?>

<header role="banner">

</header>
    <main role="main">
    <div class="top">
            <div class="btns">
                <a href = "../../../top/php/index.php" >戻る</a>
            </div>
            <div class="top-title">
            <h1>カーボ当てゲーム</h1>
            <p>食べ物のカーボはいくつかを答えよう！
                ここでは糖質量 10g = 1カーボとします。</p>
            </div>
        </div>
        <div class="main-wrapper">
            <div class="container">
                <ul class="menu">
                <li><a href="#" class="item active " data-id="fund">基本編</a></li>
                <li><a href="#" class="item " data-id="adv" >応用編</a></li>
                </ul>

                <section class="content active " id="fund">
                <div class="game-example"></div>
                基本編
                サイトの概要。サイトの概要。サイトの概要。サイトの概要。サイトの概要。サイトの概要。
                </section>

                <section class="content " id="adv">
                <div class="game-example"></div>
                応用編
                サービス内容。サービス内容。
                </section>

            </div>
        </div>
        <div class="btn-wrapper">
            <form action= "" method = "POST">
                <input type = "submit" class = "start-btn"  value = "スタート">
            </form>
        </div>
        <script type="text/javascript" src = "../../../parts/_drawer.js"></script>
        <script type="text/javascript" src = "../../../parts/_tab.js"></script>
    </main>
<?php
include('../../../parts/_footer.php');