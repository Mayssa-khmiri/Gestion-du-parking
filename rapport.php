<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultation de l'historique</title>
    <link rel="stylesheet" href="Rapport1.css">
    <style>
        @media print {
            body * {
                visibility: hidden;
            }
            #table-print, #table-print * {
                visibility: visible;
            }
            #table-print {
                position: absolute;
                left: 0;
                top: 0;
            }
        }
    </style>
</head>
<body>

<h2>Consultation de l'historique</h2>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    Date: <input type="date" name="date">
    Type de transaction:
    <select name="type">
        <option value="entrant">Entrant</option>
        <option value="sortant">Sortant</option>
        <option value="garée">Garée</option>
        <option value="tous">Tous</option>
    </select>
    <br><br>
    <button type="submit" name="submit">Envoyer</button>
    <button type="reset">Annuler</button>
</form>

<?php
// Vérification si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des données du formulaire
    $date = $_POST["date"];
    $type = $_POST["type"];

    // Connexion à la base de données
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "gestion de parking";

    $conn = new mysqli($servername, $username, $password, $database);

    // Vérification de la connexion
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Récupération des données de la base de données en fonction des données du formulaire
    // Requête SQL pour récupérer toutes les données selon la date et le type
    if ($type == 'tous') {
        $sql = "SELECT * FROM flux acces WHERE date='$date'";
    } else {
        $sql = "SELECT * FROM flux acces WHERE type='$type' AND date='$date'";
    }
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Affichage des résultats de la consultation dans un tableau
        echo "<div id='table-print'>";
        echo "<h3>Résultats de la consultation</h3>";
        echo "<table border='1'>
                <tr>
                    <th>id</th>
                    <th>idvehicule</th>
                    <th>numerobadge</th>
                    <th>nom</th>
                    <th>immatricule</th>
                    <th>type</th>
                    <th>date</th>
                    <th>heure</th>
                </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row["idflux"] . "</td>
                    <td>" . $row["idvehicule"] . "</td>
                    <td>" . $row["numerobadge"] . "</td>
                    <td>" . $row["nom"] . "</td>
                    <td>" . $row["immatricule"] . "</td>
                    <td>" . $row["type"] . "</td>
                    <td>" . $row["date"] . "</td>
                    <td>" . $row["heure"] . "</td>
                </tr>";
        }
        echo "</table>";
        echo "</div>";
    } else {
        echo "Aucun résultat trouvé.";
    }

    // Fermeture de la connexion à la base de données
    $conn->close();

    // Bouton pour imprimer la page
    echo "<button onclick='window.print()'>Imprimer</button>";
}
?>

</body>
</html>
