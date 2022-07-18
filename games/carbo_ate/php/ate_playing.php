<?php
session_start();
require('../../../common.php');

if(isset($_SESSION['user_id']) && isset($_SESSION['user_name']) && isset($_SESSION['foods'])){
    $user_id = $_SESSION['user_id'];
    $user_name = $_SESSION['user_name'];
    $foods =  $_SESSION['foods'];
    $q_index =  $_SESSION['q_index'];
    $result = $_SESSION['result'];
    $point = $_SESSION['point'];
}else{
    // var_dump("failed");
    // header('Location: ../../login_v.php');
    // exit();
}


var_dump($result);
// var_dump($point);
$q_id = $foods[$q_index]['id'];
$q_name = $foods[$q_index]['name'];
$q_carbo = $foods[$q_index]['carbo'];
$q_image = $foods[$q_index]['image'];

// var_dump($q_carbo);
//入力値のチェック_____________________________________________________________
$error = [];
if(isset($_POST['input_btn'])){
    $input_ans = (double)htmlspecialchars($_POST['input_ans']);
    // var_dump($input_ans);
    // var_dump(strlen($input_ans));

    if(!$input_ans){
        $error[] = '答えを入力してください。';
    }else if(strlen($input_ans) > 4 ){
        $error[] = '正しい値を入力してください。';
    }

    if(empty($error)){
        $_SESSION['input_ans'] = $input_ans;
        $_SESSION['foods'] = $foods;
        $_SESSION['result'] = $result;
        $_SESSION['q_index'] = $q_index;
        $_SESSION['point'] = $point;
        // header('Location: check.php');
        exit();
    }


}
//-------------------------------------------------------------------------


//[次の問題へ]ボタンを押したら
if(isset($_POST['next_btn'])){
    $_SESSION['foods'] = $foods;
    $_SESSION['result'] = $result;
    $_SESSION['q_index'] = $q_index;
    $_SESSION['point'] = $point;
    header('Location: to_next.php');
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
    <link rel="stylesheet" href="../css/ate_playing.css">
    
</head>
<body>
    <header></header>
    <main>

    <div class="top">
        <a href="carbo_ate.php">ゲーム画面TOPへ</a>
        <h1>第 <?= $q_index + 1 ?> 問</h1>
    </div>
    <div class="img-wrapper">
        <div class="content">
            <p><?= $q_name ?></p>
            <img src = "<?= $q_image ?>">
        </div>
        
    </div>
    <div class="ans_wrapper ">
        <div class="ans_content off">
                <!-- <img src="https://4.bp.blogspot.com/-CUR5NlGuXkU/UsZuCrI78dI/AAAAAAAAc20/mMqQPb9bBI0/s800/mark_maru.png" alt="マル"> -->
                <img src="https://1.bp.blogspot.com/-eJGNGE4u8LA/UsZuCAMuehI/AAAAAAAAc2c/QQ5eBSC2Ey0/s800/mark_batsu.png" alt="バツ">
                <p>正解は、<?= $q_carbo  ?>カーボ</p>
        </div>
    </div>
    <div class="next_form_area ">
            <form action="" method="POST" class = "next_form off">
                <input type="submit" name = "next_btn" value="次の問題へ">
            </form>
    </div>
    <div class="form_wrapper">
        <?php if(!empty($error)): ?> 
            <?php foreach ($error as $val): ?>
                <p><?= $val ?></p>
            <?php unset($val); ?>
            <?php endforeach; ?>
        <?php endif; ?>
        <form action = "" method = "POST" id ="form" >
            <input type = "text"  name = "input_ans" class="input_ans">
            <input type = "submit" value = "決定" name = "input_btn" id ="input_btn">
        </form>
    </div>

    </main>
    <footer></footer>
    <script type="text/javascript" src = "../js/ate_playing.js"></script>
</body>
</html>