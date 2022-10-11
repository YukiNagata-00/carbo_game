<?php
require_once('../config.php');

$db = dbconnect();
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    if(isset($_POST['easy_start_btn'])){
    
        $quiz = new EasyQuiz($db);
        // if(isset($SESSION['choices'])){
        //     unset($SESSION['choices']);
        // }
        var_dump($quiz->foods);
        var_dump($quiz->choices);
        // $_SESSION['foods'] =  $quiz->foods;
        // $_SESSION['choices'] =  $quiz->choices;
        header('Location: quiz_playing.php');
        exit();
    }
}
?>

