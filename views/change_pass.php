<div class="container">

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
        <legend>Change Password</legend>
        <form class="form-horizontal" action="modify_pass.php" method="POST">
            <div class="form-group">
              <label for="inputPassword1" class="col-sm-2 col-sm-offset-2 control-label">New Password</label>
              <div class="col-sm-5">
                <input type="password" class="form-control" id="inputPassword1" placeholder="Password" name="password1">
              </div>
            </div>
            <div class="form-group">
              <label for="inputPassword2" class="col-sm-2 col-sm-offset-2 control-label">Confirm Password</label>
              <div class="col-sm-5">
                <input type="password" class="form-control" id="inputPassword2" placeholder="Repeat Password" name="password2">
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-offset-4 col-sm-10">
                <button type="submit" class="btn btn-primary" id="changebutton">Change</button>
                <button type="button" class="btn btn-warning" id="cancelbutton">Cancel</button>
              </div>
            </div>
        </form>
    </fieldset>
</div>
