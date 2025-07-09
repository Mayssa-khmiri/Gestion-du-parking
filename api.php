<?php
// Connexion à la base de données MySQL
$servername = "localhost";
$username = "root";
$password = ""; // Votre mot de passe MySQL
$dbname = "gestion de parking"; // Nom de la base de données MySQL

// Création de la connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérification de la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Vérifier si une requête POST a été reçue
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données envoyées par le client
    $idvehicule = $_POST['idvehicule'];
    $numerobadge = $_POST['numerobadge'];
    $type = $_POST['type'];
    $immatricule = $_POST['immatricule'];
    $date = date('Y-m-d');
    $heure= date ('H:i:s');

    // Préparer la requête SQL pour insérer les données
    $sql = "INSERT INTO flux  (idvehicule, numerobadge, type, immatricule, date, heure) VALUES ('$idvehicule', '$numrobadge', '$type', '$immatricule', '$date', '$heure')";

    // Exécuter la requête SQL
    if ($conn->query($sql) === TRUE) {
        echo "Enregistrement inséré avec succès";
    } else {
        echo "Erreur lors de l'insertion de l'enregistrement: " . $conn->error;
    }
}

// Fermer la connexion à la base de données
$conn->close();
?>