<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Itchy Iguana</title>
        <link rel="stylesheet" href="../css/bootstrap.css">
        <link rel="stylesheet" href="../css/bootstrap-theme.css">
        <script language="javascript" type="text/javascript" src="../js/cd.js"></script>
        
        <?php
        require '../functions/dbConn.php';
        require '../functions/util.php';
        require '../functions/logout-functions.php';
        require '../functions/session-start.req-inc.php';
        require '../functions/login-functions.php';
        require '../functions/register-functions.php';
        require '../templates/loggedin-header.html.php';
        require '../templates/access-required.html.php';
        require '../functions/address-functions.php';
        
        ?>
    </head>
    <body>

        <div class="container">
            <div class="jumbotron vertical-center">
                <?php
                $view = filter_input(INPUT_GET, 'view');

                if ($view === 'logout') {

                    loggedOut();
                    header('Location: ../index.php');
                } else if ($view === 'book') {
                    $userID = $_SESSION['userID'];
                    $results = getUserInfo($userID);

                    include '../templates/address-book.html.php';
                } else if ($view === 'add') {
                    if (isPostRequest()) {
                        $userID = $_SESSION['userID'];
                        $group = filter_input(INPUT_POST, 'group');
                        $name = filter_input(INPUT_POST, 'fullname');
                        $email = filter_input(INPUT_POST, 'email');
                        $address = filter_input(INPUT_POST, 'address');
                        $phone = filter_input(INPUT_POST, 'phone');
                        $website = filter_input(INPUT_POST, 'website');
                        $birthday = filter_input(INPUT_POST, 'birthday');
                        if (empty($name)) {
                            echo "Cannot have a blank name.";
                        }else {
                            $results = newAddress($userID, $group, $name, $email, $address, $phone, $website, $birthday);
                        }
                        if ($results === true) {
                            echo "Address Added";
                        }else{
                            echo "Address Not Added";
                        }
                    }
                    $groups = getGroups();
                    include '../templates/add-address.html.php';
                } else if ($view === 'update') {
                    $groups = getGroups();
                   if (isPostRequest()) {
                        $userID = $_SESSION['userID'];
                        $group = filter_input(INPUT_POST, 'group');
                        $name = filter_input(INPUT_POST, 'fullname');
                        $email = filter_input(INPUT_POST, 'email');
                        $address = filter_input(INPUT_POST, 'address');
                        $phone = filter_input(INPUT_POST, 'phone');
                        $website = filter_input(INPUT_POST, 'website');
                        $birthday = filter_input(INPUT_POST, 'birthday');
                        $updateShit = filter_input(INPUT_POST, 'updateForm');
                        if (empty($name)) {
                            echo "Cannot have a blank name.";
                        } else {
                            $results = updateAddress($group, $name, $email, $address, $phone, $website, $birthday, $updateShit);
                        }
                        if ($results === true) {
                            echo "Address Updated";
                        }else {
                            echo "Address Not Updated";
                        }
                   }
                   $address_id = filter_input(INPUT_GET, 'id');
                   $results = getAddressById($address_id);
                   
                    include '../templates/update-address.html.php';
                }else {
                    /* Default view */

                    include '../templates/loggedin-default.html.php';
                }
                ?>
            </div>
        </div>
    </body>
</html>
