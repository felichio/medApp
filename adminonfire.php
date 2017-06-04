<?php

    require_once("functions/functions.php");

    session_start();
    checkLock();
    if (isAuthenticated() && (getLoggedUser() instanceof Admin)) {
        if (isset($_GET["doctor_edt"])) {
            $id = $_GET["doctor_edt"];
            $doctor = getDoctorById($id);
            if ($doctor instanceof Doctor) {
                $title = "Edit Doctor";
                $cssName = "admin-doc-edit";
                $jsName = "admin-doc-edit";
                $_SESSION["selectedTab"] = 1;
                render("views/admin/doctor_edit.php", ["title" => $title, "cssName" => $cssName, "jsName" => $jsName, "doctor" => $doctor]);
            } else {
                redirect("admin.php");
            }


        } else if (isset($_GET["doctor_del"])) {
            $id = $_GET["doctor_del"];
            $doctor = getDoctorById($id);

            if ($doctor instanceof Doctor) {
                deleteDoctorById($id);
                $successes = ["Dr " . $doctor->getLastname() . " deleted successfully"];
                $_SESSION["successes"] = $successes;
                $_SESSION["selectedTab"] = 1;
            }

            redirect("admin.php");
        } else if (isset($_GET["drug_edt"])) {
            $code = $_GET["drug_edt"];
            $drug = getDrugByCode($code);


            if ($drug instanceof Drug) {
                $title = "Edit Drug";
                $cssName = "admin-drug-edit";
                $jsName = "admin-drug-edit";
                $_SESSION["selectedTab"] = 4;
                render("views/admin/drug_edit.php", ["title" => $title, "cssName" => $cssName, "jsName" => $jsName, "drug" => $drug]);
            } else {
                redirect("admin.php");
            }
        } else if (isset($_GET["drug_crt"])) {

            $title = "Create Drug";
            $cssName = "admin-drug-edit";
            $jsName = "admin-drug-edit";
            $_SESSION["selectedTab"] = 4;
            render("views/admin/drug_create.php", ["title" => $title, "cssName" => $cssName, "jsName" => $jsName]);

        } else if (isset($_GET["drug_del"])) {
            $code = $_GET["drug_del"];
            $drug = getDrugByCode($code);

            if ($drug instanceof Drug) {
                deleteDrugByCode($code);
                $successes = ["Drug " . $drug->getName() . " deleted successfully"];
                $_SESSION["successes"] = $successes;
                $_SESSION["selectedTab"] = 4;
            }

            redirect("admin.php");
        } else if (isset($_POST["doctor-in"]) || isset($_POST["patient-in"]) || isset($_POST["drug-code"]) || isset($_POST["date-in"])) {
            $doctorAmka = $_POST["doctor-in"];
            $patientAmka = $_POST["patient-in"];
            $drugCode = $_POST["drug-code"];
            $date = $_POST["date-in"];
            $strict = $_POST["strict"];

            $prescriptions = getPrescriptionsByParameters($doctorAmka, $patientAmka, $drugCode, $date, $strict);
            $_SESSION["selectedTab"] = 5;
            if (count($prescriptions) > 0 ) {
                $title = "Show Prescriptions";
                $cssName = "admin-search";
                $jsName = "admin-search";
                render("views/admin/prescriptions_show.php", ["title" => $title, "cssName" => $cssName, "jsName" => $jsName, "prescriptions" => $prescriptions]);
            } else {
                $errors = ["No results found"];
                $_SESSION["errors"] = $errors;
                redirect("admin.php");
            }
        } else {
            redirect("index.php");
        }


    } else {
        redirect("index.php");
    }








 ?>
