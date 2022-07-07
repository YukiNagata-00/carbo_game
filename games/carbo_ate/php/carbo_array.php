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

//foods配列のインデックス
$q_index = 0;

//○か×か格納する配列
$result = [];

//ポイント
$point =0;
if(isset($foods)){
    $_SESSION['foods'] = $foods;
    $_SESSION['user_id'] = $user_id;
    $_SESSION['user_name'] = $user_name;
    $_SESSION['q_index'] = $q_index;
    $_SESSION['result'] = $result;
    $_SESSION['point'] = $point;
    header('Location: ate_playing.php');
}
?>