<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>PHP</title>
</head>
<body>
<?php
    // get username and password from html form
    $username = $_REQUEST["username"];
    $password = $_REQUEST["password"];	
    $hash = password_hash($password, PASSWORD_DEFAULT); 

    session_start();
	//$mysqli = new mysqli ("localhost", "root", "root", "userdb");
    require 'db.php';
    
    // if sql fails to connect, print error
	if ($mysqli->connect_error) {
		print "Error is: " . $mysqli->connect_error;
		exit();
	}

    // search for matching username in db
    $stmt = $mysqli->prepare("SELECT userid FROM user WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    
    // if user is found, retrieve encrypted password from db
    if($stmt->num_rows > 0) {
        $req = $mysqli->prepare("SELECT password FROM user WHERE username = ?");
        $req->bind_param("s", $username);
        $req->execute();
        $req->store_result();
        $req->bind_result($ver);
        $req->fetch();

        // check for password match
        if (password_verify($password, $ver)) {
            // if password matches, start session and redirect to main page
            $stmt->bind_result($id);
            $stmt->fetch();

            $_SESSION['loggedin'] = true;
            $_SESSION['id'] = $id;
            $_SESSION['username'] = $username;

            header("Location: main.php");
            exit();
        }
        //otherwise, redirect to error screen
        else {
            header("location: error.html");
            exit();
        }
    }

    else {
        echo "$ver";
        echo "$hash";
        echo(password_verify($ver, $hash));
        print "Error! Invalid credentials2";
        exit();
    }

?>

</body>
</html>