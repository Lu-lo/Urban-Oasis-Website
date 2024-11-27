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

    session_start();
	$mysqli = new mysqli ("localhost", "root", "root", "userdb");
	
    // if sql fails to connect, print error
	if ($mysqli->connect_error) {
		print "Error is: " . $mysqli->connect_error;
		exit();
	}

    // search for matching username and password pair in db
    $stmt = $mysqli->prepare("SELECT userid FROM user WHERE username = ? AND password =?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $stmt->store_result();

    // if user is found, start session and direct to main page
    if($stmt->num_rows > 0) {
        $stmt->bind_result($id);
        $stmt->fetch();

        $_SESSION['loggedin'] = true;
        $_SESSION['id'] = $id;
        $_SESSION['username'] = $username;

        header("Location: main.php");
        exit();

    }
    // otherwise, print error message
    else {
        print "Error! Invalid credentials";
        exit();
    }

?>

</body>
</html>