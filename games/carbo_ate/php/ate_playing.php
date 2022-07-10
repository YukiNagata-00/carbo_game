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
}else if(isset($_SESSION['foods'])){

}else{
    // var_dump("failed");
    // header('Location: ../../login_v.php');
    // exit();
}



var_dump($result);
var_dump($point);
$q_id = $foods[$q_index]['id'];
$q_name = $foods[$q_index]['name'];
$q_carbo = $foods[$q_index]['carbo'];
$q_image = $foods[$q_index]['image'];

var_dump($q_carbo);
//入力値のチェック_____________________________________________________________
$error = [];
if(isset($_POST['input_btn'])){
    $input_ans = (double)htmlspecialchars($_POST['input_ans']);
    // var_dump($input_ans);
    // var_dump(strlen($input_ans));

    if(!$input_ans){
        var_dump('blank');
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
        header('Location: check.php');
        exit();
    }


}
//-------------------------------------------------------------------------





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
    <header>
    <form action = "carbo_ate.php">
        <input type = "submit" value = "戻る">
    </form>
    </header>
    <main>
    <div class="top-title">
            <h1>第<?= $q_index + 1 ?>問</h1>
        
    </div>
    <div class="img-wrapper">
        <p><?= $q_name ?></p>
        <img src = "<?= $q_image ?>">
    </div>
    
    <div class="form">
        <p>カーボを入力してね<p>
        <!-- エラー文表示 -->
        <?php if(!empty($error)): ?> 
            <?php foreach ($error as $val): ?>
                <p><?= $val ?></p>
            <?php unset($val); ?>
            <?php endforeach; ?>
        <?php endif; ?>
        <form action = "#" method = "POST" >
            <input type = "text"  name = "input_ans">
            <input type = "submit" value = "決定" name = "input_btn">
        </form>


    </div>
    </main>
    <footer></footer>
</body>
</html>