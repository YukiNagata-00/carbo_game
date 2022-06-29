<?php
session_start();
require('../../../common.php');

if(isset($_SESSION['input_ans']) && isset($_SESSION['foods']) && isset($_SESSION['result']) && isset($_SESSION['q_index'])){
    
    $input_ans = $_SESSION['input_ans'];
    $foods =  $_SESSION['foods'];
    $q_index =  $_SESSION['q_index'];
    $result = $_SESSION['result'];

}
// else{

// }
var_dump($input_ans);
var_dump($foods);
var_dump($q_index);
var_dump($result);

$ans_carbo = (double)$foods[$q_index]['carbo'];
var_dump($ans_carbo);

if($input_ans == $ans_carbo){
    var_dump("cor");
    $result[] = "correct";
}else{
    var_dump("miss");
    $result[] = "miss";
}

if($q_index < 4){
    $q_index++;
    $_SESSION['foods'] = $foods;
    $_SESSION['result'] = $result;
    $_SESSION['q_index'] = $q_index;
    header('Location: ate_playing.php');
    exit();
}else{
    $_SESSION['foods'] = $foods;
    $_SESSION['result'] = $result;
    header('Location: result.php');
    exit();
}

?>