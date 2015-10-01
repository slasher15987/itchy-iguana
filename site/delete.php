<?php
require '../functions/dbConn.php';
require '../functions/util.php';
require '../functions/session-start.req-inc.php';
require '../templates/access-required.html.php';
require '../functions/address-functions.php';

//hold database connection
$db = getDB();
//filter input for id
$id = filter_input(INPUT_GET, 'id');
//prepare sql statement
$stmt = $db->prepare("DELETE FROM address WHERE address_id = :id");
//bind id to variable
$binds = array(
    ":id" => $id
);
//checks if entry is deleted or not
$isDeleted = false;
if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
    $isDeleted = true;
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Itchy Iguana</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <div class="container">
            <div class="jumbotron vertical-center">

                <center><h1>Itchy Iguana</h1><br /><br/>
                    <h3> Record <?php echo $id; ?>
                        <?php if (!$isDeleted): ?> 
                            Not
                        <?php endif; ?>
                        Deleted</h3>

                    <p> <a href="index.php" class="btn btn-default">Back to Index</a></p>
                </center>
            </div>
        </div>
    </body>
</html>