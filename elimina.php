<?php
include "connessione.php";

if (!isset($_GET['id'])) {
    die("ID mancante");
}

$id = $_GET['id'];

$sql = "DELETE FROM contatti WHERE id = $id";

if ($conn->query($sql)) {
    header("Location: index.php");
    exit;
} else {
    echo "Errore: " . $conn->error;
}
