<?php
    include 'dblogin.php';

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

    // Close connection
    $conn->close();

?>

<!DOCTYPE html>
<html>
<head>
    <title>Benutzer bearbeiten</title>
</head>
<body>
    <a href="settings.php">Zurück</a>
    <script type="text/javascript"> window.location = "settings.php"; </script>
</body>
</html>

