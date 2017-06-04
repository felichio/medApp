<div class="container">
    <div class="jumbotron">
        <h1>Doctor</h1>
        <?php
            $user = getLoggedUser();
         ?>
        <h2>Dr. <?= $user->getLastname(). " " . $user->getFirstname()[0] . "."?></h2>
    </div>

    <ul class="nav nav-pills nav-justified">
        <li role="presentation"><a href="#">Patients</a></li>
        <li role="presentation"><a href="#">Prescriptions</a></li>
        <li role="presentation"><a href="#">Drugs</a></li>
        <li role="presentation"><a href="#">Search Prescriptions</a></li>
        <li role="presentation"><a href="#">Search Drugs</a></li>
    </ul>

    <div class="mypanel">
        <div class="table-responsive">
            <table class="table table-hover patients-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>AMKA</th>
                        <th># of issued Prescr.</th>
                        <th>Date Of Birth</th>
                        <th>Settings</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $patients = getPatientsByDoctor($user);

                        array_walk($patients, function ($patient, $key) use ($user) {
                            echo "<tr>";
                            echo "<th>" . ++$key . "</th>";
                            echo "<td>" . $patient->getFirstname() . "</td>";
                            echo "<td>" . $patient->getLastname() . "</td>";
                            echo "<td>" . $patient->getAmka() . "</td>";
                            echo "<td>" . getNumberOfPrescriptionsByDoctorPatient($user, $patient) . "</td>";
                            echo "<td>" . $patient->getDateOfBirth() . "</td>";
                            echo "<td><a href='doctoronfire.php?patient_edt=" . $patient->getId() . "'><i class='fa fa-cogs'></i></a><a href='doctoronfire.php?patient_del=". $patient->getId() ."'><i class='fa fa-ban'></i></a></td>";
                            echo "</tr>";
                        });
                     ?>
                </tbody>
            </table>
        </div>
        <a href="doctoronfire.php?patient_crt"><button type="button" class="btn btn-info" id="patientinsert">Register a Patient</button></a>
    </div>
    <div class="mypanel">
        <div class="table-responsive">
            <table class="table table-hover prescriptions-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Patient's Name</th>
                        <th>Patient's AMKA</th>
                        <th>Date of Birth</th>
                        <th>Codes of Drugs/Dosage</th>
                        <th>Date Of Issue</th>
                        <th>Settings</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                        $prescriptions = getPrescriptionsByDoctor($user);

                        array_walk($prescriptions, function ($prescription, $key) {
                            echo "<tr>";
                            echo "<th>" . ++$key ."</th>";
                            echo "<td>" . $prescription["lastname"] . " " . $prescription["firstname"] . "." ."</td>";
                            echo "<td>" . $prescription["amka"] ."</td>";
                            echo "<td>" . $prescription["dateOfBirth"] ."</td>";
                            echo "<td>";
                                $drugs = getDrugsAndDosageByPrescriptionId($prescription["id"]);
                                array_walk($drugs, function ($drug, $key) {
                                    $dosage = $drug["dosage"] === "" ? $drug["drug"]->getDosage() : $drug["dosage"];
                                    echo $drug["drug"]->getName() . " (". $drug["drug"]->getCode() . ", ". $dosage .")<br>";
                                });
                            echo "</td>";
                            echo "<td>" . $prescription["dateOfIssue"] ."</td>";
                            echo "<td class='centercolumn'><a href='doctoronfire.php?prescription_del=". $prescription["id"] ."'><i class='fa fa-ban'></i></a></td>";
                            echo "</tr>";
                        });

                     ?>
                </tbody>
            </table>
        </div>
        <a href="doctoronfire.php?prescription_crt"><button type="button" class="btn btn-info" id="prescriptioninsert">Register a Prescription</button></a>
    </div>
    <div class="mypanel">
        <div class="table-responsive">
            <table class="table table-hover drugs-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Code</th>
                        <th>Name</th>
                        <th>Suggested Dosage</th>
                        <th>Price</th>
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
                            echo "<td>" . $drug->getPrice() ."$</td>";
                            echo "</tr>";
                        });
                     ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="mypanel">
        <div>
            <form class="form-horizontal search-form" action="doctoronfire.php" method="POST">
                  <div class="form-group">
                    <label for="patient-in" class="col-sm-2 col-sm-offset-2 control-label">Patient's AMKA</label>
                    <div class="col-sm-5">
                      <input type="text" class="form-control" id="patient-in" placeholder="AMKA" name="patient-in" list="amkas">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="drug-code" class="col-sm-2 col-sm-offset-2 control-label">Drug Code</label>
                    <div class="col-sm-5">
                      <input type="text" class="form-control" id="predrug-code" placeholder="Code" name="predrug-code" list="drugs">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="date-in" class="col-sm-2 col-sm-offset-2 control-label">Date Of Issue</label>
                    <div class="col-sm-5">
                      <input type="date" class="form-control" id="date-in" placeholder="Date" name="date-in">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-4 col-sm-4">
                      <button type="submit" class="btn btn-info" id="presearchbutton">Search</button>
                    </div>
                    <div class="col-sm-4 checkbox">
                        <label>
                          <input type="checkbox" name="strict" id="prestrictbox"> Strict
                        </label>
                    </div>
                  </div>
              </form>
          </div>
      </div>
      <div class="mypanel">
          <div>
              <form class="form-horizontal search-form" action="doctoronfire.php" method="POST">
                    <div class="form-group">
                      <label for="patient-in" class="col-sm-2 col-sm-offset-2 control-label">Drug Name</label>
                      <div class="col-sm-5">
                        <input type="text" class="form-control" id="drug-name" placeholder="Name" name="drug-in" list="drugs-names">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="drug-code" class="col-sm-2 col-sm-offset-2 control-label">Drug Code</label>
                      <div class="col-sm-5">
                        <input type="text" class="form-control" id="drug-code" placeholder="Code" name="drug-code" list="drugs">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="date-in" class="col-sm-2 col-sm-offset-2 control-label">Price</label>
                      <div class="col-sm-5">
                        <input type="text" class="form-control" id="price-in" placeholder="Price" name="price-in">
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-sm-offset-4 col-sm-4">
                        <button type="submit" class="btn btn-info" id="drugsearchbutton">Search</button>
                      </div>
                      <div class="col-sm-4 checkbox">
                          <label>
                            <input type="checkbox" name="strict" id="drugstrictbox"> Strict
                          </label>
                      </div>
                    </div>
                </form>
            </div>
        </div>




      <div class="success">

          <?php
              if (isset($_SESSION["successes"])) {
                  $successes = $_SESSION["successes"];

                  array_walk($successes, function ($key, $val) {
          ?>
                      <div class="alert alert-success text-center" role="alert"><?= $key ?></div>
          <?php
                  });

                  unset($_SESSION["successes"]);
          }
          ?>
      </div>
      <div class="error">

          <?php
              if (isset($_SESSION["errors"])) {
                  $errors = $_SESSION["errors"];

                  array_walk($errors, function ($key, $val) {
          ?>
                      <div class="alert alert-warning text-center" role="alert"><?= $key ?></div>
          <?php
                  });

                  unset($_SESSION["errors"]);
          }
          ?>
      </div>
      <datalist id="amkas">
          <?php

                $amkas = getPatientAmkasByDoctor($user);

                array_walk($amkas, function ($amka, $key) {
                    echo "<option value=" . "'" . $amka . "'>";
                });
           ?>
      </datalist>
      <datalist id="drugs">
          <?php
                array_walk($drugs, function ($drug, $key) {
                    echo "<option value=" . "'" . $drug->getCode() . "'>";
                });
           ?>
      </datalist>
      <datalist id="drugs-names">
          <?php
                array_walk($drugs, function ($drug, $key) {
                    echo "<option value=" . "'" . $drug->getName() . "'>";
                });
           ?>
      </datalist>



      <span id="selectedTab"><?= isset($_SESSION["selectedTab"]) ? $_SESSION["selectedTab"] : 1 ?></span>

      <?php
            if (isset($_SESSION["selectedTab"])) unset($_SESSION["selectedTab"]);
       ?>


</div>
