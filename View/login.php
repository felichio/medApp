<?php


    require_once("functions/connection.php");
    require_once("functions/functions.php");

    $username = $_POST["username"];
    $password = $_POST["password"];


    getUserFromDb($mysqli, $username, $password, "Admin");


 ?>
