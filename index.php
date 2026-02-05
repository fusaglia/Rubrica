<?php
include "controller/connessione.php";

$sql = "SELECT * FROM contatti";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rubrica</title>
    <style>
        table {
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 6px;
        }
        button {
            margin: 2px;
        }
    </style>
</head>
<body>

<h1>Rubrica</h1>

<table>
    <tr>
        <th>Nome</th>
        <th>Telefono</th>
        <th>Azioni</th>
    </tr>

<?php
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        
        // ✅ Escape output per sicurezza XSS
        $id = intval($row['id']);
        $nome = htmlspecialchars($row['nome']);
        $tel = htmlspecialchars($row['tel']);

        echo "<tr>";
        echo "<td>" . $nome . "</td>";
        echo "<td>" . $tel . "</td>";
        echo "<td>
                <a href='model/modifica.php?id=".$id."'><button>Modifica</button></a>
                <a href='model/elimina.php?id=".$id."'><button>Elimina</button></a>
                <a href='model/chat.php?tel=".$tel."'><button>Messaggia</button></a>
              </td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='3'>Nessun contatto</td></tr>";
}
?>
</table>

<br>

<a href="model/aggiungi.php"><button>Aggiungi Contatto</button></a>

</body>
</html>