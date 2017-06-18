<?php

    require_once("functions/functions.php");

    session_start();
    checkLock();

    $user = getLoggedUser();

    $password1 = filterInput($_POST["password1"]);
    $password2 = filterInput($_POST["password2"]);
    $errors = [];

    if (strlen($password1) < 5) {
        $errors[] = "Password must be at least 5 characters";
    }
    if ($password1 !== $password2) {
        $errors[] = "Password Mismatch";
    }

    if (count($errors) > 0) {
        $_SESSION["errors"] = $errors;
        if ($user instanceof Admin) {
            redirect("adminonfire.php?change_pass");
        } else {
            redirect("doctoronfire.php?change_pass");
        }
    } else {
        updatePassword($user, $password1);
        $successes = ["Password changed successfully for user: " . $user->getUsername()];
        $_SESSION["successes"] = $successes;
        redirect("index.php");
    }

?>
