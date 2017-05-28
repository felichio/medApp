<div class="container">
    <div class="jumbotron">
        <h1>Administrator</h1>
        <?php
            $user = getLoggedUser();
         ?>
        <h2><?= $user->getLastname(). " " . $user->getFirstname()[0] . "."?></h2>
    </div>
    <ul class="nav nav-pills nav-justified">
        <li role="presentation"><a href="#">Doctors</a></li>
        <li role="presentation"><a href="#">Patients</a></li>
        <li role="presentation"><a href="#">Prescriptions</a></li>
        <li role="presentation"><a href="#">Drugs</a></li>
        <li role="presentation"><a href="#">Search</a></li>
    </ul>
    <div class="table-responsive">
        <table class="table table-hover doctors-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>AMKA</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Password</th>
                </tr>
            </thead>

            <tbody>
                <?php
                    $doctors = getDoctors();
                    array_walk($doctors, function ($doctor, $key) {
                        echo "<tr>";
                        echo "<th>" . ++$key ."</th>";
                        echo "<td>" . $doctor->getFirstname() ."</td>";
                        echo "<td>" . $doctor->getLastname() ."</td>";
                        echo "<td>" . $doctor->getAmka() ."</td>";
                        echo "<td>" . $doctor->getUsername() ."</td>";
                        echo "<td>" . $doctor->getEmail() ."</td>";
                        echo "<td>" . $doctor->getPassword() ."</td>";
                        echo "</tr>";
                    });
                ?>

            </tbody>
        </table>
    </div>
    <div class="table-responsive">
        <table class="table table-hover patients-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>AMKA</th>
                    <th>Date Of Birth</th>
                </tr>
            </thead>

            <tbody>
                <?php
                    $patients = getPatients();
                    array_walk($patients, function ($patient, $key) {
                        echo "<tr>";
                        echo "<th>" . ++$key ."</th>";
                        echo "<td>" . $patient->getFirstname() ."</td>";
                        echo "<td>" . $patient->getLastname() ."</td>";
                        echo "<td>" . $patient->getAmka() ."</td>";
                        echo "<td>" . $patient->getDateOfBirth() ."</td>";
                        echo "</tr>";
                    });
                 ?>
            </tbody>
        </table>
    </div>
    <div class="table-responsive">
        <table class="table table-hover prescriptions-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Doctor's Name</th>
                    <th>Patient's Name</th>
                    <th>Codes of Drugs</th>
                    <th>Date Of Issue</th>
                </tr>
            </thead>

            <tbody>
                <?php
                    $prescriptions = getPrescriptions();
                    array_walk($prescriptions, function ($prescription, $key) {
                        echo "<tr>";
                        echo "<th>" . ++$key ."</th>";
                        echo "<td>" . $prescription["dname"] ."</td>";
                        echo "<td>" . $prescription["pname"] ."</td>";
                        echo "<td>";
                            $drugs = getDrugsByPrescriptionId($prescription["id"]);
                            array_walk($drugs, function ($drug, $key) {
                                echo $drug->getName() . " (". $drug->getCode() .")<br>";
                            });
                        echo "</td>";
                        echo "<td>" . $prescription["date"] ."</td>";
                        echo "</tr>";
                    });

                 ?>
            </tbody>
        </table>
    </div>
    <div class="table-responsive">
        <table class="table table-hover drugs-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Code</th>
                    <th>Name</th>
                    <th>Dosage</th>
                </tr>
            </thead>

            <tbody>
                <?php
                    $drugs = getDrugs();
                    array_walk($drugs, function ($drug, $key) {
                        echo "<tr>";
                        echo "<th>" . ++$key ."</th>";
                        echo "<td>" . $drug->getCode() ."</td>";
                        echo "<td>" . $drug->getName() ."</td>";
                        echo "<td>" . $drug->getDosage() ."</td>";
                        echo "</tr>";
                    });
                 ?>
            </tbody>
        </table>
    </div>
    <div>
        <form class="form-horizontal search-form" action="" method="POST">
              <div class="form-group">
                <label for="doctor-in" class="col-sm-2 col-sm-offset-2 control-label">Doctor's AMKA</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" id="doctor-in" placeholder="AMKA" name="doctor-in" list="doctors">
                </div>
              </div>
              <div class="form-group">
                <label for="patient-in" class="col-sm-2 col-sm-offset-2 control-label">Patient's AMKA</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" id="patient-in" placeholder="AMKA" name="patient-in" list="patients">
                </div>
              </div>
              <div class="form-group">
                <label for="drug-code" class="col-sm-2 col-sm-offset-2 control-label">Drug Code</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" id="drug-code" placeholder="Code" name="drug-code">
                </div>
              </div>
              <div class="form-group">
                <label for="date-in" class="col-sm-2 col-sm-offset-2 control-label">Date Of Issue</label>
                <div class="col-sm-5">
                  <input type="date" class="form-control" id="date-in" placeholder="Date" name="date-in">
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-offset-4 col-sm-10">
                  <button type="submit" class="btn btn-default">Search</button>
                </div>
              </div>
          </form>
      </div>
      <datalist id="doctors">
          <?php
                array_walk($doctors, function ($doctor, $key) {
                    echo "<option value=" . "'" . $doctor->getAmka() . "'>";
                });
           ?>
      </datalist>

      <datalist id="patients">
          <?php
                array_walk($patients, function ($patient, $key) {
                    echo "<option value=" . "'" . $patient->getAmka() . "'>";
                });
           ?>
      </datalist>
</div>
