<?php

    require_once(dirname(__DIR__) . "/Model/admin.php");
    require_once(dirname(__DIR__) . "/Model/doctor.php");
    require_once(dirname(__DIR__) . "/Model/drug.php");
    require_once(dirname(__DIR__) . "/Model/patient.php");
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

    function registerDoctor($doctor) {
        global $mysqli;

        $query = "insert into Doctor (id, username, firstname, lastname, email, amka, password) values (NULL, ?, ?, ?, ?, ?, SHA1(?))";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("ssssss", $doctor->getUsername(), $doctor->getFirstname(), $doctor->getLastname(), $doctor->getEmail(), $doctor->getAmka(), $doctor->getPassword());

        $stmt->execute();
        return $stmt->affected_rows;
    }

    function updatePassword($user, $password) {
        global $mysqli;
        $table = ($user instanceof Admin) ? "Admin" : "Doctor";
        $query = "update $table set password = SHA1(?) where id = ?";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("si", $password, $user->getId());
        $stmt->execute();
        return $stmt->affected_rows;
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

    function checkPatientsAmkaByDoctor($doctor, $amka) {
        global $mysqli;
        $query = "select count(*) as num from Patient p, Clientele c where c.patientId = p.id and c.doctorId =  ? and p.amka = ?";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("is", $doctor->getId(), $amka);
        $stmt->execute();
        $res = $stmt->get_result();

        $num = 0;
        if ($row = $res->fetch_assoc()) {
            $num = (int) $row["num"];
        }

        return $num > 0 ? false : true;
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

    function getDoctors() {
        $doctors = [];

        global $mysqli;
        $query = "select * from Doctor";
        $stmt = $mysqli->prepare($query);
        $stmt->execute();
        $res = $stmt->get_result();

        while ($row = $res->fetch_assoc()) {
            $doctors[] = new Doctor($row["id"], $row["username"], $row["firstname"], $row["lastname"], $row["email"], $row["password"], $row["amka"]);
        }

        return $doctors;
    }

    function getPatients() {
        $patients = [];
        global $mysqli;

        $query = "select * from Patient";
        $stmt = $mysqli->prepare($query);
        $stmt->execute();
        $res = $stmt->get_result();
        while ($row = $res->fetch_assoc()) {
            $patients[] = new Patient($row["id"], $row["firstname"], $row["lastname"], $row["amka"], $row["dateOfBirth"]);
        }

        return $patients;
    }

    function getDrugs() {
        $drugs = [];
        global $mysqli;

        $query = "select * from Drug";
        $stmt = $mysqli->prepare($query);
        $stmt->execute();
        $res = $stmt->get_result();
        while ($row = $res->fetch_assoc()) {
            $drugs[] = new Drug($row["code"], $row["name"], $row["dosage"], $row["price"]);
        }

        return $drugs;
    }

    function getPrescriptions() {
        $prescriptions = [];
        global $mysqli;

        $query = "select pr.id as id, d.lastname as dlastname, left(d.firstname, 1) as dfirstname, p.lastname as plastname, left(p.firstname, 1) as pfirstname, pr.dateOfIssue from Doctor d, Patient p, Clientele c, Prescription pr where pr.clienteleId = c.id and c.doctorId = d.id and c.patientId = p.id";
        $stmt = $mysqli->prepare($query);
        $stmt->execute();
        $res = $stmt->get_result();
        while ($row = $res->fetch_assoc()) {
            $prescriptions[] = ["id" => $row["id"],"dname" => $row["dlastname"] . " " . $row["dfirstname"] . ".", "pname" => $row["plastname"] . " " . $row["pfirstname"] . ".", "date" => $row["dateOfIssue"]];
        }

        return $prescriptions;
    }

    function getPrescriptionsByParameters($doctorAmka, $patientAmka, $drugCode, $date, $strict) {
        $prescriptions = [];
        global $mysqli;

        if ($strict) {
            $query = "select pr.id as id, d.lastname as dlastname, left(d.firstname, 1) as dfirstname, p.lastname as plastname, left(p.firstname, 1) as pfirstname, pr.dateOfIssue as date, dr.code as code from Doctor d, Patient p, Clientele c, Prescription pr, Therapy t, Drug dr where pr.clienteleId = c.id and c.doctorId = d.id and c.patientId = p.id and t.prescriptionId = pr.id and t.drugCode = dr.code and (d.amka = ? and p.amka = ? and dr.code = ? and ? = (select date_format(pr.dateOfIssue, '%Y-%m-%d')))";
        } else {
            $query = "select pr.id as id, d.lastname as dlastname, left(d.firstname, 1) as dfirstname, p.lastname as plastname, left(p.firstname, 1) as pfirstname, pr.dateOfIssue as date, dr.code as code from Doctor d, Patient p, Clientele c, Prescription pr, Therapy t, Drug dr where pr.clienteleId = c.id and c.doctorId = d.id and c.patientId = p.id and t.prescriptionId = pr.id and t.drugCode = dr.code and (d.amka = ? or p.amka = ? or dr.code = ? or ? = (select date_format(pr.dateOfIssue, '%Y-%m-%d')))";
        }

        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("ssss", $doctorAmka, $patientAmka, $drugCode, $date);
        $stmt->execute();
        $res = $stmt->get_result();
        while ($row = $res->fetch_assoc()) {
            $prescriptions[] = ["id" => $row["id"],"dname" => $row["dlastname"] . " " . $row["dfirstname"] . ".", "pname" => $row["plastname"] . " " . $row["pfirstname"] . ".", "date" => $row["date"], "code" => $row["code"]];
        }


        return $prescriptions;

    }

    function getPrescriptionsAssociatedWithDoctor($doctor, $patientAmka, $drugCode, $date, $strict) {
        $prescriptions = [];
        global $mysqli;

        if ($strict) {
            $query = "select pr.id as id, p.lastname as plastname, left(p.firstname, 1) as pfirstname, pr.dateOfIssue as date, dr.code as code from Patient p, Clientele c, Prescription pr, Therapy t, Drug dr where pr.clienteleId = c.id and c.doctorId = ? and c.patientId = p.id and t.prescriptionId = pr.id and t.drugCode = dr.code and (p.amka = ? and dr.code = ? and ? = (select date_format(pr.dateOfIssue, '%Y-%m-%d')))";
        } else {
            $query = "select pr.id as id, p.lastname as plastname, left(p.firstname, 1) as pfirstname, pr.dateOfIssue as date, dr.code as code from Patient p, Clientele c, Prescription pr, Therapy t, Drug dr where pr.clienteleId = c.id and c.doctorId = ? and c.patientId = p.id and t.prescriptionId = pr.id and t.drugCode = dr.code and (p.amka = ? or dr.code = ? or ? = (select date_format(pr.dateOfIssue, '%Y-%m-%d')))";
        }

        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("isss", $doctor->getId(), $patientAmka, $drugCode, $date);
        $stmt->execute();
        $res = $stmt->get_result();
        while ($row = $res->fetch_assoc()) {
            $prescriptions[] = ["id" => $row["id"], "pname" => $row["plastname"] . " " . $row["pfirstname"] . ".", "date" => $row["date"], "code" => $row["code"]];
        }


        return $prescriptions;
    }

    function getDrugsByPrescriptionId($id) {
        $drugs = [];
        global $mysqli;

        $query = "select d.code, d.name, d.dosage, d.price from Prescription pr, Therapy t, Drug d where pr.id = t.prescriptionId and t.drugCode = d.code and pr.id = ?";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $res = $stmt->get_result();

        while ($row = $res->fetch_assoc()) {
            $drugs[] = new Drug($row["code"], $row["name"], $row["dosage"], $row["price"]);
        }

        return $drugs;
    }

    function getDoctorById($id) {
        global $mysqli;

        $query = "select * from Doctor where id = ?";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $res = $stmt->get_result();

        if ($row = $res->fetch_assoc()) {
            return new Doctor($row["id"], $row["username"], $row["firstname"], $row["lastname"], $row["email"], $row["password"], $row["amka"]);
        }
    }

    function updateDoctor($doctor, $attributes) {
        global $mysqli;

        $query = "update Doctor set ";
        if (count($attributes) === 0) return false;

        array_walk($attributes, function ($function, $attribute) use ($doctor, &$query){
            $query .= ("" . $attribute . " = '" . $doctor->$function() . "', ");
        });
        $query = preg_replace("/,\s+$/", " ", $query);
        $query .= " where id = " . $doctor->getId();

        if($res = $mysqli->query($query)) {
            return true;
        }
        return false;

    }

    function deleteDoctorById($id) {
        global $mysqli;

        $query = "delete from Doctor where id = ?";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->affected_rows;
    }

    function getDrugByCode($code) {
        global $mysqli;

        $query = "select * from Drug where code = ?";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("s", $code);
        $stmt->execute();
        $res = $stmt->get_result();
        if ($row = $res->fetch_assoc()) {
            return new Drug($row["code"], $row["name"], $row["dosage"], $row["price"]);
        }
    }

    function deleteDrugByCode($code) {
        global $mysqli;

        $query = "delete from Drug where code = ?";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("s", $code);
        $stmt->execute();
        return $stmt->affected_rows;
    }

    function checkCode($code) {
        global $mysqli;
        $query = "select count(*) as num from Drug where code = ?";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("s", $code);
        $stmt->execute();
        $res = $stmt->get_result();

        if ($row = $res->fetch_assoc()) {
            $num = $row["num"];
        }
        return $num > 0 ? false : true;
    }

    function checkName($name) {
        global $mysqli;
        $query = "select count(*) as num from Drug where name = ?";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("s", $name);
        $stmt->execute();
        $res = $stmt->get_result();

        if ($row = $res->fetch_assoc()) {
            $num = $row["num"];
        }
        return $num > 0 ? false : true;
    }

    function updateDrug($drug, $attributes, $id) {
        global $mysqli;

        $query = "update Drug set ";
        if (count($attributes) === 0) return false;

        array_walk($attributes, function ($function, $attribute) use ($drug, &$query, $id){
            $query .= ("" . $attribute . " = '" . $drug->$function() . "', ");
        });
        $query = preg_replace("/,\s+$/", " ", $query);
        $query .= " where code = " . $id;

        if($res = $mysqli->query($query)) {
            return true;
        }
        return false;
    }

    function insertDrug($drug) {
        global $mysqli;

        $query = "insert into Drug (code, name, dosage, price) values (?, ?, ?, ?)";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("ssss", $drug->getCode(), $drug->getName(), $drug->getDosage(), $drug->getPrice());

        $stmt->execute();
        return $stmt->affected_rows;
    }


    function getPatientsByDoctor($doctor) {
        global $mysqli;
        $patients = [];
        $query = "select p.id, p.firstname, p.lastname, p.amka, p.dateOfBirth from Patient p, Clientele c where c.patientId = p.id and c.doctorId = ?";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("i", $doctor->getId());
        $stmt->execute();
        $res = $stmt->get_result();
        while ($row = $res->fetch_assoc()) {
            $patients[] = new Patient($row["id"], $row["firstname"], $row["lastname"], $row["amka"], $row["dateOfBirth"]);
        }

        return $patients;
    }

    function getNumberOfPrescriptionsByDoctorPatient($doctor, $patient) {
        global $mysqli;

        $query = "select count(*) as num from Prescription p, Clientele c where p.clienteleId = c.id and c.doctorId = ? and c.patientId = ?";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("ii", $doctor->getId(), $patient->getId());
        $stmt->execute();
        $res = $stmt->get_result();
        if ($row = $res->fetch_assoc()) {
            return (int) $row["num"];
        }

        return 0;
    }

    function getPrescriptionsByDoctor($doctor) {
        $prescriptions = [];
        global $mysqli;

        $query = "select pr.id as id, p.lastname as lastname, left(p.firstname, 2) as firstname, amka, dateOfBirth, dateOfIssue from Patient p, Clientele c, Prescription pr where c.patientId = p.id and pr.clienteleId = c.id and c.doctorId = ?";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("i", $doctor->getId());
        $stmt->execute();
        $res = $stmt->get_result();
        while ($row = $res->fetch_assoc()) {
            $prescriptions[] = ["id" => $row["id"], "lastname" => $row["lastname"], "firstname" => $row["firstname"], "amka" => $row["amka"], "dateOfBirth" => $row["dateOfBirth"], "dateOfIssue" => $row["dateOfIssue"]];
        }

        return $prescriptions;
    }


    function getDrugsAndDosageByPrescriptionId($id) {
        $drugs = [];
        global $mysqli;

        $query = "select d.code, d.name, d.dosage, d.price, t.dosage as dosage2 from Prescription pr, Therapy t, Drug d where pr.id = t.prescriptionId and t.drugCode = d.code and pr.id = ?";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $res = $stmt->get_result();

        while ($row = $res->fetch_assoc()) {
            $drugs[] = ["drug" => new Drug($row["code"], $row["name"], $row["dosage"], $row["price"]), "dosage" => $row["dosage2"]];
        }

        return $drugs;
    }

    function getPatientById($id) {
        global $mysqli;

        $query = "select * from Patient where id = ?";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $res = $stmt->get_result();

        if ($row = $res->fetch_assoc()) {
            return new Patient($row["id"], $row["firstname"], $row["lastname"], $row["amka"], $row["dateOfBirth"]);
        }
    }

    function deletePatientById($id) {
        global $mysqli;

        $query = "delete from Patient where id = ?";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->affected_rows;
    }

    function updatePatient($patient, $attributes) {
        global $mysqli;

        $query = "update Patient set ";
        if (count($attributes) === 0) return false;

        array_walk($attributes, function ($function, $attribute) use ($patient, &$query){
            $query .= ("" . $attribute . " = '" . $patient->$function() . "', ");
        });
        $query = preg_replace("/,\s+$/", " ", $query);
        $query .= " where id = " . $patient->getId();

        if($res = $mysqli->query($query)) {
            return true;
        }
        return false;

    }

    function insertPatientAssocWithDoctor($user, $patient) {
        global $mysqli;


        $query = "insert into Patient (firstname, lastname, amka, dateOfBirth) values ('" . $patient->getFirstname() . "','" . $patient->getLastname() . "','" . $patient->getAmka() . "','" . $patient->getDateOfBirth() . "')";
        $mysqli->query($query);
        $query = "insert into Clientele (doctorId, patientId) values (" . $user->getId() . ", LAST_INSERT_ID())";
        $mysqli->query($query);
        return true;
    }

    function getPatientAmkasByDoctor($doctor) {
        global $mysqli;
        $amkas = [];

        $query = "select amka from Clientele c, Patient p where c.doctorId = ? and c.patientId = p.id";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("i", $doctor->getId());
        $stmt->execute();
        $res = $stmt->get_result();
        while ($row = $res->fetch_assoc()) {
            $amkas[] = $row["amka"];
        }

        return $amkas;
    }

    function getIdOfClienteleAssociatedWithDoctorAmka($user, $amka) {
        global $mysqli;
        $query = "select c.id from Clientele c, Patient p where c.patientId = p.id and c.doctorId = ? and p.amka = ?";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("is", $user->getId(), $amka);
        $stmt->execute();
        $res = $stmt->get_result();

        if ($row = $res->fetch_assoc()) {
            return (int) $row["id"];
        }
    }

    function insertPrescriptionAssociatedWithClienteleId($id) {
        global $mysqli;
        $query = "insert into Prescription (clienteleId) values (?)";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->affected_rows;
    }

    function insertDrugsAssociationsIntoTherapy($code, $dosage) {
        global $mysqli;
        $query = "insert into Therapy (prescriptionId, drugCode, dosage) values (LAST_INSERT_ID(), \"$code\", \"$dosage\")";
        $mysqli->query($query);
    }

    function deletePrescriptionById($id) {
        global $mysqli;

        $query = "delete from Prescription where id = ?";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->affected_rows;
    }

    function getDrugsAssociatedWithAttributes($code, $name, $price, $strict) {
        $drugs = [];
        global $mysqli;

        if ($strict) {
            $query = "select * from Drug where (code = ? and name = ? and price = ?)";
        } else {
            $query = "select * from Drug where (code = ? or name = ? or price = ?)";
        }

        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("ssd", $code, $name, $price);
        $stmt->execute();
        $res = $stmt->get_result();
        while ($row = $res->fetch_assoc()) {
            $drugs[] = new Drug($row["code"], $row["name"], $row["dosage"], $row["price"]);
        }

        return $drugs;
    }


    function isAuthenticated() {
        if (isset($_SESSION["user"])) return true;
        return false;
    }

    function getLoggedUser() {
        return $_SESSION["user"];
    }

    function redirect($url) {
        header("Location: " . "http://" . $_SERVER["HTTP_HOST"] . "/medApp/" . $url);
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

    function checkLock() {
        if (!isAuthenticated()) return exit("This won't happen");
    }


 ?>
