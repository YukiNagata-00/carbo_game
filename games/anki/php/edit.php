<?php

session_start();
require('../../../common.php');


if(isset($_SESSION['id']) && isset($_SESSION['name']) && isset($_SESSION['carbo']) && isset($_SESSION['image'])){
    $id = $_SESSION['id'];
    $name = $_SESSION['name'];
    $carbo = $_SESSION['carbo'];
    $image= $_SESSION['image'];
}else{
    echo "failed";
    // header('Location: my_cardslist.php');
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
    
    if($form['food_name'] === ""){
        $error['food_name'] = 'blank';
    
    }


    //糖質量取得
    $form['carbo']= htmlspecialchars($_POST['carbo'], ENT_QUOTES);
    
    if($form['carbo'] === ""){
        $error['carbo'] = 'blank';   
    }else if(!is_numeric($form['carbo'])){//数値か確認
        // var_dump("string");
        $error['carbo'] = 'string';
    }
    $doubled_carbo = (double)$form['carbo'];
    $form['carbo'] = $doubled_carbo;
    
    
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
        $_SESSION['id'] = $id;
        $_SESSION['name'] = $name;
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


        header('Location: editCard_db.php');
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
    <header></header>
    <main>
        <div class="top-title">
            <h1>カード編集画面</h1></div>
        <div class="main-wrapper">

            
            <form action = "" method="POST" enctype="multipart/form-data" >
                <p>食べ物の名前</p>
                <input tyoe ="text" name = "food_name" value="<?= $name ?>">
                <br>
                <?php if(isset($error['food_name'] )&& $error['food_name']=== 'blank'): ?>
                    <p class = "error">食べ物の名前を入力してください</p>
                <?php endif; ?>
                <p>糖質量</p>
                <input tyoe = "text" name = "carbo" value="<?= $carbo ?>">
                <br>
                <?php if(isset($error['carbo'] )&& $error['carbo']=== 'blank'): ?>
                    <p class = "error">糖質量を入力してください</p>
                <?php endif; ?>
                <?php if(isset($error['carbo'] )&& $error['carbo']=== 'string'): ?>
                    <p class = "error">数字を入力してください</p>
                <?php endif; ?>
                <p>画像</p>
                
                <img src = "../../game_images/<?= $image ?>">
                <input type= "file" name = "image" value="<?= $image ?>">
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