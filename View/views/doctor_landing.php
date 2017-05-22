<div class="container">
    <div class="jumbotron">
        <h1>Doctor</h1>
        <?php
            $user = getLoggedUser();
         ?>
        <h2>Dr. <?= $user->getLastname(). " " . $user->getFirstname()[0] . "."?></h2>
    </div>
</div>
