<?php

    require_once("functions/functions.php");

    session_start();
    checkLock();
    $user = $_SESSION["user"];
    $firstname = filterInput($_POST["firstname"]);
    $lastname = filterInput($_POST["lastname"]);
    $amka = filterInput($_POST["amka"]);
    $date = filterInput($_POST["date"]);


    $errors = [];


    $patient = new Patient("", $firstname, $lastname, $amka, $date);




    if (!checkPatientsAmkaByDoctor($user, $amka)) {
        $errors[] = "AMKA is already registered";
    }


    if (count($errors) > 0) {
        $_SESSION["errors"] = $errors;
        redirect("doctoronfire.php?patient_crt");
    } else {
        if (strlen($firstname) < 2) {
            $errors[] = "Firstname must be at least 2 characters";
        }
        if (strlen($lastname) < 2) {
            $errors[] = "Lastname must be at least 2 characters";
        }
        if (!preg_match("/^\d{11}$/", $amka)) {
            $errors[] = "AMKA must be 11 digits";
        }

        if (count($errors) > 0) {
            $_SESSION["errors"] = $errors;
            redirect("doctoronfire.php?patient_crt");
        } else {
            insertPatientAssocWithDoctor($user, $patient);

            $successes = ["Patient " . $patient->getLastname() . " inserted successfully"];
            $_SESSION["successes"] = $successes;
            redirect("doctor.php");
        }

    }



?>
