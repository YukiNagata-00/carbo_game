<?php
session_start();
require('../../../common.php');
include('../../../parts/_header.php');
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
if(!$id){
    header('Location: my_cardslist.php');
    exit();
}
//DB接続
$db = dbconnect();

//idを取得し配列に格納
$ids = [];
$results = $db->query("SELECT * FROM cards ");
if($results){
    while($result = $results->fetch_assoc()){
        $ids[]= $result['id'];
    }
}
// print_r($ids);
$int_id = (int)$id;
//配列のインデックス取得
$index = array_search($int_id, $ids);



//idの最大値と最小値を取得
$records = $db -> query('SELECT  MAX(id) AS max, MIN(id) AS min FROM cards');
$record = $records->fetch_assoc();
$max_id = $record['max'];
$min_id = $record['min'];

// var_dump($min_id);
// var_dump($max_id);


//データ取得
$stmt = $db->prepare('select id, name, carbo, image from cards  where id =?  limit 1');

if(!$stmt){
    die($db->error);
}

$stmt->bind_param('i', $id);
$success= $stmt->execute();
if(!$success){
    die($db->error);
}

$stmt -> bind_result($id, $name, $carbo, $image);
//test



?>

    <link rel="stylesheet" href="../css/oneCard.css">

</head>
<body>
    <header>
    </header>
    <main>
        <div class="main-wrapper">
            <div class="btns">
                    <a href="my_cardslist.php">戻る</a>
                    <form action = "" method="POST">
                        <input type = "submit" value = "編集" name = "edit">
                    </form>
            </div>
            <div class="aCard"  id = "card">
            
                <?php while($stmt -> fetch()):?>
                    
                    <div class = "foodName" ><div><?php echo $name;?></div></div>
                        <p id = "carbo" class = "carbo off"><?php echo $carbo;?> </p>
                        <img src = "../../game_images/<?php echo $image ?>" class = "foodImg" id = "img"> 
                    
            </div>
            <?php endwhile; ?>
            
            <div class="onecard_btns">
                <?php if($id != $min_id):?>
                    <a href="?id=<?= $ids[$index - 1] ?>" class="back_btn">前のカード</a>
                <?php   endif; ?>
                <?php if($id != $max_id):?>
                    <a href = "?id=<?= $ids[$index + 1] ?>"  class="next_btn">次のカード</a>
                <?php   endif; ?>    
            </div>

<!-- //editページ遷移 -->
    <?php 
        if(isset($_POST['edit'])){
            $_SESSION['id'] = $id;
            $_SESSION['name'] = $name;
            $_SESSION['carbo'] = $carbo;
            $_SESSION['image'] = $image;
            header('Location: edit.php');
            exit();
        }
    ?>
        </div>

    </main>
    <script type="text/javascript" src = "../js/oneCard.js"></script>
<?php

include('../../../parts/_footer.php');