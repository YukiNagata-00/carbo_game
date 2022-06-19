<?php
session_start();
require('../../../common.php');


if(isset( $_SESSION['form'])){
    $form = $_SESSION['form'] ;
    $id = $_SESSION['id'] ;
    $name = $_SESSION['name'];
}else{
    header('Location: newCard.php');
    exit();
}





var_dump($id);

if($form['image'] === ""){
    // echo "noimage";
    $form['image'] = '../../game_images/no_image_square.jpg';
    // var_dump($form);
}else{
    // echo 'image';
}
//DBへ
$db = dbconnect();

$stmt = $db -> prepare('INSERT INTO cards (name, carbo, image, member_id) VALUES (?, ?, ?, ?)');
$stmt -> bind_param('sdss', $form['food_name'], $form['carbo'], $form['image'], $id);
$success = $stmt -> execute();
	if(!$success){
		die($db -> error);
	}

	unset($_SESSION['form']);
	header('Location: my_cardslist.php');


?>

