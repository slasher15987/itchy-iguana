<?php
/*
 * users
 * user_id
 * email
 * password
 */
function isValidUser( $email, $pass ) {
    
    $db = getDB();
    $userInfoFromDB = array();
    $stmt = $db->prepare("SELECT * FROM users WHERE email = :email and password = :password");
    $pass = sha1($pass);
    $binds = array(
        ":email" => $email,
        ":password" => $pass        
    );
    if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
        $userInfoFromDB = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $_SESSION['userID'] = $userInfoFromDB[0]['user_id'];
        $_SESSION['userEmail'] = $userInfoFromDB[0]['email'];
        return true;
    }
     
    return false;
    
}