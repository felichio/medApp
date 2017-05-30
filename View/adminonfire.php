<?php

    require_once("functions/functions.php");

    session_start();

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
                redirect("View/admin.php");
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

            redirect("View/admin.php");
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
                redirect("View/admin.php");
            }
        } else if (isset($_GET["drug_del"])) {
            $code = $_GET["drug_del"];
            $drug = getDrugByCode($code);

            if ($drug instanceof Drug) {
                deleteDrugByCode($code);
                $successes = ["Drug " . $drug->getName() . " deleted successfully"];
                $_SESSION["successes"] = $successes;
                $_SESSION["selectedTab"] = 4;
            }

            redirect("View/admin.php");
        }


    } else {
        redirect("View/index.php");
    }








 ?>
