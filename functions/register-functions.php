<?php
function createNewUser($email, $password) {
    
    if (isValidEmail($email)) {
        
        if (isValidPassword($password)) {
            
            $db = getDB();
            $stmt = $db->prepare("INSERT INTO users SET email = :email, password = :password, created = now()");
            $hashedPassword = hash('sha1', $password);
            $binds = array(
                ":email" => $email,
                ":password" => $hashedPassword
            );
            if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
                return true;
            }
        }
    }
    return false;
}

function isValidEmail($value) {
    if (empty($value)) {
        return false;
    }
    if (filter_var($value, FILTER_VALIDATE_EMAIL) == false) {
        return false;
    }
    return true;
}

function isValidPassword($value) {
    if (empty($value)) {
        return false;
    }

    if (preg_match("/^[a-zA-Z0-9]+$/", $value) == false) {
        return false;
    }
    return true;
}

function existingEmail($emailToCheck, $keyToCheck, $dbSheetToCheck){
            $db = getDB();
            
            //get list of sites to compare with site entered
            $stmt = $db->prepare("SELECT * FROM $dbSheetToCheck");
            $contentsOfDB = array();
            $newArrayToCheck = array();
 
            if ($stmt->execute() && $stmt->rowCount() > 0) 
            {
                $contentsOfDB = $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
//            //print entire array with keys for testing purposes
//            $keys = array_keys($contentsOfDB);
//            for($i = 0; $i < count($contentsOfDB); $i++) 
//            {
//                echo $keys[$i] . "{<br>";
//                foreach($contentsOfDB[$keys[$i]] as $key => $value) 
//                {
//                    echo $key . " : " . $value . "<br>";
//                }
//                echo "}<br>";
//            }
            for($i = 0; $i < count($contentsOfDB); $i++)
            {
                $newArrayToCheck[$i] = $contentsOfDB[$i][$keyToCheck];
            }
            
            if (in_array($emailToCheck, $newArrayToCheck)== false)
            {
                return false;
            }
            else
            {
                return true;
            }
}
