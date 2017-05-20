<?php

    require("admin.php");
    require("doctor.php");
    require("patient.php");
    require("Drug.php");

    $admin = new Admin(1, "felichio", "felix", "saf", "example@example.com", "asdasf");
    $doc = new Doctor(1, "felichio", "felix", "saf", "example@example.com", "asdasf", "892345784235");
    $pat = new Patient(2, "atom", "patata", "1231141", "22-3-2011");
    $drug = new Drug("12313", "Depon", "11-12-2013");


    echo $admin . "<br>\n" . $doc . "<br>\n" . $pat . "<br>\n" . $drug;


 ?>
