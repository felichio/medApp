<?php

    require_once("functions/functions.php");

    session_start();

    if (isAuthenticated() && getLoggedUser() instanceof Admin) {
        $title = "Admin";
        $cssName = "admin";
        render("views/admin_landing.php", ["title" => $title, "cssName" => $cssName]);
    } else {
        redirect("View/index.php");
    }



 ?>
