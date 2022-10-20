<?php
$db = dbconnect();
// var_dump($_SESSION['foods']);
$foods = $_SESSION['foods'];
$index =  $_SESSION['index'];
$point =  $_SESSION['point'];
$result =  $_SESSION['result'];
var_dump( $point);
var_dump($result);
var_dump($index);
$choices = $_SESSION['choices'];
$_SESSION['afterClicked'] = false;


if(isset($_POST['next_btn'])){
    
    if($index < 4){
        $index ++;
        $_SESSION['foods'] = $foods;
        $_SESSION['result'] = $result;
        $_SESSION['index'] = $index;
        $_SESSION['point'] = $point;
    }else{
        $_SESSION['foods'] = $foods;
    $_SESSION['result'] = $result;
    $_SESSION['index'] = $index;
    $_SESSION['point'] = $point;
        header('Location: quiz_result.php');
        exit();
    }

}
var_dump($foods[$index]['carbo']);
// var_dump($_POST['selected_choice']);
if(isset($_POST['selected_choice'])){
    $_SESSION['afterClicked'] = true;
    if($foods[$index]['carbo'] ==  $_POST['selected_choice']){
        echo "reight";
        $point += 20;
        $result[]= "ok";
        $_SESSION['result'] = $result;
        $_SESSION['point'] = $point;
        
    }else{
        echo "wrong";
        $result[]= "ng";

        $_SESSION['result'] = $result;
        $_SESSION['point'] = $point;
    }
    unset($_POST['selected_choice']);
}
?>
