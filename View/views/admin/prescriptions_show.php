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
        $ids = [];
        array_walk($prescriptions, function ($prescription, $key) use (&$ids){
            if (!in_array($prescription["id"], $ids)) {
                $ids[] = $prescription["id"];
    ?>
        <div class="panel panel-warning">
            <div class="panel-heading">
                <h5>Prescription #<?= $prescription["id"]?></h5>
            </div>
            <div class="panel-body">
                <table class="table table-hover prescriptions-table">
                    <thead>
                        <tr>
                            <th>Doctor's Name</th>
                            <th>Patient's Name</th>
                            <th>Codes of Drugs/Dosage</th>
                            <th>Date Of Issue</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td><?= $prescription["dname"] ?></td>
                            <td><?= $prescription["pname"] ?></td>
                            <?php
                            echo "<td>";
                                $drugs = getDrugsAndDosageByPrescriptionId($prescription["id"]);
                                array_walk($drugs, function ($drug, $key) {
                                    $dosage = $drug["dosage"] === "" ? $drug["drug"]->getDosage() : $drug["dosage"];
                                    echo $drug["drug"]->getName() . " (". $drug["drug"]->getCode() . ", ". $dosage .")<br>";
                                });
                            echo "</td>";
                             ?>
                            <td><?= $prescription["date"] ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    <?php
            }
        });
    ?>
    </div>
    <button type="button" class="btn btn-warning" id="backbutton">Back</button>


</div>
