<?php
session_start();
require('../../../common.php');
include('../../../parts/_header.php');


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

/**
 *  検索機能
 */
$error = "";


/**
 * クリアボタン
 */
if(isset($_POST["clear_btn"])){
    header("Location: " . $_SERVER['SCRIPT_NAME']);
}

/**
 * 検索ボタン押下時
 */
if(isset($_POST["form_txt"]) && isset($_POST['form_btn']) ){

    $input = htmlspecialchars($_POST["form_txt"], ENT_QUOTES);

    if($input == ""){
        $error = "blank";
    }

    if($error != "blank"){
        $db = dbconnect();
        $param = "%{$input}%";
        $stmt = $db-> prepare( "SELECT id, name, carbo, image  FROM foods  WHERE name LIKE ? ORDER BY id DESC LIMIT  5" );
        if(!$stmt) {
            die($db -> error);
        }
        $stmt -> bind_param('s', $param);
        $success = $stmt -> execute();
            if(!$success){
                die($db -> error);
            }
        $stmt-> bind_result($id, $name, $carbo, $image);
    }
}


?>
</head>
<body>
    <header>
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
            <form action="" class="search_form" method="POST">
                <input type="text" class="form_txt" placeholder="暗記カードを検索" name="form_txt">
                <input type="submit" value="検索" class="form_btn" name = "form_btn">
                <input type="submit" value="Clear" name="clear_btn" class="clear_btn">
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
                <div class="to_back">
                    <?php if ($page - 1 > 0): ?>
                        <a href = "?page=<?= $page - 1?>">
                            <img src="https://1.bp.blogspot.com/-Lj5NbsMLENk/UZMs1iWA56I/AAAAAAAASIo/f5HL7seBZYQ/s170/fabric_mark_triangle.png" class="to_back_img">
                        </a>
                    <?php endif; ?>
                    
                </div>
                <div class="now_page">
                    <p><?= $page ?> / <?= $max_page ?></p>
                </div>
                <div class="to_next">
                    <?php if($page < $max_page) :?>
                        <a href = "?page=<?= $page + 1?>">
                            <img src="https://1.bp.blogspot.com/-Lj5NbsMLENk/UZMs1iWA56I/AAAAAAAASIo/f5HL7seBZYQ/s170/fabric_mark_triangle.png" class="to_next_img">
                        </a>
                    <?php endif; ?>
                </div>
                
            </div>

    

    </main>
<?php
include('../../../parts/_footer.php');
