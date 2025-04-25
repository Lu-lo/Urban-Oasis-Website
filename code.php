<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>code</title>
</head>
<body>
    <?php
        session_start();
	    // $mysqli = new mysqli ("localhost", "root", "root", "userdb");
        require 'db.php';

        if ($mysqli->connect_error) {
            print "Error is: " . $mysqli->connect_error;
            exit();
        }
        
        $id = $_SESSION['id'];

        // select user's count and assign to $count variable
        $stmt = $mysqli->prepare("SELECT count FROM user WHERE userid = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($count);
        $stmt->fetch();

        // increment count
        $newCount = ++$count; 

        // update user's count to new value
        $stmt = $mysqli->prepare("UPDATE user SET count = ? WHERE userid = ?");
        $stmt->bind_param("ii", $newCount, $id);
        $stmt->execute();
        $stmt->store_result();
        
        // return to main page
        header("Location: main.php");
        exit();
    ?>    
</body>
</html>