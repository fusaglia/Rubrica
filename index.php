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
        table { border-collapse: collapse; width: 50%; }
        th, td { border: 1px solid black; padding: 8px; text-align: left; }
        th { background-color: #eee; }
        a { text-decoration: none; color: blue; }
        button { margin: 5px; padding: 5px 10px; }
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
        // Ciclo tutti i contatti
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            // Nome cliccabile per aprire chat (link fittizio per ora)
            echo "<td><a href='?chat_id=".$row['id']."'>".$row['nome']."</a></td>";
            echo "<td>".$row['tel']."</td>";
            echo "<td>
                    <a href='?edit_id=".$row['id']."'><button>Modifica</button></a>
                    <a href='?delete_id=".$row['id']."'><button>Elimina</button></a>
                  </td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='3'>Nessun contatto</td></tr>";
    }
    ?>

</table>


<a href="?add=1"><button>Aggiungi Contatto</button></a>

</body>
</html>