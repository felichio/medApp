<div class="container">
    <div class="jumbotron">
        <h1>Administrator</h1>
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
        <legend>Edit Drug</legend>
        <form class="form-horizontal form-input" action="admin_drug_update.php" method="POST">
              <div class="form-group">
                <label for="inputCode" class="col-sm-2 col-sm-offset-2 control-label">Code</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" id="inputCode" placeholder="Code" name="code" value="<?= $drug->getCode() ?>">
                </div>
              </div>
              <div class="form-group">
                <label for="inputName" class="col-sm-2 col-sm-offset-2 control-label">Name</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" id="inputName" placeholder="Name" name="name" value="<?= $drug->getName() ?>">
                </div>
              </div>
              <div class="form-group">
                <label for="inputDosage" class="col-sm-2 col-sm-offset-2 control-label">Dosage</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" id="inputDosage" placeholder="Dosage" name="dosage" value="<?= $drug->getDosage() ?>">
                </div>
              </div>
              <div class="form-group">
                <label for="inputPrice" class="col-sm-2 col-sm-offset-2 control-label">Price</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" id="inputPrice" placeholder="Price" name="price" value="<?= $drug->getPrice() ?>">
                </div>
              </div>

              <input type="hidden" name="id" value="<?= $drug->getCode() ?>">

              <div class="form-group">
                <div class="col-sm-offset-4 col-sm-10">
                  <button type="submit" class="btn btn-primary" id="savebutton">Save changes</button>
                  <button type="button" class="btn btn-warning" id="cancelbutton">Cancel</button>
                </div>
              </div>

          </form>
    </fieldset>
</div>
