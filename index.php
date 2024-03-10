<?php

include 'dblogin.php';

// POST-Daten verarbeiten
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $aktiv = $_POST['aktiv'];

    // Alle Einträge auf 0 setzen
    $sql_reset = "UPDATE nachtschaltung SET aktiv = 0";
    $conn->query($sql_reset);

    // Den angeklickten Button auf 1 setzen
    $sql_update = "UPDATE nachtschaltung SET aktiv = 1 WHERE id = $id";
    if ($conn->query($sql_update) === TRUE) {
        echo "Aktiv-Wert erfolgreich aktualisiert";
    } else {
        echo "Fehler beim Aktualisieren des Aktiv-Werts: " . $conn->error;
    }
}
?>

<html>
<head>
<title>Pickenpack Rufumleitung</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="icon" href="assets/favicon.ico">
<link rel="stylesheet" href="style.css">


</head>
<body class="bluebackground">

<main>
    <h1>Pickenpack Rufumleitung</h1>

<?php
    include 'dblogin.php';

    // query only the name
    $sql = "SELECT id, beschriftung, ziel, aktiv FROM nachtschaltung";
    $result = $conn->query($sql);

    foreach ($result as $row) {

        //"aktiv" ist ein boolean
        //wenn aktiv = 1, dann ist die Rufumleitung aktiviert
        //wenn aktiv = 0, dann ist die Rufumleitung deaktiviert

        if ($row["aktiv"] == true) {

            echo "<button class='button-main button-active' onclick='toggleAktiv(" . $row["id"] . ", " . $row["aktiv"] . ")'>";
            echo $row["beschriftung"];
            echo "</button>";

        } else {
            echo "<button class='button-main' onclick='toggleAktiv(" . $row["id"] . ", " . $row["aktiv"] . ")'>";
            echo $row["beschriftung"];
            echo "</button>";
        }
    }

    //aktive Telefonnummer ausgeben
    $sql_aktive_telefonnummer = "SELECT ziel FROM nachtschaltung WHERE aktiv = 1";
    $result_aktive_telefonnummer = $conn->query($sql_aktive_telefonnummer);
    /* echo "<p class=\"tel_ausgabe\">Aktive Telefonnummer: <span style=\"text-decoration: underline;\">" . $result_aktive_telefonnummer->fetch_assoc()["ziel"] . "</span><br></p>"; */

    // Close connection
    $conn->close();
?>


<script>
function toggleAktiv(id, aktuellAktiv) {
    var neuerWert = aktuellAktiv === 1 ? 0 : 1;

    // AJAX-Anfrage senden
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "index.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            console.log(xhr.responseText); // Gib die Antwort im Konsolen-Log aus
            location.reload(); // Seite neu laden

        }
    };
    xhr.send("id=" + id + "&aktiv=" + neuerWert);
}
</script>

<hr>
<div style="margin: 0 auto; text-align: center;">
    <button class="button-settings"><a href="settings.php">Einstellungen</a></button>
</div>

</main>

</body>
</html>
