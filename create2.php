

<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "gestion de parking";

// Créer la connexion
$conn = new mysqli($servername, $username, $password, $database);

$immatricule = "";
$marque = "";
$modéle = "";
$couleur = "";
$catégorie= "";
$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $immatricule = $_POST["immatricule"];
    $marque = $_POST["marque"];  
    $modéle = $_POST["modéle"];
    $couleur= $_POST["couleur"];
    $catégorie = $_POST["catégorie"];

    
    if (empty($immatricule ) || empty($marque) || empty($modéle) || empty($couleur) || empty($catégorie)) {
        $errorMessage = "Tous les champs sont requis";
    } else {
        // Ajouter le nouveau chauffeur à la base de données
        $sql = "INSERT INTO véhicule (idvéhicule, immatricule, marque, modéle,couleur,catégorie) " .
               "VALUES ('', '$immatricule','$marque' ,'$modéle' ,'$couleur','$catégorie')";
        $result = $conn->query($sql);
        if (!$result) {
            $errorMessage = "Requête invalide : " . $conn->error;
        } else {
            // Réinitialiser les variables après ajout réussi
            $immatricule = "";
            $marque = "";
            $modéle= "";
            $couleur = "";
            $catégorie= "";
            
            
            $successMessage = "véhicule ajouté avec succès";
            header("location: /gestion/véhicule.php");
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
    <title>Nouveau véhicule</title>
    <link rel="stylesheet" type="text/css" href="create2.css">
</head>
<body>
    <div class="container">
        <h2>Nouveau véhicule</h2>

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
            <label class="label">Immatricule</label>
            <div class="input">
                <input type="text" class="prenom" name="immatricule" value="<?php echo $immatricule ?>">
            </div>

          </div>
          
          <div class="label1">
            <label class="label">Marque</label>
            <div class="input">
                <input type="text" class="telephone" name="marque" value="<?php echo $marque; ?>">
            </div>
          </div>
          
          <div class="label1">
            <label class="label">Modéle</label>
            <div class="input">
                <input type="text" class="telephone" name="modéle" value="<?php echo $modéle; ?>">
            </div>
          </div>
          
          <div class="label1">
            <label class="label">Couleur</label>
            <div class="input">
                <input type="text" class="couleur" name="couleur" value="<?php echo $couleur; ?>">
            </div>
          </div>
          
          <div class="label1">
            <label class="label">Catégorie</label>
            <div class="input">
                <input type="text" class="couleur" name="catégorie" value="<?php echo $catégorie; ?>">
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
                <a class="button1" href="/gestion/véhicule.php" role="button">Annuler</a>
            </div>
          </div>
          </form>
    </div>
</body>
</html>