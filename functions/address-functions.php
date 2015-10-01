<?php
#Address Functions
#something


$results = "";
function getUserInfo($userID) {
    
    $db = getDB();
    $stmt = $db->prepare("SELECT * FROM address WHERE user_id = :user_id");
     $binds = array( 
        ":user_id" => $userID
    );
     
    $results = array();
    if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
     
    return $results;
}

function getAllAddressesAndGroups() {
 
    $db = dbconnect();
    $stmt = $db->prepare("SELECT * FROM address JOIN address_groups ON address.address_group_id = address_groups.address_group_id");
    $results = array();
    if ($stmt->execute() && $stmt->rowCount() > 0) {
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
     
    return $results;
    
}


//gets contents of addresses bd with connected address groups for one user, for one address group, sorted as directed
function getUserAddressesForOneGroup($userid, $groupid, $sortBy) 
{
    $db = dbconnect();
    $stmt = $db->prepare("SELECT * FROM address JOIN address_groups ON address.address_group_id = address_groups.address_group_id WHERE address.user_id = :user_id AND address.address_group_id = :address_group_id ORDER BY :sortBy DESC");
    $binds = array(
        ":user_id" => $userid,
        ":address_group_id"=> $groupid,
        ":sortBy" => $sortBy
        );
    $results = array();
    if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
     
    return $results;
    
}


function newAddress($userID, $group, $name, $email, $address, $phone, $website, $birthday) {
    $db = getDB();
    //get and hold the db sql statement  insert
    $stmt = $db->prepare("INSERT INTO address SET address_group_id = :group, fullname = :fullname, email = :email, address = :address, phone = :phone, website = :website, birthday = :birthday, user_id = :user_id");
    // form input into variables
    
    // bind variables to sql statement
    $binds = array(        
        ":group" => $group,
        ":fullname" => $name,
        ":email" => $email,
        ":address" => $address,
        ":phone" => $phone,
        ":website" => $website,
        ":birthday" => $birthday,
        ":user_id" => $userID
    );
       
    //execute and make sure results are returned
    if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
        //$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $results = true;
        return $results;
    } else {
        $results = false;
    }
      
    return $results;    
}

function updateAddress($group, $name, $email, $address, $phone, $website, $birthday, $updateShit) {
    $db = getDB();
    //get and hold the db sql statement  insert
    $stmt = $db->prepare("UPDATE address SET address_group_id = :group, fullname = :fullname, email = :email, address = :address, phone = :phone, website = :website, birthday = :birthday WHERE address_id = :group_id");
    // form input into variables
    
    // bind variables to sql statement
    $binds = array(        
        ":group" => $group,
        ":fullname" => $name,
        ":email" => $email,
        ":address" => $address,
        ":phone" => $phone,
        ":website" => $website,
        ":birthday" => $birthday,
        ":group_id" => $updateShit
    );
       
    //execute and make sure results are returned
    if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
        //$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $results = true;
    } else {
        $results = false;
    }
      
    return $results;    
}

function getAddressInfo() {
    $db = getDB();
    $id = filter_input(INPUT_GET, 'id');
    $stmt = $db->prepare("SELECT * FROM corps WHERE id = :id");
    $binds = array(
        ":id" => $id
    );
    if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
        $results = $stmt->fetch(PDO::FETCH_ASSOC);
    }
    if (!isset($id)) {
        die('Record not found');
    }
    
}



function getGroups() {
    $db = getDB();
    $stmt = $db->prepare("SELECT * FROM address_groups");
    if ($stmt->execute() && $stmt->rowCount() >0) {
        $groups = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    return $groups;
}

function uploadImage() {
    
    $imageName = "";
    
    try {
        // Undefined | Multiple Files | $_FILES Corruption Attack
        // If this request falls under any of them, treat it invalid.
        if ( !isset($_FILES['upfile']['error']) || is_array($_FILES['upfile']['error']) ) {       
            throw new RuntimeException('Invalid parameters.');
        }
        // Check $_FILES['upfile']['error'] value.
        switch ($_FILES['upfile']['error']) {
            case UPLOAD_ERR_OK:
                break;
            case UPLOAD_ERR_NO_FILE:
                throw new RuntimeException('No image file sent.');
            case UPLOAD_ERR_INI_SIZE:
            case UPLOAD_ERR_FORM_SIZE:
                throw new RuntimeException('Exceeded filesize limit.');
            default:
                throw new RuntimeException('Unknown errors.');
        }
        // You should also check filesize here. 
        if ($_FILES['upfile']['size'] > 1000000) {
            throw new RuntimeException('Exceeded filesize limit.');
        }
        // DO NOT TRUST $_FILES['upfile']['mime'] VALUE !!
        // Check MIME Type by yourself.
        $finfo = new finfo(FILEINFO_MIME_TYPE);
        $validExts = array(
                        'jpg' => 'image/jpeg',
                        'png' => 'image/png',
                        'gif' => 'image/gif',
                    );    
        $ext = array_search( $finfo->file($_FILES['upfile']['tmp_name']), $validExts, true );
        if ( false === $ext ) {
            throw new RuntimeException('Invalid file format.');
        }
        // You should name it uniquely.
        // DO NOT USE $_FILES['upfile']['name'] WITHOUT ANY VALIDATION !!
        // On this example, obtain safe unique name from its binary data.
        $fileName =  sha1_file($_FILES['upfile']['tmp_name']); 
        $location = sprintf('../images/%s.%s', $fileName, $ext); 
        if ( !move_uploaded_file( $_FILES['upfile']['tmp_name'], $location) ) {
            throw new RuntimeException('Failed to move uploaded file.'); 
        }
        /* File is uploaded successfully. */
        $imageName = $fileName . '.' . $ext;
        
    } catch (RuntimeException $e) {
        echo $e->getMessage();
        /* There was an error */
        
    }
    
    return $imageName;    
    
}

function getAddressById($address_id){
	$db = getDB();
	$address = array();
	$stmt = $db->prepare("SELECT * FROM address WHERE address_id = :address_id");
	
	$binds = array(
			
			":address_id" => $address_id
	);
	
	if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
		$address = $stmt->fetch(PDO::FETCH_ASSOC);
	
	}
	 
	return $address;
}
