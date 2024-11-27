<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>logout</title>
</head>
<body>
    <?php
        // clear session variables, destroy session, and redirect to login page
        session_start();
        $_SESSION = array();
        session_destroy();

        header("location: index.html");
        exit();
    ?>
</body>
</html>