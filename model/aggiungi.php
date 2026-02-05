<?php
include "../controller/connessione.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nome = trim($_POST['nome']);
    $tel  = trim($_POST['tel']);

    // ✅ PREPARED STATEMENT (sicuro contro SQL injection)
    $stmt = $conn->prepare("INSERT INTO contatti (nome, tel) VALUES (?, ?)");
    $stmt->bind_param("ss", $nome, $tel);

    if ($stmt->execute()) {
        $stmt->close();
        header("Location: ../index.php");
        exit;
    } else {
        echo "Errore: " . $conn->error;
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aggiungi Contatto</title>
</head>
<body>

<h2>Aggiungi Contatto</h2>

<form method="POST">
    <label>Nome:</label><br>
    <input type="text" name="nome" required><br><br>

    <label>Telefono:</label><br>
    <input type="text" name="tel" required><br><br>

    <input type="submit" value="Salva">
</form>

<br>
<a href="../index.php">Torna alla rubrica</a>

</body>
</html>