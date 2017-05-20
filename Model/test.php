<?php

    require("admin.php");
    require("doctor.php");

    $admin = new Admin(1, "felichio", "felix", "saf", "example@example.com", "asdasf");
    $doc = new Doctor(1, "felichio", "felix", "saf", "example@example.com", "asdasf", "892345784235");
    echo $admin . "<br>\n" . $doc;


 ?>
