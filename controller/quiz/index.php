<?php
require_once('../config.php');

$db = dbconnect();
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    if(isset($_POST['easy_start_btn'])){
        var_dump( $_SESSION['index']);
        $quiz = new EasyQuiz($db);
        // if(isset( $_SESSION['current_num']));{
        // var_dump( $_SESSION['current_num']);
        // unset( $_SESSION['current_num']);
        // }
        // var_dump($quiz->foods);
        // var_dump( $_SESSION['result']);
        // $_SESSION['foods'] =  $quiz->foods;
        // $_SESSION['choices'] =  $quiz->choices;
        header('Location: quiz_playing.php');
        exit();
    }
}
?>

