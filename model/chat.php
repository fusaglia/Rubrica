<?php
include "../controller/connessione.php";

$mio_numero = "3331112222";

if (!isset($_GET['tel'])) {
    die("Numero mancante");
}

$altro = trim($_GET['tel']);

// INVIO SMS
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $testo = trim($_POST['messaggio']);

    // ✅ PREPARED STATEMENT
    $stmt = $conn->prepare("INSERT INTO sms (mittente, destinatario, messaggio) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $mio_numero, $altro, $testo);
    $stmt->execute();
    $stmt->close();
}

// LEGGO SMS
// ✅ PREPARED STATEMENT
$stmt = $conn->prepare("SELECT * FROM sms
        WHERE 
        (mittente=? AND destinatario=?)
        OR
        (mittente=? AND destinatario=?)
        ORDER BY data_ora");
$stmt->bind_param("ssss", $mio_numero, $altro, $altro, $mio_numero);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat</title>
</head>
<body>

<h2>Chat con <?php echo htmlspecialchars($altro); ?></h2>

<div style="border:1px solid black; padding:10px; height:300px; overflow:auto;">
<?php
while ($row = $result->fetch_assoc()) {
    if ($row['mittente'] == $mio_numero) {
        echo "<p><b>Io:</b> ".htmlspecialchars($row['messaggio'])."</p>";
    } else {
        echo "<p><b>Lui:</b> ".htmlspecialchars($row['messaggio'])."</p>";
    }
}
$stmt->close();
?>
</div>

<br>

<form method="POST">
    <textarea name="messaggio" rows="3" cols="40" required></textarea><br><br>
    <input type="submit" value="Invia">
</form>

<br>
<a href="../index.php">Torna alla rubrica</a>

</body>
</html>