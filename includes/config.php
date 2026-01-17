<?php
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'kasirmini'; 

$mysqli = new mysqli($db_host, $db_user, $db_pass, $db_name);

if ($mysqli->connect_error) {
    die("Koneksi gagal: " . $mysqli->connect_error);
}

$conn = $mysqli; 
?>

