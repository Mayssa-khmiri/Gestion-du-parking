

<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "gestion de parking";

// Créer la connexion
$conn = new mysqli($servername, $username, $password, $database);

$nom = "";
$prénom = "";
$téléphone = "";
$numerobadge="";
$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nom = $_POST["nom"];
    $prénom = $_POST["prénom"];
    $téléphone = $_POST["téléphone"];
    $numerobadge = $_POST["numerobadge"];
    if (empty($nom) || empty($prénom) || empty($téléphone)  || empty($numerobadge) ) {
        $errorMessage = "Tous les champs sont requis";
    } else {
        // Ajouter le nouveau chauffeur à la base de données
        $sql = "INSERT INTO chauffeur (idchauffeur, nom, prénom,  téléphone,numerobadge) " .
               "VALUES ('', '$nom', '$prénom', '$téléphone','$numerobadge')";
        $result = $conn->query($sql);
        if (!$result) {
            $errorMessage = "Requête invalide : " . $conn->error;
        } else {
            // Réinitialiser les variables après ajout réussi
            $nom = "";
            $prénom = "";
            $téléphone = "";
            $numerobadge = "";
            $successMessage = "Chauffeur ajouté avec succès";
            header("location: /gestion/chauffeur.php");
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
    <title>Nouveau chauffeur</title>
    <link rel="stylesheet" type="text/css" href="create1.css">
</head>
<body>
    <div class="container">
        <h2>Nouveau chauffeur</h2>

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
            <label class="label">Nom</label>
            <div class="input">
                <input type="text" class="nom" name="nom" value="<?php echo $nom; ?>">
            </div>

          </div>
          <div class="label1">
            <label class="label">Prénom</label>
            <div class="input">
                <input type="text" class="prenom" name="prénom" value="<?php echo $prénom; ?>">
            </div>

          </div>
          
          <div class="label1">
            <label class="label">Téléphone</label>
            <div class="input">
                <input type="text" class="telephone" name="téléphone" value="<?php echo $téléphone; ?>">
            </div>
          </div>
          
          <div class="label1">
            <label class="label">Numéro badge</label>
            <div class="input">
                <input type="text" class="numerobadge" name="numerobadge" value="<?php echo $numerobadge; ?>">
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
                <button type="submit" class="button2">Soumettre</button>
            </div>
            <div class="label">
                <a class="button1" href="/gestion/chauffeur.php" role="button">Annuler</a>
            </div>
          </div>
          </form>
    </div>
</body>
</html>