<?php
$host = "db-mysql-cit-480-do-user-21182630-0.f.db.ondigitalocean.com";
$port = 25060;
$username = "doadmin";
$password = "AVNS_ujNfYNXFSDABsbgHVGz";
$database = "defaultdb";
$ssl_cert = "/etc/ssl/certs/ca-certificate.crt";

$mysqli = mysqli_init();
mysqli_ssl_set($mysqli, NULL, NULL, $ssl_cert, NULL, NULL);
mysqli_real_connect($mysqli, $host, $username, $password, $database, $port, NULL, MYSQLI_CLIENT_SSL);

?>