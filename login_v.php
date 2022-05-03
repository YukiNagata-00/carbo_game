<?php
//test

session_start();
require('common.php');

$form = [
    'email' => '',
    'password' => '',
];

$error = [];

if($_SERVER['REQUEST_METHOD']  === 'POST')  {
    //フォームから値を受け取り、空文字か確認
    $form['email'] = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    if($form['email'] === '') {
        $error['email']  = 'blank';
    }
    $form['password'] = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_EMAIL);
    if($form['password'] === '') {
        $error['password'] = 'blank';
    }

    if((!empty($form['email']))  && (!empty($form['password']))) {
        
        $db = dbconnect();
        $stmt = $db -> prepare('select id, name, password from members where email= ?');
        if(!$stmt) {
            die($db -> error);
        }
        $stmt -> bind_param('s', $form['email']);
        $success = $stmt -> execute();
        if(!$success) {
            die($db -> error);
        }

        $stmt -> bind_result($id, $name, $hashed_password);
        $stmt -> fetch();

        // var_dump($hashed_password);
        if(password_verify($form['password'], $hashed_password)){
            session_regenerate_id();
            $_SESSION['id'] = $id;
            $_SESSION['name'] = $name;
            // var_dump('success');
            header('Location: ./top/index.php');
            exit();
        }else {
            $error['login'] = 'failed';
            // var_dump('failed');
            // var_dump($form['password'], $hashed_password);
        }

        
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
    <link rel="stylesheet" href="./login_v.css">
</head>
<body>
    <header></header>
    <main>
        <div class="main-wrapper">
            <div class="login-wrapper">
                <h2>ログイン</h2>
                <!-- <form action="../../controller/controller_php/login_c.php" method="POST"> -->
                <form action="" method="POST">
                    <div class = "email-area">
                        <label for = "email">メールアドレス</label>
                        <input type = "text" name = "email" value = "<?php echo  htmlspecialchars($form['email']); ?>">
                        <?php if(isset($error['email']) && $error['email'] === 'blank'): ?>
                            <p class = "error">メールアドレスを入力してください</p>
                        <?php endif; ?>
                    </div>
                    <div>パスワード
                        <input type = "password" name = "password" value = "<?php echo htmlspecialchars($form['password']); ?>">
                        <?php if(isset($error['password']) && $error['password'] === 'blank'): ?>
                            <p class = "error">パスワードを入力してください</p>
                        <?php endif; ?>
                    </div>
                    <?php if(isset($error['loggin']) && $error['login'] === 'failed'):?> 
                        <p>ログインに失敗しました。もう一度お試しください</p>
                    
                    <?php endif; ?>
                    <input type = "submit" value="ログイン">
                </form>
                <a href = "./signup/php/signup_v.php">新規登録はこちら</a>
            </div>
        </div>
    </main>
    <footer></footer>
</body>
</html>
