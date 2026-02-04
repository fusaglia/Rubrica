<?php
$host = "sql100.infinityfree.com";
$user = "if0_41070118";
$password = "pWFoS32NFg";
$dbname = "if0_41070118_rubrica";

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}
?>
