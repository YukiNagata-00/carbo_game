<?php
session_start();
require('../../../common.php');
require_once('../../../config.php');


$game = unserialize($_SESSION['instance']);
$q_name = $game->foods[$game->q_index]['name'];
$q_carbo = $game->foods[$game->q_index]['carbo'];
$q_image = $game->foods[$game->q_index]['image'];


if($game->type === 'fund'){

    $choices = $game->playingFund($q_carbo);

}else if($game->type === 'adv'){

    //入力値のチェック_____________________________________________________________
    $error = [];
    if(isset($_POST['input_btn'])){
        $input_ans = (double)htmlspecialchars($_POST['input_ans']);

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
            $_SESSION['type'] = $type;
            header('Location: check.php');
            exit();
        }
    }
}
//-------------------------------------------------------------------------

if(isset($_POST[('choice_submit')])){
    $game->checkAnsOfFund($q_carbo);
}

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
        <h1>第 <?= $game->q_index + 1 ?> 問</h1>
    </div>
    <div class="img-wrapper">
        <div class="content">
            <p><?= $q_name ?></p>
            <img src = "<?= $q_image ?>">
        </div>
        
    </div>
    
    <div class="ans_wrapper ">
    <?php if($game->q_index + 1 == count($game->result)) :?>
        <div class="ans_content ">
            <?php if($game->result[$game->q_index] == "correct"): ?>
                    <img src="https://4.bp.blogspot.com/-CUR5NlGuXkU/UsZuCrI78dI/AAAAAAAAc20/mMqQPb9bBI0/s800/mark_maru.png" alt="マル">
                <?php  else :?>
                    <img src="https://1.bp.blogspot.com/-eJGNGE4u8LA/UsZuCAMuehI/AAAAAAAAc2c/QQ5eBSC2Ey0/s800/mark_batsu.png" alt="バツ">
                <?php endif; ?>
                <p>正解は、<?= $q_carbo  ?>カーボ</p>
        </div>
        <?php endif; ?>
    </div>
    
    <div class="next_form_area ">
        <?php if($game->q_index + 1 == count($game->result)) :?>
            <form action="" method="POST" class = "next_form ">
                <input type="submit" name = "next_btn" value="次の問題へ">
            </form>
        <?php endif; ?>
    </div>
    <div class="form_wrapper">
        <?php if($game->type === 'adv') :?>
            <?php if($q_index  == count($result)) :?>
                <?php if(!empty($error)): ?> 
                    <?php foreach ($error as $val): ?>
                        <p><?= $val ?></p>
                    <?php unset($val); ?>
                    <?php endforeach; ?>
                <?php endif; ?>
                <form action = "" method = "POST" id ="form"  autocomplete="off">
                    <input type = "text"  name = "input_ans" class="input_ans">
                    <input type = "submit" value = "決定" name = "input_btn" id ="input_btn">
                </form>
            <?php endif; ?>
        <?php else :?>
            <div class="choices_wrapper">
                <?php  foreach($choices as $choice) :?>
                    <form action="" method="POST" >
                        <div class="choice">
                            <input type="hidden" name = "choice" value="<?= $choice ?>"> <?= $choice ?>
                        </div>
                        <input type="hidden" value="<?= $choice ?>"  name = "choice_submit" >
                    </form>
                <?php  endforeach; ?>
            </div>
        <?php endif ;?>

    </div>

    </main>
    <footer></footer>
    <script src="../js/choice.js" ></script>
</body>
</html>