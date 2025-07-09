<?php

if (isset($_GET["idutilisateur"])) {
    $idutilisateur = $_GET["idutilisateur"];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $db = "gestion de parking";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $db);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "DELETE FROM `utilisateur` WHERE idutilisateur=$idutilisateur";

    if ($conn->query($sql) === TRUE) {
        header("location: utilisateur.php");
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}

?>