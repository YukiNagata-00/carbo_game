<?php
//テストです
//DB接続
function dbconnect() {
    $db = new mysqli('localhost', 'root', 'root', 'carb_db');
    if(!$db) {
        die($db -> error);
    }

    return $db;
}
?>
