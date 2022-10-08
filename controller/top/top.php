<?php


if(isset($_SESSION['user_id']) && isset($_SESSION['user_name'])){
    $user_id = $_SESSION['user_id'];
    $user_name = $_SESSION['user_name'];

}else{
    header('Location: login.php');
    exit();
}
