<?php
session_start();
require('../../common.php');

if(isset($_SESSION['form'])) {
    $form = $_SESSION['form'];
}else {
    header('Location: signup_v.php');
    exit();
}

function masking($password) {
    return str_repeat('●', strlen($password));
}

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db = dbconnect();


    $stmt = $db -> prepare('insert into members (name, email, password) VALUES(?, ?, ?)');
    if(!$stmt) {
        die($pd -> error);
    }

    $password = password_hash($form['password'], PASSWORD_DEFAULT);
    $stmt -> bind_param('sss', $form['name'] , $form['email'], $password);

    $success = $stmt -> execute();
    if(!$success) {
        die($db -> error);
    }

    //unset($_SESSION['form']);
    header('Location: signupDone.php');
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
    <link rel="stylesheet" href="../css/check.css">
    <link rel="stylesheet" href="../css/signup.css">
</head>
<body>
    <header></header>
    <main>
    <h1 class = "carbo_town">Carbo Town</h1>
    <div class="main-wrapper">
            <div class="signup-wrapper">
                <h2>新規登録</h2>
                <p>入力された情報を確認して、登録ボタンを押てください。</p>
                <form action="" method="POST">
                    <div class = "">ユーザーネーム
                        <?php echo htmlspecialchars($form['name']); ?>
                    </div >
                    <div class = "">メールアドレス
                        <?php echo htmlspecialchars($form['email']); ?>
                        
                    </div>
                    <div class = "">パスワード
                        <?php echo masking($form['password']); ?>
                    </div>
                    <input type = "submit" value="新規登録">
                </form>
                <a href = "signup_v.php?action=correction">訂正する</a>
            </div>
        </div>
    </main>
    <footer></footer>
</body>
</html>