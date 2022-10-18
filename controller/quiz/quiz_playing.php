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


// var_dump($choices);
// if(isset($_POST['next_form'])){
//     echo "ddd";
//     $index ++;
//     header('Location: quiz_playing.php');
//     exit();
// }
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

    // $game->toNext();
    // $_SESSION['foods'] = $foods;
    // $_SESSION['result'] = $result;
    
    // $_SESSION['point'] = $point;
}
var_dump($foods[$index]['carbo']);
// var_dump($_POST['selected_choice']);
if(isset($_POST['selected_choice'])){
    echo $_POST['selected_choice'];
    if($foods[$index]['carbo'] ==  $_POST['selected_choice']){
        echo "reight";
        $point += 20;
        $result[]= "ok";
        $_SESSION['result'] = $result;
        $_SESSION['point'] = $point;
var_dump($point);
    }else{
        echo "wrong";
        $result[]= "ng";

        $_SESSION['result'] = $result;
        $_SESSION['point'] = $point;
    }
}
?>

<script>

// const buttonOpen = document.$_POSTElementById('modalOpen');
// const modal = document.getElementById('easyModal');
// const buttonClose = document.getElementsByClassName('modalClose')[0];

// // ボタンがクリックされた時
// buttonOpen.addEventListener('click', modalOpen);
// function modalOpen() {
//   modal.style.display = 'block';
// }

// // バツ印がクリックされた時
// buttonClose.addEventListener('click', modalClose);
// function modalClose() {
//   modal.style.display = 'none';
// }

// // モーダルコンテンツ以外がクリックされた時
// addEventListener('click', outsideClose);
// function outsideClose(e) {
//   if (e.target == modal) {
//     modal.style.display = 'none';
//   }
// }
</script>

