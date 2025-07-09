<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "gestion de parking";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

$type = "";
$nom = "";
$prenom = "";
$telephone = "";
$email = "";
$motdepasse = "";
$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // GET method: show the data of the client
    if (!isset($_GET['idutilisateur'])) {
        header("location: /gestion/utilisateur.php");
        exit;
    }
    $idutilisateur = $_GET["idutilisateur"]; // Get the ID from the URL

    $sql = "SELECT * FROM utilisateur WHERE idutilisateur=$idutilisateur";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    if (!$row) {
        header("location: /gestion/utilisateur.php");
        exit;
    }

    $type = $row["type"];
    $nom = $row["nom"];
    $prenom = $row["prenom"];
    $telephone = $row["telephone"];
    $email = $row["email"];
    $motdepasse = $row["motdepasse"];
} else {
    // POST method: update the data of the client

    $idutilisateur = $_POST["idutilisateur"]; // Get the ID from the form
    $type = $_POST["type"];
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $telephone = $_POST["telephone"];
    $email = $_POST["email"];
    $motdepasse = $_POST["motdepasse"];

    do {
        if (empty($type) || empty($nom) || empty($prenom) || empty($telephone) || empty($email) || empty($motdepasse)) {
            $errorMessage = "ALL the fields are required";
            break;
        }

        // Update query (without updating idutilisateur)
        $sql = "UPDATE utilisateur SET type='$type', nom='$nom', prenom='$prenom', email='$email', telephone='$telephone', motdepasse='$motdepasse' WHERE idutilisateur=$idutilisateur";
        $result = $conn->query($sql);

        if (!$result) {
            $errorMessage = "Invalid query: " . $conn->error;
            break;
        }

        $successMessage = "utilisateur updated correctly";
        header("location: /gestion/utilisateur.php");
        exit;

    } while (false);
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="updat4.css">
    <title>Edit  utilisateur </title>
   
  
</head>
<body>
    <div class="container " >
        <h2>Modifier utilisateur </h2>
 
        <?php 
        if (!empty($errorMessage)) {
            echo "
            <div class=' alert-dismissible fade show' role='alert'>
              <strong>$errorMessage</strong>
              <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
              </div>
            ";
        }
        ?>
        <form method="post">
            <input type="hidden" name="idutilisateur" value="<?php echo $idutilisateur; ?>">
            <div class="row ">
            <label class="col-sm-3 col-form-label">type</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="type" value="<?php echo $type; ?>">
            </div>
            </div>
            <div class="row ">
            <label class="col-sm-3 col-form-label">nom</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="nom" value="<?php echo $nom; ?>">
            </div>
            </div> 
            <div class="row mb-3">
            <label class="col-sm-3 col-form-label">prenom</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="prenom" value="<?php echo $prenom; ?>">
            </div>
          </div>
          <div class="row ">
            <label class="col-sm-3 col-form-label">telephone</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="telephone" value="<?php echo $telephone; ?>">
            </div>
            </div>
          <div class="row mb-3">
            <label class="col-sm-3 col-form-label">email</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="email" value="<?php echo $email; ?>">
            </div>
          </div>
         
          <div class="row mb-3">
            <label class="col-sm-3 col-form-label">motdepasse</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="motdepasse" value="<?php echo $motdepasse; ?>">
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
          <div class="button">
            <div class="class ">
                <button type="submit" class="butt1">Modifier</button>
            </div>
            <div class="class ">
                <a class="butt2" href="/gestion/utilisateur.php" role="button">Supprimer</a>
            </div>
          </div>
          </form>
    </div>
</body>
</html>