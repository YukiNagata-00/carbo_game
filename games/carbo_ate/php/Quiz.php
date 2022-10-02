<?php

class Quiz
{
    
    public function divideType(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            // $_SESSION['user_id'] = $user_id;
            // $_SESSION['user_name'] = $user_name;
        
            if($_POST['fund']){
                $_SESSION['type'] = 'fund';
            }else if($_POST['adv']){
                $_SESSION['type'] = 'adv';
            }
        
            header('Location: carbo_array.php');
            exit();
        }
    }



}