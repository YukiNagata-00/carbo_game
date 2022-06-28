<?php
session_start();
require('../../../common.php');



if(isset($_SESSION['user_name']) && isset($_SESSION['user_name'])){
    $user_id = $_SESSION['user_id'];
    $user_name = $_SESSION['user_name'];
}else{
    var_dump("failed");
    header('Location: carbo_ate.php');
    exit();
}


$db = dbconnect();


$foods = [];
$records = $db->query("SELECT * FROM foods ORDER BY RAND() LIMIT 5");
if($records){
    while($record = $records->fetch_assoc()){
        $foods[]= $record;
    }
}
print_r($foods);



if(isset($foods)){
    $_SESSION['foods'] = $foods;
    $_SESSION['user_id'] = $user_id;
    $_SESSION['user_name'] = $user_name;
    header('Location: ate_playing.php');
}
?>