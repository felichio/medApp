<?php

    require_once(dirname(__DIR__) . "/../Model/admin.php");
    require_once(dirname(__DIR__) . "/../Model/doctor.php");
    require_once(dirname(__DIR__) . "/../Model/drug.php");
    require_once(dirname(__DIR__) . "/../Model/patient.php");
    require_once(dirname(__DIR__) . "/functions/connection.php");



    function getUserFromDb($username, $password, $table) {

        global $mysqli;

        $query = "select * from $table where username = ? and password = SHA1(?)";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("ss", $username, $password);

        $stmt->execute();

        $res = $stmt->get_result();

        if ($row = $res->fetch_assoc()) {
            return $table == "Admin" ? new Admin($row["id"], $row["username"], $row["firstname"], $row["lastname"], $row["email"], $row["password"]) :
                                      new Doctor($row["id"], $row["username"], $row["firstname"], $row["lastname"], $row["email"], $row["password"], $row["amka"]);
        }

    }

    function getNumberOf($table) {
        global $mysqli;

        $query = "select count(*) as num from $table";
        $stmt = $mysqli->prepare($query);
        $stmt->execute();
        $res = $stmt->get_result();

        if ($row = $res->fetch_assoc()) {
            return (int) $row["num"];
        }

        return 0;
    }

    function checkUsername($username) {
        global $mysqli;

        $f = function ($table) use ($mysqli, $username){
            $query = "select count(*) as num from $table where username = ?";
            $stmt = $mysqli->prepare($query);
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $res = $stmt->get_result();

            if ($row = $res->fetch_assoc()) {
                return (int) $row["num"];
            }
            return 0;
        };


        return ($f("Admin") + $f("Doctor")) > 0 ? false : true;

    }

    function checkAmka($amka) {
        global $mysqli;

        $f = function ($table) use ($mysqli, $amka){
            $query = "select count(*) as num from $table where amka = ?";
            $stmt = $mysqli->prepare($query);
            $stmt->bind_param("s", $amka);
            $stmt->execute();
            $res = $stmt->get_result();

            if ($row = $res->fetch_assoc()) {
                return (int) $row["num"];
            }
            return 0;
        };

        return ($f("Doctor") + $f("Patient")) > 0 ? false : true;
    }

    function checkEmail($email) {
        global $mysqli;

        $f = function ($table) use ($mysqli, $email){
            $query = "select count(*) as num from $table where email = ?";
            $stmt = $mysqli->prepare($query);
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $res = $stmt->get_result();

            if ($row = $res->fetch_assoc()) {
                return (int) $row["num"];
            }
            return 0;
        };

        return ($f("Admin") + $f("Doctor")) > 0 ? false : true;
    }


    function isAuthenticated() {
        if (isset($_SESSION["user"])) return true;
        return false;
    }

    function getLoggedUser() {
        return $_SESSION["user"];
    }

    function redirect($url) {
        header("Location: " . "http://" . $_SERVER["HTTP_HOST"] . "/medWorld/" . $url);
    }

    function render($url, $data) {

        extract($data);

        include(dirname(__DIR__) . "/partials/header.php");
        include($url);
        include(dirname(__DIR__) . "/partials/footer.php");

    }


    function filterInput($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }


 ?>
