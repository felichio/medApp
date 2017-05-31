<div class="container">
    <div class="jumbotron">
        <h1>Administrator</h1>
        <?php
            $user = getLoggedUser();
         ?>
        <h2><?= $user->getLastname(). " " . $user->getFirstname()[0] . "."?></h2>
    </div>


    <div class="PrescriptionPanel">
    <?php
        array_walk($prescriptions, function ($prescription, $key) {
    ?>
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h5>Prescription #<?= $prescription["id"]?></h5>
            </div>
            <div class="panel-body">
                <table class="table table-hover prescriptions-table">
                    <thead>
                        <tr>
                            <th>Doctor's Name</th>
                            <th>Patient's Name</th>
                            <th>Code of Drug</th>
                            <th>Date Of Issue</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td><?= $prescription["dname"] ?></td>
                            <td><?= $prescription["pname"] ?></td>
                            <td><?= $prescription["code"] ?></td>
                            <td><?= $prescription["date"] ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    <?php
        });
    ?>
    </div>
    <button type="button" class="btn btn-warning" id="backbutton">Back</button>


</div>
