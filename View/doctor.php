<?php

    require_once("functions/functions.php");

    session_start();


    $title = "Doctor";
    $cssName = "doctor";
    render("views/doctor_landing.php", ["title" => $title, "cssName" => $cssName]);



 ?>
