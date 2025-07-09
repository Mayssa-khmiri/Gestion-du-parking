<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "gestion de parking";

// Créer la connexion
$conn = new mysqli($servername, $username, $password, $database);

$nomdirection = "";
$description = "";
$creerle = ""; // Correction du nom de variable
$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nomdirection = isset($_POST["nomdirection"]) ? $_POST["nomdirection"] : '';
    $description = isset($_POST["description"]) ? $_POST["description"] : ''; // Ajout de la vérification d'isset
    $creerle = isset($_POST["creerle"]) ? $_POST["creerle"] : ''; // Correction du nom de variable

    if (empty($nomdirection) || empty($description) || empty($creerle)) {
        $errorMessage = "Tous les champs sont requis";
    } else {
        // Ajouter le nouveau chauffeur à la base de données
        $sql = "INSERT INTO direction (nomdirection, description, creerle)" . // Correction du nom de colonne
               "VALUES ('$nomdirection', '$description', '$creerle')"; // Correction du nom de variable
        $result = $conn->query($sql);
        if (!$result) {
            $errorMessage = "Requête invalide : " . $conn->error;
        } else {
            // Réinitialiser les variables après ajout réussi
            $nomdirection= "";
            $description = "";
            $creerle = ""; // Réinitialisation du champ "Créer le"
            $successMessage = "Direction ajoutée avec succès";
            header("location: /gestion/direction.php");
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
    <title>Nouveau Direction</title>
    <link rel="stylesheet" type="text/css" href="create5.css">
</head>
<body>
    <div class="container">
        <h2>Nouveau Direction</h2>

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
                <label class="label">Nom direction</label>
                <div class="input">
                    <input type="text" class="type" name="nomdirection" value="<?php echo $nomdirection; ?>">
                </div>
            </div>
            <div class="label1">
                <label class="label">Description</label>
                <div class="input">
                    <input type="text" class="description" name="description" value="<?php echo $description; ?>">
                </div>
            </div>
            <div class="label1">
                <label class="label">Créer le</label>
                <div class="input">
                    <input type="date" class="creerle" name="creerle" value="<?php echo $creerle; ?>"> <!-- Correction du nom de classe -->
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
                    <button type="submit" class="button2">Soumettre</button> <!-- Correction du texte -->
                </div>
                <div class="label">
                    <a class="button1" href="/gestion/direction.php" role="button">Annuler</a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
