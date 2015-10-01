<!DOCTYPE html>
<!-- 
<=== Landing Page ===>
<=== includes for ===>
<===     Login    ===>
<===    Register  ===>
<===     About    ===>
<===              ===>
-->



<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Itchy Iguana</title>
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="css/bootstrap-theme.css">
        <?php 
        require'/functions/session-start.req-inc.php';
        require '/functions/dbConn.php';
        require '/functions/util.php';
        require '/functions/login-functions.php';
        require '/functions/register-functions.php';
        require '/templates/header.html.php';
        ?>
    </head>
    <body>

        <div class="container">
            <div class="jumbotron vertical-center">

                <?php
                $view = filter_input(INPUT_GET, 'view');


                if ($view === 'login') {
                    if (isPostRequest()) {

                        $email = filter_input(INPUT_POST, 'email');
                        $password = filter_input(INPUT_POST, 'pass');
                        if (isValidUser($email, $password)) {
                            $_SESSION ['isValidUser'] = true;
                        } else {
                            $results = 'Sorry please try again';
                        }
                    }

                    if (isset($_SESSION['isValidUser']) && $_SESSION['isValidUser'] === true) {
                        
                        header('Location: site/index.php');
                    }
                    include '/templates/results.html.php';
                    include '/templates/login.html.php';
                } else if ($view === 'register') {
                    
                    include './templates/register.html.php';
                } else {
                    /* Default view */
                    
                    
                    include './templates/default.html.php';
                }
                ?>

            </div>
        </div>
    </body>
</html>
