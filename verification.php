<?php
session_start();
if (isset($_POST['nom']) && isset($_POST['motdepasse'])) {
    // connexion à la base de données
    $servername = "localhost";
    $username = "root";  // Renommé pour éviter la confusion avec 'nom' du formulaire
    $password = "";
    $database = "gestion de parking";

    // Créer la connexion
    $conn = new mysqli($servername, $username, $password, $database);

    // Vérifier la connexion
    if ($conn->connect_error) {
        die("Connexion échouée : " . $conn->connect_error);
    }
    // on applique les deux fonctions mysqli_real_escape_string et htmlspecialchars
    // pour éliminer toute attaque de type injection SQL et XSS
    $nom = mysqli_real_escape_string($conn, htmlspecialchars($_POST['nom']));
    $motdepasse = mysqli_real_escape_string($conn, htmlspecialchars($_POST['motdepasse']));

    if ($nom !== "" && $motdepasse !== "") {
        // Utilisation de requêtes préparées pour éviter les injections SQL
        $requete = $conn->prepare("SELECT COUNT(*) FROM user WHERE nom = ? AND motdepasse = ?");
        $requete->bind_param("ss", $nom, $motdepasse); // 'ss' signifie que les deux paramètres sont des chaînes de caractères
        $requete->execute();
        $resultat = $requete->get_result();
        $reponse = $resultat->fetch_array();
        $count = $reponse[0]; // Accéder à la première colonne qui est le résultat de COUNT(*)

        if ($count != 0) { // nom  et mot de passe corrects
            $_SESSION['nom'] = $nom;
            $_SESSION['motdepasse'] = $motdepasse;
            $_SESSION['email'] = $email;
            header('Location: gestion.php');
        } else {
            header('Location: login.php?erreur=1'); // nom ou mot de passe incorrect
        }
    } else {
        header('Location: login.php?erreur=2'); // nom ou mot de passe vide
    }
    $requete->close();
    $conn->close(); // fermer la connexion
} else {
    header('Location: login.php');
}
?>
