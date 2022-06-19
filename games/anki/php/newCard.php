<?php
session_start();
require('../../../common.php');

//session取得
if(isset($_SESSION['user_id']) && isset($_SESSION['user_name'])){
    $user_id = $_SESSION['user_id'];
    $user_name = $_SESSION['user_name'];
}else{
    var_dump("failed");
    // header('Location: ~/login_v.php');
    // exit();
}


$form = [
    'food_name' => '',
    'carbo'=> '',
];

$error = [];


if(isset($_POST['food_name']) && isset($_POST['carbo'])) {
    //食べ物の名前取得
    $form['food_name'] = htmlspecialchars($_POST['food_name'], ENT_QUOTES);
    // var_dump($form['food_name']);
    if($form['food_name'] === ""){
        $error['food_name'] = 'blank';
        // var_dump("empty");
    }


    //糖質量取得
    $form['carbo']= htmlspecialchars($_POST['carbo'], ENT_QUOTES);
    // var_dump($form['carbo']);
    if($form['carbo'] === ""){
        $error['carbo'] = 'blank';   
    }else if(!is_numeric($form['carbo'])){//数値か確認
        // var_dump("string");
        $error['carbo'] = 'string';
    }
    $doubled_carbo = (double)$form['carbo'];
    $form['carbo'] = $doubled_carbo;
    var_dump($form['carbo']);
    
    if(isset($_FILES['image'])){
        $image =  $_FILES['image'];
        
        if(empty($image['name'])){//画像が選択されているか
            
        }else{
            $type = mime_content_type($image['tmp_name']);
            
            if($type !== 'image/png' && $type !== 'image/jpeg'){//画像の形式確認
                $error['image'] = 'type';
                
            }
            
        }
    }
    
    //エラー確認
    if(empty($error)){
        $_SESSION['form'] = $form;
        $_SESSION['id'] = $user_id;
        $_SESSION['name'] = $user_name;
        if($image['name'] !== '') {

            //画像のアップロード
            if(str_contains($image['name'], 'game_images')){//すでにファイルにアップロードされている画像だったら
                
                $filename = $image['name'];

            }else{
                $filename = date('YmdHis').'game_images'. '_' . $image['name'];
            
                if(!move_uploaded_file($image['tmp_name'], '../../game_images/' . $filename)){
                    die('ファイルのアップロードに失敗しました。');
                }

            }
            
            $_SESSION['form']['image'] = $filename;
        }else {
            $_SESSION['form']['image'] = '';
        }


        header('Location: newCard_db.php');
        exit();
    }


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
        <a href= "my_cardslist.php">MY暗記カード一覧へ戻る</a>
        <?= $user_name ?>さん
    </header>
    
    <main>
        <div class="top-title">新規暗記カード登録</div>
        <div class="main-wrapp">
            <form action = "" method="POST" enctype="multipart/form-data" >
                <p>食べ物の名前</p>
                <input tyoe ="text" name = "food_name">
                <br>
                <?php if(isset($error['food_name'] )&& $error['food_name']=== 'blank'): ?>
                    <p class = "error">食べ物の名前を入力してください</p>
                <?php endif; ?>
                <p>糖質量</p>
                <input tyoe = "text" name = "carbo">
                <br>
                <?php if(isset($error['carbo'] )&& $error['carbo']=== 'blank'): ?>
                    <p class = "error">糖質量を入力してください</p>
                <?php endif; ?>
                <?php if(isset($error['carbo'] )&& $error['carbo']=== 'string'): ?>
                    <p class = "error">数字を入力してください</p>
                <?php endif; ?>
                <p>画像</p>
                <input type= "file" name = "image">
                <br>
                
                <?php if(isset($error['image'] )&& $error['image']=== 'type'): ?>
                    <p class = "error">「.png」または「.jpeg」の画像を指定してください。</p>
                <?php endif; ?>
                <input type = "submit" value = "登録">
            </form>
            
        </div>

    </main>
    <footer></footer>

</body>
</html>