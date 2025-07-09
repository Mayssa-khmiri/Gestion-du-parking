<?php
$servername="localhost";
$username= "root";
$password= "";
$db= "gestion de parking";

//create connection
$conn= new mysqli($servername, $username, $password, $db);


$idchauffeur="";
$nom= "";
$prénom="";
$téléphone= "";
$numerobadge= "";
$errorMessage = "";
$successMessage = "";

  if ($_SERVER['REQUEST_METHOD'] == 'GET'){
    //GET method :show the data of the client
    if (!isset($_GET['idchauffeur'])) {
        header("location: /gestion/chauffeur.php");
        exit;
    }
    $idchauffeur= $_GET["idchauffeur"];
    $sql = "SELECT * FROM chauffeur  WHERE idchauffeur=$idchauffeur";
    $result = $conn->query($sql);
    $row=$result->fetch_assoc();

    if(!$row) {
        header("location: /gestion/chauffeur.php");
        exit;
    }
    $nom = $row["nom"];
    $prénom= $row["prénom"];
    $téléphone = $row["téléphone"];
    $numerobadge = $row["numerobadge"];
}
else{
    //post method : update the data of the client
    
    $idchauffeur = $_POST["idchauffeur"];
    $nom = $_POST["nom"];
    $prénom = $_POST["prénom"];
     $téléphone = $_POST["téléphone"];  
     $numerobadge = isset($_POST['numerobadge']) ? $_POST['numerobadge'] : '';

    do{
        if(empty($idchauffeur) || empty($nom) || empty($prénom) ||  empty($téléphone) ||  empty($numerobadge) ) {
            $errorMessage ="ALL the fields are required";
            break;
        }
        $sql = "UPDATE chauffeur  
        SET nom = '$nom' , prénom = '$prénom', téléphone='$téléphone' ,numerobadge='$numerobadge'
        WHERE idchauffeur =$idchauffeur";
        $result = $conn->query($sql);

        if (!$result){
            $errorMessage = "Invalid query: " . $conn->error;
            break;
        }
        $successMessage ="chauffeur updated  correctly ";
        header("location: /gestion/chauffeur.php");
        exit;

    }while (true);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="update1.css">
    <title>Edit  chauffeur</title>
   
  
</head>
<body>
    <div class="container " >
       <h2>Modifier chauffeur</h2>
 
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
      
            <input type="hidden" name="idchauffeur" value="<?php echo $idchauffeur; ?>">
          <div class="row ">
            <label class="col-sm-3 col-form-label">Nom</label>
            <div class="col-sm  -6">
                <input type="text" class="form-control" name="nom" value="<?php echo $nom; ?>">
            </div>
            </div>
          <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Prénom</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="prénom" value="<?php echo $prénom; ?>">
</div>
          </div>
          
         
          <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Téléphone</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="téléphone" value="<?php echo $téléphone; ?>">
            </div>
          </div>
         

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Numéro badge</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="numerobadge" value="<?php echo isset($_POST['numerobadge']) ? $_POST['numerobadge'] : $numerobadge; ?>">
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
                <a class="butt2" href="/gestion/chauffeur.php" role="button">Supprimer</a>
            </div>
          </div>
          </form>
    </div>
</body>
</html>