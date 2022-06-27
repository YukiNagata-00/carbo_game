<?php
session_start();
require('../../../common.php');

if(isset($_SESSION['user_id']) && isset($_SESSION['user_name']) && isset($_SESSION['foods'])){
    $user_id = $_SESSION['user_id'];
    $user_name = $_SESSION['user_name'];
    $foods =  $_SESSION['foods'];

}else{
    var_dump("failed");
    // header('Location: ../../login_v.php');
    // exit();
}




var_dump($foods);







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
    </header>
    <main>
    <div class="top-title">
        
        <h1>第1問</h1>
        <!-- <?php while($stmt -> fetch()):?>
        <?= $name ?>
        <?php endwhile; ?> -->
    </div>
    <div class="img-wrapper"></div>
    
    <div class="form">
        <p>カーボを入力してね<p>
        <form action = "" method = "POST">
            <input type = "text" name = "input" >
            <input type = "submit" name = "btn" value = "決定">
        </form>


    </div>
    </main>
    <footer></footer>
</body>
</html>