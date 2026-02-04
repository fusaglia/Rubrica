<?php
include "connessione.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nome = $_POST['nome'];
    $tel  = $_POST['tel'];

    $sql = "INSERT INTO contatti (nome, tel)
            VALUES ('$nome', '$tel')";

    if ($conn->query($sql)) {
        header("Location: index.php");
        exit;
    } else {
        echo "Errore: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
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
<a href="index.php">Torna alla rubrica</a>

</body>
</html>
