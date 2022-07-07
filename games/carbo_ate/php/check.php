<?php
session_start();
require('../../../common.php');

if(isset($_SESSION['input_ans']) && isset($_SESSION['foods']) && isset($_SESSION['result']) && isset($_SESSION['q_index'])){
    
    $input_ans = $_SESSION['input_ans'];
    $foods =  $_SESSION['foods'];
    $q_index =  $_SESSION['q_index'];
    $result = $_SESSION['result'];
    $point = $_SESSION['point'];
}

// var_dump($input_ans);
// var_dump($foods);
// var_dump($q_index);
// var_dump($result);



$ans_carbo = (double)$foods[$q_index]['carbo'];
// var_dump($ans_carbo);

if($input_ans == $ans_carbo){
    var_dump("cor");
    $result[] = "correct";
    $point += 10;
}else{
    var_dump("miss");
    $result[] = "miss";
    
    $ans_diff = abs($ans_carbo - $input_ans);
    if($ans_diff <= 1){
        $point += 5;
    }else if($ans_diff > 1 && $ans_diff <= 2){
        $point += 4;
    }else if($ans_diff > 2 && $ans_diff <= 3){
        $point += 3;
    }
    
}

if($q_index < 4){
    $q_index++;
    $_SESSION['foods'] = $foods;
    $_SESSION['result'] = $result;
    $_SESSION['q_index'] = $q_index;
    $_SESSION['point'] = $point;
    header('Location: ate_playing.php');
    exit();
}else{
    $_SESSION['foods'] = $foods;
    $_SESSION['result'] = $result;
    $_SESSION['point'] = $point;
    header('Location: result.php');
    exit();
}

?>