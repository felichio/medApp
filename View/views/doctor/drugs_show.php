<div class="container">
    <div class="jumbotron">
        <h1>Doctor</h1>
        <?php
            $user = getLoggedUser();
         ?>
        <h2>Dr. <?= $user->getLastname(). " " . $user->getFirstname()[0] . "."?></h2>
    </div>


    <div class="DrugPanel">
        <?php
            array_walk($drugs, function ($drug, $key) {
        ?>
            <div class="panel panel-warning">
                <div class="panel-heading">
                    <h5>Drug #<?= ++$key ?></h5>
                </div>
                <div class="panel-body">
                    <table class="table table-hover prescriptions-table">
                        <thead>
                            <tr>
                                <th>Drug's Code</th>
                                <th>Drug's Name</th>
                                <th>Suggested Dosage</th>
                                <th>Price</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td><?= $drug->getCode() ?></td>
                                <td><?= $drug->getName() ?></td>
                                <td><?= $drug->getDosage() ?></td>
                                <td><?= $drug->getPrice() ?></td>
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
