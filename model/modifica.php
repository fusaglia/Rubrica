<?php
include "../controller/connessione.php";

// 1️⃣ Se arriva il POST → SALVO le modifiche
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id   = intval($_POST['id']);
    $nome = trim($_POST['nome']);
    $tel  = trim($_POST['tel']);

    // ✅ PREPARED STATEMENT
    $stmt = $conn->prepare("UPDATE contatti SET nome = ?, tel = ? WHERE id = ?");
    $stmt->bind_param("ssi", $nome, $tel, $id);

    if ($stmt->execute()) {
        $stmt->close();
        header("Location: ../index.php");
        exit;
    } else {
        echo "Errore: " . $conn->error;
    }
    $stmt->close();
}

// 2️⃣ Se arrivo qui in GET → MOSTRO il form
if (!isset($_GET['id'])) {
    die("ID mancante");
}

$id = intval($_GET['id']);

// ✅ PREPARED STATEMENT
$stmt = $conn->prepare("SELECT * FROM contatti WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    die("Contatto non trovato");
}

$contatto = $result->fetch_assoc();
$stmt->close();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifica Contatto</title>
</head>
<body>

<h2>Modifica Contatto</h2>

<form method="POST">
    <input type="hidden" name="id" value="<?php echo htmlspecialchars($contatto['id']); ?>">

    <label>Nome:</label><br>
    <input type="text" name="nome" value="<?php echo htmlspecialchars($contatto['nome']); ?>" required><br><br>

    <label>Telefono:</label><br>
    <input type="text" name="tel" value="<?php echo htmlspecialchars($contatto['tel']); ?>" required><br><br>

    <input type="submit" value="Salva Modifiche">
</form>

<br>
<a href="../index.php">Torna alla rubrica</a>

</body>
</html>