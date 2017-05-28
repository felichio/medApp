<?php

    require_once("functions/functions.php");

    session_start();

    if (isAuthenticated() && (getLoggedUser() instanceof Admin)) {
        if (isset($_GET["doctor_edt"])) {
            $id = $_GET["doctor_edt"];
            $doctor = getDoctorById($id);

            $title = "Edit";
            $cssName = "admin-doc-edit";
            $jsName = "admin-doc-edit";

            render("views/admin/doctor_edit.php", ["title" => $title, "cssName" => $cssName, "jsName" => $jsName, "doctor" => $doctor]);

        } else if (isset($_GET["doctor_del"])) {
            $id = $_GET["doctor_del"];
            echo "del";
            print_r($id);
        }


    } else {
        redirect("View/index.php");
    }








 ?>
