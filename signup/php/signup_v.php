<?php
session_start();
require('../../common.php');


if(isset($_GET['action']) && $_GET['action'] === 'correction') {
    $form = $_SESSION['form'];
}else {
    $form = [
        'name' => '',
        'email' => '',
        'password' => ''
    ];
}


$error =[];


if($_SERVER['REQUEST_METHOD'] === 'POST') {
    //ユーザーネーム取得
    $form['name'] = htmlspecialchars($_POST['name'], ENT_QUOTES);
    if($form['name'] === '') {
        $error['name'] = 'blank';
    }
    //email取得
    $form['email'] = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    if($form['email'] === '') {
        $error['email'] = 'blank';
    }else if($form['email']){
        $error['email'] = 'incorrect';
    }
    //email duplicate 確認
    $db = dbconnect();
    $stmt = $db -> prepare('select count(*) from members where email=?');
    if(!$stmt) {
        die($db -> error);
    }
    $stmt -> bind_param('s', $form['email']);
    $success = $stmt-> execute();
    if(!$success){
        die($db -> error);
    }
    
    $stmt -> bind_result($cnt);
    $stmt -> fetch();
    if($cnt > 0) {
        $error['email'] = 'duplicate';
    }

    //パスワード取得
    $form['password'] = htmlspecialchars($_POST["password"], ENT_QUOTES);
    if($form['password'] === '') {
        $error['password'] = 'blank';
    }else if(strlen($form['password']) < 4){
        $error['password'] = 'short';
    }
    //エラー確認
    if(empty($error)) {
        $_SESSION['form'] = $form;
        header('Location: check_v.php');
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
    <link rel="stylesheet" href="../../common.css">
    <link rel="stylesheet" href="../css/signup_v.css">
</head>
<body>
    <header></header>
    <main>
    <div class="main-wrapper">
            <div class="signup-wrapper">
                <h2>新規登録</h2>
                <form action="" method="POST">
                    <div class = "">ユーザーネーム
                        <input type = "text" name = "name" value = "<?php echo htmlspecialchars($form['name']);?>"> 
                        <?php if(isset($error['name']) && $error['name'] === 'blank'): ?>
                            <p class = "error">ユーザーネームを入力してください。</p>
                        <?php endif; ?>
                    </div >
                    <div class = "">メールアドレス
                        <input type = "text" name = "email" value = "<?php  echo htmlspecialchars($form['email']);?>">
                        <?php if(isset($error['email']) && $error['email'] === 'blank'): ?>
                            <p class = "error">メールアドレスを入力してください。</p>
                        <?php endif; ?>
                        <?php if(isset($error['email']) && $error['email'] === 'duplicate'):?>
                            <p class = "error">このメールアドレスはすでに使われています。</p>
                        <?php  endif; ?>
                        <?php if(isset($error['email']) && $error['email'] === 'incorrect'):?>
                            <p class = "error">メールアドレスを正しく入力してください。</p>
                        <?php  endif; ?>
                    </div>
                    <div class = "">パスワード
                        <input type = "password" name = "password" value = "<?php echo htmlspecialchars($form['password']); ?>">
                        <?php if(isset($error['password']) && $error['password'] === 'blank'): ?>
                            <p class = "error">ユーザーネームを入力してください。</p>
                        <?php endif; ?>
                        <?php if(isset($error['password']) && $error['password']=== 'short'): ?>
                            <p class = "error">パスワードは４文字以上で入力してください。</p>
                        <?php endif; ?>
                    </div>
                    <input type = "submit" class = "btn" value="新規登録">
                </form>
                <a href = "../../login_v.php">戻る</a>
            </div>
        </div>
    </main>
    <footer></footer>
</body>
</html>