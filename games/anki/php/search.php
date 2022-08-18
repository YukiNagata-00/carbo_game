<?php

$error = "";

if(isset($_POST["form_txt"]) && isset($_POST['form_btn']) ){

    $input = htmlspecialchars($_POST["form_txt"], ENT_QUOTES);

    if($input == ""){
        $error = "blank";
    }

    if($error != "blank"){
        $db = dbconnect();
        $param = "%{$input}%";
        $stmt = $db-> prepare( "SELECT id, name, carbo, image  FROM foods  WHERE name LIKE ? ORDER BY id DESC LIMIT  5" );
        if(!$stmt) {
            die($db -> error);
        }
        $stmt -> bind_param('s', $param);
        $success = $stmt -> execute();
            if(!$success){
                die($db -> error);
            }

        // $stmt -> bind_result($selected_id, $selected_name, $selected_carbo, $selected_image);
        $stmt-> bind_result($id, $name, $carbo, $image);
        //$stmt -> fetch();
        
    }else{
        echo "no2";
    }
    //echo $input;
}


?>


結果：<?php while($stmt -> fetch()):?>
                    <a href = "oneCard.php?id=<?= $id?>" class="card">
                        <p><?php echo $name;?></p>
                        <br>
                    </a>
                    
                <?php endwhile; ?>
