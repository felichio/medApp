<?php

    require_once("functions/functions.php");

    session_start();



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

    redirect("View/index.php");

 ?>
