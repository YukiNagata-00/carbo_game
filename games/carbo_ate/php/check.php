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


$ans_carbo = (double)$foods[$q_index]['carbo'];

if($type === 'fund'){
    checkAnsOfFund((double)$selectedChoice, $ans_carbo, $point, $result);
}else{
    checkAnsOfAdv($input_ans, $ans_carbo, $point, $result);
}

// var_dump($ans_carbo);

function setResultArray($val){
    $result[] = $val;
    return $result;
}

function checkAnsOfFund($input, $ans_carbo, &$point, &$result){
    if($input == $ans_carbo){
        $result[] = "correct";
        
        $point += 20;
    }else{
        $result[] = "miss";
        return 0;
    }
}

function checkAnsOfAdv($input, $ans_carbo, &$point, &$result){
    if($input == $ans_carbo){
        $result[] = "correct";
        $point += 10;
    }else{
        $result[] = "miss";
        
        $ans_diff = abs($ans_carbo - $input);
        if($ans_diff <= 1){
            $point += 5;
        }else if($ans_diff > 1 && $ans_diff <= 2){
            $point += 2;
        }else if($ans_diff > 2 && $ans_diff <= 3){
            $point += 3;
        } 
        
    }

}
var_dump($result);

if(!empty($result)){
    $_SESSION['foods'] = $foods;
    $_SESSION['q_index'] = $q_index;
    $_SESSION['result'] = $result;
    $_SESSION['point'] = $point;
    $_SESSION['type'] = $type;
    header('Location: ate_playing.php');
    exit();
}


?>