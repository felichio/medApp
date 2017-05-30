<?php

    require_once("functions/functions.php");

    session_start();

    $code = filterInput($_POST["code"]);
    $name = filterInput($_POST["name"]);
    $dosage = filterInput($_POST["dosage"]);
    $price = filterInput($_POST["price"]);

    $errors = [];

    $drug = new Drug($code, $name, $dosage, $price);

    if (!checkCode($code)) {
        $errors[] = "Invalid Code";
    }
    if (!checkName($name)) {
        $errors[] = "Invalid Name";
    }

    if (count($errors) > 0) {
        $_SESSION["errors"] = $errors;
        redirect("View/adminonfire.php?drug_crt");
    } else {
        if (strlen($name) < 2) {
            $errors[] = "Username must be at least 2 characters";
        }
        if (!preg_match("/^\d{10}$/", $code)) {
            $errors[] = "Code must be 10 digits";
        }
        if (!preg_match("/^\d{1,6}([,.]\d{1,3})?$/", $price)) {
            $errors[] = "Incorrect Price Format";
        }

        if (count($errors) > 0) {
            $_SESSION["errors"] = $errors;
            redirect("View/adminonfire.php?drug_crt");
        } else {
            insertDrug($drug);
            $successes = ["Drug " . $drug->getName() . " registered successfully"];
            $_SESSION["successes"] = $successes;
            redirect("View/admin.php");
        }
    }


?>
