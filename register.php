<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>Register</title>
</head>
<body>
<?php 
    session_start();
    // get username and password from html
	$username = $_REQUEST["newuser"];
	$password = $_REQUEST["newpass"];	
    // $email = $_REQUEST["email"]
    //encrypt password
    $hash = password_hash($password, PASSWORD_DEFAULT); 

    require 'db.php';
								
	if ($mysqli->connect_error) {
		print "Error is: " . $mysqli->connect_error;
		exit();
	}

    // check for matching username in db
    $stmt = $mysqli->prepare("SELECT * FROM user WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // if user is found, print error message
    if($result->num_rows > 0) {
        print "Error! User already exists";
        exit();
    }

    // otherwise, add new user to db
    else {
        $stmt = $mysqli->prepare( "INSERT INTO user (username, password) VALUES (?, ?)" );
	    $stmt->bind_param("ss", $username, $hash);
        $success = $stmt->execute();
    }

    if(!$success) {
        print "Error! Insert failed!";
    }
    else {
        // select new user's id and assign session variables
        $stmt = $mysqli->prepare("SELECT userid FROM user WHERE username = ? AND password =?");
        $stmt->bind_param("ss", $username, $hash);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($id);
        $stmt->fetch();

        $_SESSION['loggedin'] = true;
        $_SESSION['id'] = $id;
        $_SESSION['username'] = $username;

        // direct to main page
        header("Location: main.php");
        exit();
    }
?>
</body>
</html>
