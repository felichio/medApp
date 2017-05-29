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
        <legend>Edit Doctor</legend>
        <form class="form-horizontal form-input" action="admin_doc_update.php" method="POST">
              <div class="form-group">
                <label for="inputUsername" class="col-sm-2 col-sm-offset-2 control-label">Username</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" id="inputUsername" placeholder="Username" name="username" value="<?= $doctor->getUsername() ?>">
                </div>
              </div>
              <div class="form-group">
                <label for="inputFirstname" class="col-sm-2 col-sm-offset-2 control-label">Firstname</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" id="inputFirstname" placeholder="Firstname" name="firstname" value="<?= $doctor->getFirstname() ?>">
                </div>
              </div>
              <div class="form-group">
                <label for="inputLastname" class="col-sm-2 col-sm-offset-2 control-label">Lastname</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" id="inputLastname" placeholder="Lastname" name="lastname" value="<?= $doctor->getLastname() ?>">
                </div>
              </div>
              <div class="form-group">
                <label for="inputAmka" class="col-sm-2 col-sm-offset-2 control-label">AMKA</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" id="inputAmka" placeholder="AMKA" name="amka" value="<?= $doctor->getAmka() ?>">
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail" class="col-sm-2 col-sm-offset-2 control-label">Email</label>
                <div class="col-sm-5">
                  <input type="email" class="form-control" id="inputEmail" placeholder="Email" name="email" value="<?= $doctor->getEmail() ?>">
                </div>
              </div>
              <!-- <div class="form-group">
                <label for="inputPassword1" class="col-sm-2 col-sm-offset-2 control-label">Password</label>
                <div class="col-sm-5">
                  <input type="password" class="form-control" id="inputPassword1" placeholder="Password" name="password1">
                </div>
              </div>
              <div class="form-group">
                <label for="inputPassword2" class="col-sm-2 col-sm-offset-2 control-label">Password Confirm</label>
                <div class="col-sm-5">
                  <input type="password" class="form-control" id="inputPassword2" placeholder="Repeat Password" name="password2">
                </div>
              </div> -->
              <div class="form-group">
                <div class="col-sm-offset-4 col-sm-10">
                  <button type="submit" class="btn btn-primary" id="savebutton">Save changes</button>
                  <button class="btn btn-warning" id="cancelbutton">Cancel</button>
                </div>
              </div>
          </form>
    </fieldset>


</div>