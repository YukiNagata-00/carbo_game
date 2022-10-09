<?php
require('../common.php');
require('../controller/quiz/index.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://fonts.googleapis.com/css2?family=Acme&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=M+PLUS+Rounded+1c" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/quiz_top.css">
    <?php
    include('../parts/_drawer_links.php');
    ?>
</head>
<body class="drawer drawer--left">
    <?php 
        include('../parts/_header.php');
    ?>
    <header role="banner"></header>
    
    <div class="main"></div>
    <script type="text/javascript" src = "../parts/_drawer.js"></script>
</body>
</html>