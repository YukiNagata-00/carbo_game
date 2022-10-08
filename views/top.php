<?php
session_start();

require('../common.php');
require('../controller/top/top.php');


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- <link rel="stylesheet" href="../common.css"> -->
    <link rel="stylesheet" href="../assets/css/top.css">
    <?php
    include('../parts/_drawer_links.php');
    ?>
    <title>Document</title>
</head>
<body class="drawer drawer--left">
    <?php
    include('../parts/_header.php');
    ?>
    <header role="banner"></header>

    <div class="main">

    </div>
    <script type="text/javascript" src = "../parts/_drawer.js"></script>
</body>
</html>