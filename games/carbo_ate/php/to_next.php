<?php

session_start();
require('../../../common.php');


if( isset($_SESSION['foods']) && isset($_SESSION['result']) && isset($_SESSION['q_index'])){
    $foods =  $_SESSION['foods'];
    $q_index =  $_SESSION['q_index'];
    $result = $_SESSION['result'];
    $point = $_SESSION['point'];
}else{
    // header('Location: carbo_ate.php');
    // exit();
}

// if($q_index < 4){
//     $q_index++;
//     $_SESSION['foods'] = $foods;
//     $_SESSION['result'] = $result;
//     $_SESSION['q_index'] = $q_index;
//     $_SESSION['point'] = $point;
//     header('Location: ate_playing.php');
//     exit();
// }else{
//     $_SESSION['foods'] = $foods;
//     $_SESSION['result'] = $result;
//     $_SESSION['point'] = $point;
//     header('Location: result.php');
//     exit();
// }
?>