<?php
include "connessione.php";

$sql = "SELECT * FROM contatti";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
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

        echo "<tr>";
        echo "<td>" . $row['nome'] . "</td>";
        echo "<td>" . $row['tel'] . "</td>";
        echo "<td>
                <a href='modifica.php?id=".$row['id']."'><button>Modifica</button></a>
                <a href='elimina.php?id=".$row['id']."'><button>Elimina</button></a>
              </td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='3'>Nessun contatto</td></tr>";
}
?>
</table>

<br>

<a href="aggiungi.php"><button>Aggiungi Contatto</button></a>

</body>
</html>
