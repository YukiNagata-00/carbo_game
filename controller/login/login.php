<?php

$form = [
    'email' => '',
    'password' => '',
];


$error = [];

if($_SERVER['REQUEST_METHOD']  === 'POST' && isset($_POST['login']))  {
    //フォームから値を受け取り、空文字か確認
    $form['email'] = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    if($form['email'] === '') {
        $error['email']  = 'blank';
    }
    $form['password'] = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_EMAIL);
    if($form['password'] === '') {
        $error['password'] = 'blank';
    }

    if((!empty($form['email']))  && (!empty($form['password']))) {
        
        $db = dbconnect();
        $stmt = $db -> prepare('select id, name, password from members where email= ?');
        if(!$stmt) {
            die($db -> error);
        }
        $stmt -> bind_param('s', $form['email']);
        $success = $stmt -> execute();
        if(!$success) {
            die($db -> error);
        }

        $stmt -> bind_result($user_id, $user_name, $hashed_password);
        $stmt -> fetch();

        
        if(password_verify($form['password'], $hashed_password)){
            session_regenerate_id();
            $_SESSION['user_id'] = $user_id;
            $_SESSION['user_name'] = $user_name;
            // var_dump('success');
            header('Location: ./top/php/index.php');
            exit();
        }else {
            $error['login'] = 'failed';
        }

        
    }



}else if($_SERVER['REQUEST_METHOD']  === 'POST' && isset($_POST['test_login'])){
    $_SESSION['user_id'] = "***";
    $_SESSION['user_name'] = "ゲスト";
    header('Location: ./top/php/index.php');
    exit();
}