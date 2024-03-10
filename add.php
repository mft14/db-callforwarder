
<?php
//add a new data set to the database
    include 'dblogin.php';

    $limit = 10;
    // Update user data if form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $i = $_POST['i'];

        // Wenn weniger als 10 Datensätze vorhanden sind, füge einen neuen hinzu
        if ($i <= $limit) {
            $beschriftung = $_POST["beschriftung"];
            $ziel = $_POST["ziel"];
            $torziel = $_POST["torziel"];

            $sql = "INSERT INTO nachtschaltung (beschriftung, ziel, torziel, aktiv) VALUES ('$beschriftung', '$ziel','$torziel', false)";

            if ($conn->query($sql) === TRUE) {
                echo "Datensatz erfolgreich hinzugefügt";
            } else {
                echo "Fehler beim Aktualisieren der Datensätze: " . $conn->error;
            }
        } else { //Ansonsten gebe eine Fehlermeldung aus
            echo "Fehler: Es können maximal 10 Datensätze hinzugefügt werden";
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

