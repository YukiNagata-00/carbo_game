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





// var_dump($form);
// var_dump($id);
// var_dump($name);
if($form['image'] === ""){
    // echo "noimage";
    $form['image'] = '../../game_images/no_image_square.jpg';
    // var_dump($form);
}else{
    // echo 'image';
}
//DBへ
$db = dbconnect();


$stmt = $db -> prepare("UPDATE cards SET name=?, carbo=?, image=? WHERE id= '$id'");
$stmt -> bind_param('sds', $form['food_name'], $form['carbo'], $form['image']);
$success = $stmt -> execute();
	if(!$success){
		die($db -> error);
	}

	unset($_SESSION['form']);
	header('Location: my_cardslist.php');

?>