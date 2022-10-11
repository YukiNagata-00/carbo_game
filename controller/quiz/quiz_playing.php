<?php
$db = dbconnect();
// var_dump($_SESSION['foods']);
$foods = $_SESSION['foods'];
$index =  $_SESSION['current_num'];
$point =  $_SESSION['point'];
$result =  $_SESSION['result'];
var_dump( $point);
var_dump($result);
$choices = $_SESSION['choices'];
// var_dump($choices);

if(isset($_GET['selected_choice'])){
    echo $_GET['selected_choice'];
    if($foods[$index]['carbo'] ==  $_GET['selected_choice']){
        echo "reight";
        $point += 20;
    }else{
        echo "wrong";
    }
}


?>