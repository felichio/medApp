<?php

    require_once("functions/functions.php");

    session_start();

    if (!isAuthenticated()) {
        $title = "MedWorld";
        $cssName = "index";
        $jsName = "index";
        render("views/landing.php", ["title" => $title, "cssName" => $cssName, "jsName" => $jsName]);
    } else {
        $user = $_SESSION["user"];

        if ($user instanceof Admin) {
            redirect("View/admin.php");
        } else {
            redirect("View/doctor.php");
        }

    }

?>
