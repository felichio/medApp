<?php



    require_once("functions/functions.php");

    $username = $_POST["username"];
    $password = $_POST["password"];


    $admin = getUserFromDb($username, $password, "Admin");
    $doctor = getUserFromDb($username, $password, "Doctor");

    if (empty($admin) && empty($doctor)) {
        echo "Empty";
    } else if (!empty($admin)) {
        echo "Admin " . $admin . " detected";
    } else if (!empty($doctor)) {
        echo "Doctor " . $doctor . " detected";
    }

 ?>
