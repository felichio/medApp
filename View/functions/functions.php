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
            return $row["num"];
        }

        return 0;
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


 ?>
