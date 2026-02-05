<?php
include "../controller/connessione.php";

if (!isset($_GET['id'])) {
    die("ID mancante");
}

$id = intval($_GET['id']);

// ✅ PREPARED STATEMENT
$stmt = $conn->prepare("DELETE FROM contatti WHERE id = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    $stmt->close();
    header("Location: ../index.php");
    exit;
} else {
    echo "Errore: " . $conn->error;
}
$stmt->close();
?>