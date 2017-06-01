<?php

    require_once("functions/functions.php");

    session_start();

    if (isAuthenticated() && (getLoggedUser() instanceof Doctor)) {
        if (isset($_GET["patient_edt"])) {
            $id = $_GET["patient_edt"];
            $patient = getPatientById($id);

            if ($patient instanceof Patient) {
                $title = "Edit Patient";
                $cssName = "doctor-pat-edit";
                $jsName = "doctor-pat-edit";
                $_SESSION["selectedTab"] = 1;
                render("views/doctor/patient_edit.php", ["title" => $title, "cssName" => $cssName, "jsName" => $jsName, "patient" => $patient]);
            } else {
                redirect("View/doctor.php");
            }

        } else if (isset($_GET["patient_del"])) {
            $id = $_GET["patient_del"];
            $patient = getPatientById($id);

            if ($patient instanceof Patient) {
                deletePatientById($id);
                $successes = ["Dr " . $patient->getLastname() . " deleted successfully"];
                $_SESSION["successes"] = $successes;
                $_SESSION["selectedTab"] = 1;
            }

            redirect("View/doctor.php");
        } else if (isset($_GET["patient_crt"])) {

            $title = "Create Patient";
            $cssName = "doctor-pat-edit";
            $jsName = "doctor-pat-edit";
            $_SESSION["selectedTab"] = 1;
            render("views/doctor/patient_create.php", ["title" => $title, "cssName" => $cssName, "jsName" => $jsName]);

        }


    }

?>
