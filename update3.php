<?php
$servername="localhost";
$username= "root";
$password= "";
$database= "gestion de parking";

//create connection
$conn= new mysqli($servername, $username, $password, $database);
$idchauffeur= "";
$idvehicule= "";
$immatricule= "";
$nomdirection= "";
$type= "";
$date= "";
$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET'){
    //GET method :show the data of the client
    if (!isset($_GET['idflux'])) {
        header("location: /gestion/flux.php");
        exit;
    }
    $idflux= $_GET["idflux"];
    $sql = "SELECT * FROM flux acces WHERE idflux=$idflux";
        $result = $conn->query($sql);
    $row=$result->fetch_assoc();

    if(!$row) {
        header("location: /gestion/flux.php");
        exit;
    }
    $idchauffeur= $row["idchauffeur"];
    $idvéhicule= $row["idvehicule"];
    $immatricule= $row["immatricule"];
    $nomdirection= $row["nomdirection"];
    $type= $row["type"];
    $date= $row["date"];
}
else{
    //post method : update the data of the client
    $idchauffeur= $row["idchauffeur"];
    $idvéhicule= $row["idvehicule"];
    $immatricule= $row["immatricule"];
    $nomdirection= $row["nomdirection"];
    $type= $row["type"];
    $date= $row["date"];
}
    do{
        if(empty($idchauffeur) ||empty($idvehicule) || empty($nomdirection) || empty($immatricule) ||  empty($type)  ||  empty($date) ) {
            $errorMessage ="ALL the fields are required";
            break;
        }
        $sql = "UPDATE `flux acces` SET `idflux`,`idchauffeur`,`idvehicule`,`nomdirection`,`immatricule`,`type`,`date` WHERE 1";
        $result = $conn->query($sql);

        if (!$result){
            $errorMessage = "Invalid query: " . $conn->error;
            break;
        }
        $successMessage ="flux updated  correctly ";
        header("location: /gestion/flux.php");
        exit;

    }while (true);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="update3.css">
    <title>Edit  flux d'accés</title>
   
  
</head>
<body>
    <div class="container " >
        <h2>Modifier flux d'accés </h2>
 
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
            <input type="hidden" name="idflux" value="<?php echo $idflux; ?>">
            <div class="row ">
            <label class="col-sm-3 col-form-label">id chauffeur</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="idchauffeur" value="<?php echo $idchauffeur; ?>">
            </div>
            </div>
            <div class="row ">
            <label class="col-sm-3 col-form-label">id vehicule</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="idvehicule" value="<?php echo $idvehicule; ?>">
            </div>
            </div> 
            <div class="row mb-3">
            <label class="col-sm-3 col-form-label">nom direction</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="nom direction" value="<?php echo $nomdirection; ?>">
            </div>
          </div>
          <div class="row ">
            <label class="col-sm-3 col-form-label">immatricule</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="immatricule" value="<?php echo $immatricule; ?>">
            </div>
            </div>
          <div class="row mb-3">
            <label class="col-sm-3 col-form-label">type</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="type" value="<?php echo $type; ?>">
            </div>
          </div>
         
          <div class="row mb-3">
            <label class="col-sm-3 col-form-label">date</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="date" value="<?php echo $date; ?>">
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
                <button type="submit" class="butt">Modifier</button>
            </div>
            <div class="class ">
                <a class="butt2" href="/gestion/flux.php" role="button">Supprimer</a>
            </div>
          </div>
          </form>
    </div>
</body>
</html>