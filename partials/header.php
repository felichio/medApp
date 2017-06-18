<!DOCTYPE html>

<html>
    <head>
        <title><?= $title ?></title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
        integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"
        crossorigin="anonymous">

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="css/header.css" type="text/css">
        <link rel="stylesheet" href="css/<?= $cssName ?>.css" type="text/css">
        <link rel="shortcut icon" type="image/png" href="favicon.ico">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    </head>

    <body>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="index.php"><i class="fa fa-heartbeat fa-2" aria-hidden="true"></i>MedWorld</a>
                </div>
                <p class="navbar-text navbar-right" id="form-control-label">
                    <?php
                        if(isAuthenticated()) {
                            $user = getLoggedUser();
                            $ch_pass = ($user instanceof Admin) ? "adminonfire.php?change_pass" : "doctoronfire.php?change_pass";
                        ?>
                            Signed-In as: <a href="<?= $ch_pass ?>"><?= $user->getUsername() ?></a>
                            <a href="logout.php">Sing Out</a>
                    <?php      } else {  ?>

                        <a href="" id="signin">Sign-In</a>
                        <a href="" id="register">Register</a>
                    <?php
                        }
                        ?>

                </p>
            </div>

        </nav>
