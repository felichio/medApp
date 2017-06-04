<?php

    require_once("functions/functions.php");

    session_start();
    checkLock();
    $user = $_SESSION["user"];
    $amka = filterInput($_POST["amka"]);
    $drugCodes = $_POST["drugcheck"];
    $errors = [];


    if (checkPatientsAmkaByDoctor($user, $amka)) {
        $errors[] = "AMKA does not have patient association";
    }
    if ($drugCodes === NULL) {
        $errors[] = "Select at least one Drug";
    }

    if (count($errors) > 0) {
        $_SESSION["errors"] = $errors;
        redirect("doctoronfire.php?prescription_crt");
    } else {

        $id = getIdOfClienteleAssociatedWithDoctorAmka($user, $amka);

        insertPrescriptionAssociatedWithClienteleId($id);

        array_walk($drugCodes, function ($code, $key) {
            $dosage = filterInput($_POST[$code]);
            insertDrugsAssociationsIntoTherapy($code, $dosage);
        });

        redirect("doctor.php");

    }
 ?>
