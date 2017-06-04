<?php

    require_once("functions/functions.php");

    session_start();

    if (isAuthenticated() && getLoggedUser() instanceof Doctor) {
        $title = "Doctor";
        $cssName = "doctor";
        $jsName = "doctor";
        render("views/doctor/doctor_landing.php", ["title" => $title, "cssName" => $cssName, "jsName" => $jsName]);
    } else {
        redirect("index.php");
    }


 ?>
