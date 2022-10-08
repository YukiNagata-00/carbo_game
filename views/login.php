<?php

session_start();
require('../common.php');
require('../controller/login/login.php');



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/login.css">
    <link rel="stylesheet" href="../common.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Acme&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=M+PLUS+Rounded+1c" rel="stylesheet">
    <title>ログイン</title>
</head>
<body>
    <div class="main">
        <div class="title">
            <div class="title_one">CARBO</div>
            <div class="title_one">&</div>
            <div class="title_one">ME</div>
        </div>
        <div class="login">
            <div class="login_wrapper">
                <h2>LOGIN</h2>
                <form action="" method="POST" >
                    <div class = "email">
                        <input type = "text" name = "email" value = "<?php echo  htmlspecialchars($form['email']); ?>" placeholder="メールアドレス">
                        <div class= "error">
                        <p> </p>
                        <?php if(isset($error['email']) && $error['email'] === 'blank'): ?>
                            <p class = "error">メールアドレスを入力してください</p>
                        <?php endif; ?> 
                        </div>
                    </div>

                    <div class = "password">
                        <input type = "password" name = "password" value = "<?php echo htmlspecialchars($form['password']); ?>" placeholder="パスワード">
                        <div class= "error-area">
                                <p></p>
                            <?php if(isset($error['password']) && $error['password'] === 'blank'): ?>
                                <p class = "error">パスワードを入力してください</p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php if(isset($error['login']) && $error['login'] === 'failed'):?> 
                        <p>ログインに失敗しました。もう一度お試しください</p>
                    <?php endif; ?>
                    <div class="btns">
                        <input type = "submit" value="ログイン" class = "btn login_btn" name = "login">
                        </div>
                        <div class="btns">
                        <input type = "submit" value="ログインせずに使う" class = "btn sub_btn" name = "test_login">
                    </div>
                </form>
                <a href = "../controller/signup/signup.php">新規登録はこちら</a>
                
            </div>
        </div>
    </div>
</body>
</html>
