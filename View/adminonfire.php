<?php

    require_once("functions/functions.php");

    session_start();

    if (isAuthenticated() && (getLoggedUser() instanceof Admin)) {
        if (isset($_GET["doctor_edt"])) {
            $id = $_GET["doctor_edt"];
            $doctor = getDoctorById($id);
            if ($doctor instanceof Doctor) {
                $title = "Edit";
                $cssName = "admin-doc-edit";
                $jsName = "admin-doc-edit";

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
            }

            redirect("View/admin.php");
        } else if (isset($_GET["drug_edt"])) {
            $code = $_GET["drug_edt"];
            $drug = getDrugByCode($code);
            echo $drug;
        }


    } else {
        redirect("View/index.php");
    }








 ?>
