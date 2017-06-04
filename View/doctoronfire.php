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

        } else if (isset($_GET["prescription_crt"])) {

            $title = "Create Prescription";
            $cssName = "doctor-pre-insert";
            $jsName = "doctor-pre-insert";
            $_SESSION["selectedTab"] = 2;
            render("views/doctor/prescription_create.php", ["title" => $title, "cssName" => $cssName, "jsName" => $jsName]);

        } else if (isset($_GET["prescription_del"])) {

            $id = $_GET["prescription_del"];
            deletePrescriptionById($id);
            $_SESSION["selectedTab"] = 2;
            $successes = ["Prescription deleted successfully"];
            $_SESSION["successes"] = $successes;
            redirect("View/doctor.php");
        } else if (isset($_POST["patient-in"]) || isset($_POST["predrug-code"]) || isset($_POST["date-in"])) {
            $patientAmka = $_POST["patient-in"];
            $drugCode = $_POST["predrug-code"];
            $date = $_POST["date-in"];
            $strict = $_POST["strict"];
            $user = $_SESSION["user"];
            $prescriptions = getPrescriptionsAssociatedWithDoctor($user, $patientAmka, $drugCode, $date, $strict);
            $_SESSION["selectedTab"] = 4;

            if (count($prescriptions) > 0 ) {
                $title = "Show Prescriptions";
                $cssName = "doctor-presearch";
                $jsName = "doctor-presearch";
                render("views/doctor/prescriptions_show.php", ["title" => $title, "cssName" => $cssName, "jsName" => $jsName, "prescriptions" => $prescriptions]);
                
            } else {
                $errors = ["No results found"];
                $_SESSION["errors"] = $errors;
                redirect("View/doctor.php");
            }
        }

    }

?>
