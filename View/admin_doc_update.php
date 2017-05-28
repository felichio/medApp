<?php

    require_once("functions/functions.php");

    session_start();

    if (isAuthenticated() && (getLoggedUser() instanceof Admin)) {
        $username = filterInput($_POST["username"]);
        $firstname = filterInput($_POST["firstname"]);
        $lastname = filterInput($_POST["lastname"]);
        $amka = filterInput($_POST["amka"]);
        $email = filterInput($_POST["email"]);
        // $password1 = filterInput($_POST["password1"]);
        // $password2 = filterInput($_POST["password2"]);

        $errors = [];

        if (!checkUsername($username)) {
            $errors[] = "Username already in use";
        }

        if (!checkEmail($email)) {
            $errors[] = "Email already in use";
        }

        if (!checkAmka($amka)) {
            $errors[] = "Invalid AMKA";
        }

        if (count($errors) > 0) {
            $_SESSION["errors"] = $errors;
            redirect("View/adminonfire.php?doctor_edt=" . $doctor->getId());
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
            // if (strlen($password1) < 5) {
            //     $errors[] = "Password must be at least 5 characters";
            // }
            // if ($password1 !== $password2) {
            //     $errors[] = "Password Mismatch";
            // }

            if (count($errors) > 0) {
                $_SESSION["errors"] = $errors;
                redirect("View/adminonfire.php?doctor_edt=" . $doctor->getId());
            } else {
                $doctor = new Doctor($doctor->getId(), $username, $firstname, $lastname, $email, "", $amka);
                updateDoctorById($doctor->getId());
                redirect("View/admin.php");
            }
        }

    } else {
        redirect("View/index.php");
    }

 ?>
