
<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "gestion de parking";

// Créer la connexion
$conn = new mysqli($servername, $username, $password, $database);

$type = "";
$nom = "";
$prenom = "";
$telephone = "";
$email = "";
$motdepasse = "";
$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $type = $_POST["type"];
    $nom = $_POST["nom"];
    $prenom = $_POST["prénom"];
    $telephone = $_POST["telephone"];
    $email= $_POST["email"];
    $motdepasse = $_POST["motdepasse"];
    if (empty($type) ||empty($nom) || empty($prenom) || empty($telephone)  || empty($email) || empty($motdepasse) ) {
        $errorMessage = "Tous les champs sont requis";
    } else {
        // Ajouter le nouveau chauffeur à la base de données
        $sql = "INSERT INTO utilisateur (idutilisateur,type, nom, prenom,  telephone,email, motdepasse) " .
               "VALUES ('','$type', '$nom', '$prenom', '$telephone', '$email', '$motdepasse')";
        $result = $conn->query($sql);
        if (!$result) {
            $errorMessage = "Requête invalide : " . $conn->error;
        } else {
            // Réinitialiser les variables après ajout réussi
            $type= "";
            $nom = "";
            $prenom = "";
            $telephone = "";
            $email = "";
            $motdepasse = "";
            $successMessage = "utilisateur ajouté avec succès";
            header("location: /gestion/utilisateur.php");
            exit;
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouveau utilisateur</title>
    <link rel="stylesheet" type="text/css" href="create4.css">
</head>
<body>
    <div class="container">
        <h2>Nouveau utilisateur</h2>

        <?php 
        if (!empty($errorMessage)) {
            echo "
            <div class='' role='alert'>
              <strong>$errorMessage</strong>
              <button type='button' class='' data-bs-dismiss='alert' aria-label='Close'></button>
              </div>
            ";
        }
        ?>
        <form method="post">
        <div class="label1">
            <label class="label">Type</label>
            <div class="input">
                <input type="text" class="type" name="type" value="<?php echo $type; ?>">
            </div>
          <div class="label1">
            <label class="label">Nom</label>
            <div class="input">
                <input type="text" class="nom" name="nom" value="<?php echo $nom; ?>">
            </div>

          </div>
          <div class="label1">
            <label class="label">Prénom</label>
            <div class="input">
                <input type="text" class="prénom" name="prénom" value="<?php echo $prenom; ?>">
            </div>

          </div>
          
          <div class="label1">
            <label class="label">Télèphone</label>
            <div class="input">
                <input type="text" class="telephone" name="telephone" value="<?php echo $telephone; ?>">
            </div>
          </div>
          
          <div class="label1">
            <label class="label">Email</label>
            <div class="input">
                <input type="text" class="email" name="email" value="<?php echo $email; ?>">
            </div>
            <div class="label1">
    <label class="label">Mot de passe </label>
    <div class="input">
        <input type="text" class="motdepasse" name="motdepasse" value="<?php echo $motdepasse; ?>">
    </div>
</div>


          <?php
          if (!empty($successMessage)) {
                echo "
                <div class='row mb-3'>
                 <div class='offset-sm-3 col-sm-6'>
                  <div class='alert alert-success alert-dismissible fade show' role='alert'>
                    <strong>$successMessage</strong>
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                  </div>
                 </div>
                </div>
                ";

            }
          ?>
          <div class="class">
            <div class="label">
                <button type="submit" class="button2">soumettre</button>
            </div>
            <div class="label">
                <a class="button1" href="/gestion/utilisateur.php" role="button">Annuler</a>
            </div>
          </div>
          </form>
    </div>
</body>
</html>