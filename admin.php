<?php

    require_once("functions/functions.php");

    session_start();
	checkLock();
    if (isAuthenticated() && (getLoggedUser() instanceof Admin)) {
        $title = "Admin";
        $cssName = "admin";
        $jsName = "admin";
        render("views/admin/admin_landing.php", ["title" => $title, "cssName" => $cssName, "jsName" => $jsName]);
    } else {
        redirect("index.php");
    }



 ?>
