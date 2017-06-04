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
        <legend>Edit Patient</legend>
        <form class="form-horizontal form-input" action="doctor_pat_update.php" method="POST">

              <div class="form-group">
                <label for="inputFirstname" class="col-sm-2 col-sm-offset-2 control-label">Firstname</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" id="inputFirstname" placeholder="Firstname" name="firstname" value="<?= $patient->getFirstname() ?>">
                </div>
              </div>
              <div class="form-group">
                <label for="inputLastname" class="col-sm-2 col-sm-offset-2 control-label">Lastname</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" id="inputLastname" placeholder="Lastname" name="lastname" value="<?= $patient->getLastname() ?>">
                </div>
              </div>
              <div class="form-group">
                <label for="inputAmka" class="col-sm-2 col-sm-offset-2 control-label">AMKA</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" id="inputAmka" placeholder="AMKA" name="amka" value="<?= $patient->getAmka() ?>">
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail" class="col-sm-2 col-sm-offset-2 control-label">Date of Birth</label>
                <div class="col-sm-5">
                  <input type="date" class="form-control" id="inputDate" placeholder="Date" name="date" value="<?= $patient->getDateOfBirth() ?>">
                </div>
              </div>
              <input type="hidden" name="id" value="<?= $patient->getId() ?>">
              <div class="form-group">
                <div class="col-sm-offset-4 col-sm-10">
                  <button type="submit" class="btn btn-primary" id="savebutton">Save changes</button>
                  <button type="button" class="btn btn-warning" id="cancelbutton">Cancel</button>
                </div>
              </div>

          </form>

    </fieldset>


</div>
