<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "gestion de parking";

// Créer une connexion
$conn = new mysqli($servername, $username, $password, $database);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$iddirection = "";
$nomdirection = "";
$description = "";
$creerle = "";
$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Méthode GET : afficher les données de la direction

    if (!isset($_GET['iddirection'])) {
        header("location: /gestion/direction.php");
        exit;
    }

    $iddirection = $_GET["iddirection"];
    $sql = "SELECT * FROM direction WHERE iddirection=$iddirection";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    if (!$row) {
        header("location: /gestion/direction.php");
        exit;
    }

    $nomdirection = $row["nomdirection"];
    $description = $row["description"];
    $creerle = $row["creerle"];
} else {
    // Méthode POST : mettre à jour les données de la direction

    $iddirection = $_POST["iddirection"];
    $nomdirection = $_POST["nomdirection"];
    $description = $_POST["description"];
    $creerle = $_POST["creer"]; // Correction du nom de variable

    if (empty($iddirection) || empty($nomdirection) || empty($description) || empty($creerle)) {
        $errorMessage = "Tous les champs sont requis";
    } else {
        $sql = "UPDATE direction SET nomdirection='$nomdirection', description='$description', creerle='$creerle' WHERE iddirection=$iddirection";
        $result = $conn->query($sql);

        if (!$result) {
            $errorMessage = "Erreur : " . $conn->error;
        } else {
            $successMessage = "Direction mise à jour avec succès";
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
    <link rel="stylesheet" type="text/css" href="Updat5.css">
    <title>Modifier Direction</title>
</head>

<body>
    <div class="container">
        <h2>Modifier Direction</h2>

        <?php
        if (!empty($errorMessage)) {
            echo "<div class='alert alert-danger'>$errorMessage</div>";
        }

        if (!empty($successMessage)) {
            echo "<div class='alert alert-success'>$successMessage</div>";
        }
        ?>

        <form method="post">
            <input type="hidden" name="iddirection" value="<?php echo $iddirection; ?>">
            <div class="row">
                <label class="col-sm-3 col-form-label">Nom de direction</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="nomdirection" value="<?php echo $nomdirection; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Description</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="description" value="<?php echo $description; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Créer le</label>
                <div class="col-sm-6">
                    <input type="date" class="form-control" name="creer" value="<?php echo $creerle; ?>">
                </div>
            </div>
            <div class="button">
                <div class="class">
                    <button type="submit" class="butt1">Modifier</button>
                </div>
                <div class="class">
                    <a class="butt2" href="/gestion/direction.php" role="button">Supprimer</a>
                </div>
            </div>
        </form>
    </div>
</body>

</html>
