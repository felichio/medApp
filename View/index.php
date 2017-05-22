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
            $title = "Admin";
            $cssName = "admin";
            render("views/admin_page.php", ["title" => $title, "cssName" => $cssName]);
        } else {
            $title = "Doctor";
            $cssName = "doctor";
            render("views/doctor_page.php", ["title" => $title, "cssName" => $cssName]);
        }

    }

?>
