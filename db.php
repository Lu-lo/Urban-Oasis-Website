<?php
$user = "dbuser";
$password = "password";
$database = "userdb";
$table = "user";

try {
  $mysqli = new PDO("mysql:host=localhost;dbname=$database", $user, $password);

} 
catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}

?>