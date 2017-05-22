<?php


    require_once("functions/functions.php");


    $title = "MedWorld";
    $cssName = "index";
    $jsName = "index";


    render("views/landing.php", ["title" => $title, "cssName" => $cssName, "jsName" => $jsName]);

?>
