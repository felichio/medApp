<?php

    require_once("functions/functions.php");

    session_start();
    checkLock();
    $id = filterInput($_POST["id"]);
    $code = filterInput($_POST["code"]);
    $name = filterInput($_POST["name"]);
    $dosage = filterInput($_POST["dosage"]);
    $price = filterInput($_POST["price"]);

    $errors = [];

    $drug = getDrugByCode($id);
    $drugNew = new Drug($code, $name, $dosage, $price);

    $attributes = $drug->compare($drugNew);

    if (array_key_exists("code", $attributes)) {
        if (!checkCode($code)) {
            $errors[] = "Invalid Code";
        }
    }

    if (array_key_exists("name", $attributes)) {
        if (!checkName($name)) {
            $errors[] = "Invalid Name";
        }
    }


    if (count($errors) > 0) {
        $_SESSION["errors"] = $errors;
        redirect("adminonfire.php?drug_edt=$id");
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
            redirect("adminonfire.php?drug_edt=$id");
        } else {
            updateDrug($drugNew, $attributes, $id);
            $successes = ["Drug " . $drug->getName() . " updated successfully"];
            $_SESSION["successes"] = $successes;
            redirect("admin.php");
        }
    }



 ?>
