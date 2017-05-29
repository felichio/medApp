<?php

    require_once("functions/functions.php");

    session_start();

    if (isAuthenticated() && getLoggedUser() instanceof Doctor) {
        $title = "Doctor";
        $cssName = "doctor";
        render("views/doctor/doctor_landing.php", ["title" => $title, "cssName" => $cssName]);
    } else {
        redirect("View/index.php");
    }


 ?>
