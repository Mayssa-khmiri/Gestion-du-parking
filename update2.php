<?php
$servername="localhost";
$username= "root";
$password= "";
$database= "gestion de parking";

//create connection
$conn= new mysqli($servername, $username, $password, $database);

$immatricule= "";
$marque="";
$modéle= "";
$couleur= "";
$catégorie= "";
$errorMessage = "";
$successMessage = "";

  if ($_SERVER['REQUEST_METHOD'] == 'GET'){
    //GET method :show the data of the client
    if (!isset($_GET['idvéhicule'])) {
        header("location: /gestion/véhicule.php");
        exit;
    }
    $idvéhicule= $_GET["idvéhicule"];
    $sql = "SELECT * FROM véhicule  WHERE idvéhicule=$idvéhicule";
    $result = $conn->query($sql);
    $row=$result->fetch_assoc();

    if(!$row) {
        header("location: /gestion/véhicule.php");
        exit;
    }
    $immatricule= $row["immatricule"];
    $marque= $row["marque"];
    $modéle= $row["modéle"];
    $couleur= $row["couleur"];
    $catégorie = $row["catégorie"];
   
}
else{
    //post method : update the data of the client
    
    $idvéhicule = $_POST["idvéhicule"];
    $immatricule = $_POST["immatricule"];
    $marque = $_POST["marque"];
    $couleur = $_POST["couleur"];
    $modéle = $_POST["modéle"];
    $catégorie= $_POST["catégorie"];
 

    do{
        if(empty($idvéhicule) || empty($immatricule) || empty($marque) ||  empty($modéle)  ||  empty($couleur) ||  empty($catégorie)) {
            $errorMessage ="ALL the fields are required";
            break;
        }
        $sql = "UPDATE véhicule
        SET immatricule = '$immatricule' , marque = '$marque', modéle='$modéle' , couleur='$couleur',catégorie='$catégorie'
        WHERE idvéhicule =$idvéhicule";
        $result = $conn->query($sql);

        if (!$result){
            $errorMessage = "Invalid query: " . $conn->error;
            break;
        }
        $successMessage ="véhicule updated  correctly ";
        header("location: /gestion/véhicule.php");
        exit;

    }while (true);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="Update2.css">
    <title>Edit  véhicule</title>
   
  
</head>
<body>
    <div class="container " >
       <h2>Modifier véhicule </h2>
 
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

            <input type="hidden" name="idvéhicule" value="<?php echo $idvéhicule; ?>">
          <div class="row ">
            <label class="col-sm-3 col-form-label">Immatricule</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="immatricule" value="<?php echo $immatricule; ?>">
            </div>
            </div>
          <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Marque</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="marque" value="<?php echo $marque; ?>">
            </div>
          </div>
          
         
          <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Modéle</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="modéle" value="<?php echo $modéle; ?>">
            </div>
          </div>
         
          <div class="row mb-3">
            <label class="col-sm-3 col-form-label">couleur</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="couleur" value="<?php echo $couleur; ?>">
            </div>
          </div>

          <div class="row mb-3">
            <label class="col-sm-3 col-form-label">catégorie</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="catégorie" value="<?php echo $catégorie; ?>">
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
                <a class="butt2" href="/gestion/véhicule.php" role="button">Supprimer</a>
            </div>
          </div>
          </form>
    </div>
</body>
</html>