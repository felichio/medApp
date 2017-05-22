<?php


    session_start();

    require_once("functions/functions.php");

    $username = $_POST["username"];
    $password = $_POST["password"];


    $admin = getUserFromDb($username, $password, "Admin");
    $doctor = getUserFromDb($username, $password, "Doctor");

    if (empty($admin) && empty($doctor)) {
        $errors = ["Username or Password incorrect. Try again!"];
        $_SESSION["errors"] = $errors;
    } else if (!empty($admin)) {
        $_SESSION["user"] = $admin;
    } else if (!empty($doctor)) {
        $_SESSION["user"] = $doctor;
    }

    header("Location: " . "http://" . $_SERVER["HTTP_HOST"] . "/medWorld/View/index.php");

 ?>
