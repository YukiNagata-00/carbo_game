<?php
session_start();
require('../../../common.php');

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
if(!$id){
    header('Location: cardslist.php');
    exit();
}
$db = dbconnect();
$stmt = $db->prepare('select id, name, carbo, image from foods  where id =?  limit 1');

if(!$stmt){
    die($db->error);
}

$stmt->bind_param('i', $id);
$success= $stmt->execute();
if(!$success){
    die($db->error);
}

$stmt -> bind_result($id, $name, $carbo, $image);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../../common.css">
    <link rel="stylesheet" href="../css/oneCard.css">

</head>
<body>
    <header>
        <?php echo $id ?>
    </header>
    <main>
        <div class="main-wrapper">
        <div class="aCard">
                <?php while($stmt -> fetch()):?>
                    
                    
                        <p class = "foodName"><?php echo $name;?></p>
                        <!-- <?php echo $carbo;?> -->
                        
                        <img src = "<?php echo $image ?>" class = "foodImg"> 
                    
            </div>
            <?php endwhile; ?>
        </div>

    </main>
    <footer></footer>
</body>
</html>