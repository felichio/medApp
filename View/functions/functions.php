<?php

    function getUserFromDb($mysqli, $username, $password, $table) {
        $query = "select * from $table where username = ? and password = SHA1(?)";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("ss", $username, $password);

        $stmt->execute();

        $res = $stmt->get_result();

        
    }



    function render($url, $data) {

        extract($data);

        include($url);

    }


 ?>
