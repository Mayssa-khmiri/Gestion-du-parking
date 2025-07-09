<?php
if (isset($_GET["iddirection"])) {
    $iddirection = intval($_GET["iddirection"]);

    $servername = "localhost";
    $username = "root";
    $password = "";
    $db = "gestion de parking";

    // Créer une connexion
    $conn = new mysqli($servername, $username, $password, $db);

    // Vérifier la connexion
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Utilisation de requêtes préparées pour éviter les injections SQL
    $stmt = $conn->prepare("DELETE FROM `direction` WHERE iddirection = ?");
    $stmt->bind_param("i", $iddirection);

    if ($stmt->execute()) {
        header("Location: direction.php");
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }

    // Fermer la déclaration et la connexion
    $stmt->close();
    $conn->close();
}
?>
