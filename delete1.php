<?php

if (isset($_GET["idchauffeur"])) {
    $idchauffeur = $_GET["idchauffeur"];

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

    $sql = "DELETE FROM chauffeur WHERE idchauffeur=$idchauffeur";

    if ($conn->query($sql) === TRUE) {
        header("location: chauffeur.php");
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}

?>