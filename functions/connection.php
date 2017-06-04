<?php

    $server = "localhost";
    $username = "medWorld";
    $password = "medWorld";
    $database = "medDb";

    $mysqli = new mysqli($server, $username, $password, $database);

    if ($mysqli->connect_errno) {
        echo "Failed to connect to database";
        exit(1);
    }

 ?>
