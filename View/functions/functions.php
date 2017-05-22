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



    function render($url, $data) {

        extract($data);

        include(dirname(__DIR__) . "/partials/header.php");
        include($url);
        include(dirname(__DIR__) . "/partials/footer.php");

    }


 ?>
