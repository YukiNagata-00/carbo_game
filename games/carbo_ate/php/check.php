<?php
session_start();
require('../../../common.php');

if(isset($_SESSION['input_ans']) || isset($_SESSION['selectedChoice']) ){
    $selectedChoice =$_SESSION['selectedChoice'];
    $input_ans = $_SESSION['input_ans'];
    $foods =  $_SESSION['foods'];
    $q_index =  $_SESSION['q_index'];
    $result = $_SESSION['result'];
    $point = $_SESSION['point'];
    $type = $_SESSION['type'];
}else{
    var_dump("failed");
}

// var_dump($input_ans);
var_dump($type);
var_dump((double)$selectedChoice);
// var_dump($q_index);
// var_dump($result);
// var_dump($point);



$ans_carbo = (double)$foods[$q_index]['carbo'];

if($type === 'fund'){
    $point += checkAnsOfFund((double)$selectedChoice, $ans_carbo);
    var_dump($point);
}else{
    $point += checkAnsOfAdv($input_ans, $ans_carbo);
}

var_dump($ans_carbo);

function checkAnsOfFund($input, $ans_carbo){
    if($input === $ans_carbo){
        $result[] = "correct";
        return 20;
    }else{
        $result[] = "miss";
        return 0;
    }
}

function checkAnsOfAdv($input, $ans_carbo){
    if($input == $ans_carbo){
        var_dump("cor");
        $result[] = "correct";
        return 10;
    }else{
        var_dump("miss");
        $result[] = "miss";
        
        $ans_diff = abs($ans_carbo - $input);
        if($ans_diff <= 1){
            return 5;
        }else if($ans_diff > 1 && $ans_diff <= 2){
            return 2;
        }else if($ans_diff > 2 && $ans_diff <= 3){
            return 3;
        } 
        
    }

}
print_r($result);
var_dump($q_index);

if(!empty($result)){
    $_SESSION['foods'] = $foods;
    $_SESSION['q_index'] = $q_index;
    $_SESSION['result'] = $result;
    $_SESSION['point'] = $point;
    header('Location: ate_playing.php');
    exit();
}


?>