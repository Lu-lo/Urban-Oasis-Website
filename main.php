<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>Main</title>
</head>
<body>
<?php 
session_start();

// if there is no logged in session, redirect to login page
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit();
}

//open sql connection
$mysqli = new mysqli ("localhost", "root", "root", "userdb");
								
if ($mysqli->connect_error) {
    print "Error is: " . $mysqli->connect_error;
    exit();
}
else {
    // get username and id from session array
    $id = $_SESSION['id'];
    $username = $_SESSION['username'];

    // get user's count from db and assign to $count variable
    $stmt = $mysqli->prepare("SELECT count FROM user WHERE userid = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($count);
    $stmt->fetch();
}

?>

<p>Welcome back, <?php print $username; ?>!</p>
<br>

<!--when button clicked, go to code for incrementing count-->
<form action="code.php" method="post">
    <button type="submit" class="btn btn-default" name="click">CLICK ME!</button>
    <!--display user's current count-->
    <p> Count: <?php print $count; ?></p>
</form>
<br>

<form action="logout.php" method="post">
    <button type="submit" class="btn btn-default" name="logout">logout</button>
</form>

</body>
</html>