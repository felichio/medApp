<?php

    require_once("functions/functions.php");

    session_start();
    $id = filterInput($_POST["id"]);
    $username = filterInput($_POST["username"]);
    $firstname = filterInput($_POST["firstname"]);
    $lastname = filterInput($_POST["lastname"]);
    $amka = filterInput($_POST["amka"]);
    $email = filterInput($_POST["email"]);
    $password1 = filterInput($_POST["password1"]);
    $password2 = filterInput($_POST["password2"]);

    $errors = [];


    $doctor = getDoctorById($id);
    $doctorNew = new Doctor($id, $username, $firstname, $lastname, $email, "", $amka);

    $attributes = $doctor->compare($doctorNew);

    if (array_key_exists("username", $attributes)) {
        if (!checkUsername($username)) {
            $errors[] = "Username already in use";
        }
    }

    if (array_key_exists("email", $attributes)) {
        if (!checkEmail($email)) {
            $errors[] = "Email already in use";
        }
    }

    if (array_key_exists("amka", $attributes)) {
        if (!checkAmka($amka)) {
            $errors[] = "Invalid AMKA";
        }
    }

    if (count($errors) > 0) {
        $_SESSION["errors"] = $errors;
        redirect("View/adminonfire.php?doctor_edt=$id");
    } else {
        if (strlen($username) < 5) {
            $errors[] = "Username must be at least 5 characters";
        }
        if (strlen($firstname) < 2) {
            $errors[] = "Firstname must be at least 2 characters";
        }
        if (strlen($lastname) < 2) {
            $errors[] = "Lastname must be at least 2 characters";
        }
        if (!preg_match("/^\d{11}$/", $amka)) {
            $errors[] = "AMKA must be 11 digits";
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Invalid email";
        }

        if (count($errors) > 0) {
            $_SESSION["errors"] = $errors;
            redirect("View/adminonfire.php?doctor_edt=$id");
        } else {
            updateDoctor($doctorNew, $attributes);
            $successes = ["Dr " . $doctor->getLastname() . " updated successfully"];
            $_SESSION["successes"] = $successes;
            redirect("View/admin.php");
        }

    }


?>
