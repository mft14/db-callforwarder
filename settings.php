<?php

    include 'dblogin.php';
    $limit = 10; // Maximale Datensätze

    // Update user data if form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = $_POST["id"];
        $beschriftung = $_POST["beschriftung"];
        $ziel = $_POST["ziel"];
        $torziel = $_POST["torziel"];

        $sql = "UPDATE nachtschaltung SET beschriftung='$beschriftung', ziel='$ziel', torziel='$torziel' WHERE id=$id";

        if ($conn->query($sql) === TRUE) {
            echo "Datensätze erfolgreich aktualisiert";
        } else {
            echo "Fehler beim Aktualisieren der Datensätze: " . $conn->error;
        }
    }

    // Query all users
    $sql = "SELECT id, beschriftung, ziel, torziel, aktiv FROM nachtschaltung";
    $result = $conn->query($sql);

    // Close connection
    $conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Benutzerverwaltung</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="style.css">


</head>
<body>

<main>
<a href="index.php">Zurück</a>
    <h2>Benutzerverwaltung</h2>
    <table>
        <thead>
            <tr>
                <th>Nr.</th>
                <th>Name</th>
                <th>Ziel</th>
                <th>Torziel</th>
                <th>SAVE</th>
                <th>DEL</th>
            </tr>
        </thead>
        <tbody>
            <?php
                if ($result->num_rows > 0) {
                    $i = 1;
                    while($row = $result->fetch_assoc()) {

                        // wenn aktiv, dann mach die Zeile grün und Schriftfarbe schwarz

                        if ($row["aktiv"] == 1) {
                            echo "<tr style='background-color: lightgreen; color: black;'>";
                        }
                        else {
                            echo "<tr>";
                        }

                        echo "<td>" . $i . ".</td>";
                        echo "

                        <form method='post' action='edit.php'>
                        <td><input id=\"beschriftung\" name=\"beschriftung\" type=\"text\" value=\"" . $row["beschriftung"]. "\" required></td>
                        <td><input id=\"ziel\" name=\"ziel\" type=\"text\" value=\"" . $row["ziel"]. "\" required></td>
                        <td><input id=\"torziel\" name=\"torziel\" type=\"text\" value=\"" . $row["torziel"]. "\" required></td>

                        <td>
                        <input type='hidden' name='id' value='" . $row["id"] . "'>
                        <input type='submit' value='💾'>
                        </form>
                        </td>

                        <td>
                        <form method='post' action='delete.php'>
                        <input type='hidden' name='id' value='" . $row["id"] . "'>
                        <input type='submit' value='❌'>
                        </form>
                        </td>

                        </tr>";
                        $i++;
                    }
                } else {
                    echo "<tr><td colspan='4'>Keine Benutzer gefunden</td></tr>";
                }

            // add row to add new user
            
            if ($i > $limit) {
                echo "<tr><td style='color:red; font-weight: bold;' colspan='5'>Maximal " . $limit . " Datensätze möglich</td></tr>";
            }
            else {

                echo "<tr>";
                echo "<td>" . $i . ".</td>";

                echo "

                <form method='post' action='add.php'>
                <td><input id=\"beschriftung\" name=\"beschriftung\" type=\"text\" required></td>
                <td><input id=\"ziel\" name=\"ziel\" type=\"text\" required></td>
                <td><input id=\"torziel\" name=\"torziel\" type=\"text\" required></td>
                <td>

                <input type='hidden' name='i' value='" . $i . "'>
                <input type='submit' value='➕'>
                </form>
                </td>
                </tr>";

            }



            ?>
        </tbody>
    </table>
</main>




</body>



</html>
