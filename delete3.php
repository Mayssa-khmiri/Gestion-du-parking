<?php

if (isset($_GET["idflux"])) {
    $idchauffeur = $_GET["idflux"];

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

    $sql = "DELETE FROM `flux acces` WHERE 0";

    if ($conn->query($sql) === TRUE) {
        header("location: flux.php");
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}

?>