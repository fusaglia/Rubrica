<?php
include "connessione.php";

// 1️⃣ Se arriva il POST → SALVO le modifiche
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id   = $_POST['id'];
    $nome = $_POST['nome'];
    $tel  = $_POST['tel'];

    $sql = "UPDATE contatti 
            SET nome = '$nome', tel = '$tel'
            WHERE id = $id";

    if ($conn->query($sql)) {
        header("Location: index.php");
        exit;
    } else {
        echo "Errore: " . $conn->error;
    }
}

// 2️⃣ Se arrivo qui in GET → MOSTRO il form
if (!isset($_GET['id'])) {
    die("ID mancante");
}

$id = $_GET['id'];

$sql = "SELECT * FROM contatti WHERE id = $id";
$result = $conn->query($sql);

if ($result->num_rows == 0) {
    die("Contatto non trovato");
}

$contatto = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Modifica Contatto</title>
</head>
<body>

<h2>Modifica Contatto</h2>

<form method="POST">
    <input type="hidden" name="id" value="<?php echo $contatto['id']; ?>">

    <label>Nome:</label><br>
    <input type="text" name="nome" value="<?php echo $contatto['nome']; ?>" required><br><br>

    <label>Telefono:</label><br>
    <input type="text" name="tel" value="<?php echo $contatto['tel']; ?>" required><br><br>

    <input type="submit" value="Salva Modifiche">
</form>

<br>
<a href="index.php">Torna alla rubrica</a>

</body>
</html>
