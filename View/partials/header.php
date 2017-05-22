<!DOCTYPE html>

<hmtl>
    <head>
        <title><?= $title ?></title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-witdh, initial-scale=1.0">

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
        integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"
        crossorigin="anonymous">

        <link rel="stylesheet" href="css/header.css" type="text/css">
        <link rel="stylesheet" href="css/<?= $cssName ?>.css" type="text/css">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    </head>

    <body>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="index.php">MedWorld</a>
                </div>
                <p class="navbar-text navbar-right" id="form-control-label">
                    <?php
                        if(isAuthenticated()) {
                            $user = getLoggedUser();
                        ?>
                            Signed-In as: <a href=""><?= $user->getUsername() ?></a>
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
