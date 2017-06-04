<div class="container">
    <div class="jumbotron">
        <h1>Weclome to MedWorld</h1>
        <p>A simple web application for prescription handling</p>
    </div>


    <div class="stats">
        <fieldset>
            <legend>Statistics</legend>
            Total number of Doctors registered: <span class="stats-num"><?= getNumberOf("Doctor") ?></span><br>
            Total number of Patients treated: <span class="stats-num"><?= getNumberOf("Patient") ?></span><br>
            Total number of Prescriptions issued: <span class="stats-num"><?= getNumberOf("Prescription") ?></span><br>
            Total number of Drugs registered: <span class="stats-num"><?= getNumberOf("Drug") ?></span><br>
        </fieldset>
    </div>
    <hr>
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

    <div class="form-input">
    </div>

</div>
