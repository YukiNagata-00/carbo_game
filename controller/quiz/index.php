<?php
require_once('../config.php');

$db = dbconnect();
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    if(isset($_POST['easy_start_btn'])){
        $quiz = new EasyQuiz($db);
        var_dump($quiz->foods[0]['carbo']);
        var_dump($quiz->choices[0]);
        header('Location: quiz_playing.php');
        exit();
    }
}
?>

