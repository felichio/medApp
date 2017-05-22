<?php

    session_start();
    require_once("functions/functions.php");




    if (!isAuthenticated()) {
        $title = "MedWorld";
        $cssName = "index";
        $jsName = "index";
        render("views/landing.php", ["title" => $title, "cssName" => $cssName, "jsName" => $jsName]);
    } else {
        $user = $_SESSION["user"];

        if ($user instanceof Admin) {
            
        } else {

        }
    }



?>
