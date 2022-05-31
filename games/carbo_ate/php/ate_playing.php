<?php
session_start();
require('../../../common.php');
if(isset($_SESSION['id']) && isset($_SESSION['name'])){
    $id = $_SESSION['id'];
    $name = $_SESSION['name'];

}else{
    var_dump("failed");
    // header('Location: ../../login_v.php');
    // exit();
}



// if($records){
//     // while($record = $records-> fetch_assoc()){
//         echo $records;
//     // }
// }


$db = dbconnect();
$stmt = $db ->prepare('select name, carbo, image from foods order by Rand() limit 10');

if(!$stmt){
    die($db -> error);
}
$success = $stmt -> execute();
if(!$success){
    die($db -> error);
}
// $stmt -> bind_result($name, $carbo, $image);

// $stmt ->fetch();
// var_dump($name, $carbo, $image);
// var_dump($records);

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