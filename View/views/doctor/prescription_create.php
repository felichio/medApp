<div class="container">
    <div class="jumbotron">
        <h1>Doctor</h1>
        <?php
            $user = getLoggedUser();

         ?>
        <h2><?= $user->getLastname(). " " . $user->getFirstname()[0] . "."?></h2>
    </div>

    <div class="error">

        <?php
            if (isset($_SESSION["errors"])) {
                $errors = $_SESSION["errors"];

                array_walk($errors, function ($key, $val) {
        ?>
                    <div class="alert alert-danger text-center" role="alert"><?= $key ?></div>
        <?php
                });

                unset($_SESSION["errors"]);
        }
        ?>
    </div>

    <fieldset>
        <legend>Register a Prescription</legend>
        <form class="form-horizontal form-input" action="doctor_pre_insert.php" method="POST">

              <div class="form-group">
                <label for="inputAmka" class="col-sm-2 col-sm-offset-2 control-label">Patient's AMKA</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" id="inputAmka" placeholder="AMKA" name="amka" list="amkas">
                </div>
              </div>
              <hr>
              <div class="drugpanel">
                  <?php
                        $drugs = getDrugs();
                        array_walk($drugs, function ($drug, $key) {
                    ?>
                    <div class="form-group">
                        <h3><label for="inputDosage<?= $key ?>" class="col-sm-2 col-sm-offset-2 control-label"><span class="label label-info"><?= $drug->getName() ?></span></label></h3>
                        <div class="col-sm-1">
                          <input type="checkbox" class="form-control" value="<?= $drug->getCode() ?>" name="drugcheck[]" id="inputDosage<?= $key ?>">
                        </div>
                        <div class="col-sm-5">
                          <input type="text" class="form-control" placeholder="Dosage" name="<?= $drug->getCode() ?>">
                        </div>
                    </div>
                    <?php
                        });
                   ?>

              </div>


              <div class="form-group">
                <div class="col-sm-offset-4 col-sm-10">
                  <button type="submit" class="btn btn-primary" id="savebutton">Register</button>
                  <button type="button" class="btn btn-warning" id="cancelbutton">Cancel</button>
                </div>
              </div>

          </form>

    </fieldset>

    <datalist id="amkas">
        <?php

              $amkas = getPatientAmkasByDoctor($user);

              array_walk($amkas, function ($amka, $key) {
                  echo "<option value=" . "'" . $amka . "'>";
              });
         ?>
    </datalist>

</div>
