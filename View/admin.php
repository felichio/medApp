<?php

    require_once("functions/functions.php");

    session_start();


    $title = "Admin";
    $cssName = "admin";
    render("views/admin_landing.php", ["title" => $title, "cssName" => $cssName]);



 ?>
